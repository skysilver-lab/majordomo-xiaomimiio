<?php
/**
 * Pure PHP port of the Xiaomi cloud token extractor.
 * No shell commands, no Python dependency.
 */
class XiaomiCloudConnector
{
    private $username;
    private $password;
    private $agent;
    private $deviceId;
    private $sign = '';
    private $ssecurity = '';
    private $userId = '';
    private $serviceToken = '';
    private $debug = false;

    public function __construct($username, $password, $debug = false)
    {
        $this->username = $username;
        $this->password = $password;
        $this->debug = $debug;
        $this->agent = 'Android-7.1.1-1.0.0-ONEPLUS A3010-136-' . $this->randomString('ABCDE', 13) . ' APP/xiaomi.smarthome APPV/62830';
        $this->deviceId = $this->randomString('abcdefghijklmnopqrstuvwxyz', 6);
    }

    private function randomString($alphabet, $length)
    {
        $result = '';
        $max = strlen($alphabet) - 1;
        for ($i = 0; $i < $length; $i++) {
            $result .= $alphabet[random_int(0, $max)];
        }
        return $result;
    }

    private function log($message)
    {
        if ($this->debug) {
            DebMes($message, 'xiaomimiio');
        }
    }

    private function request($url, $fields = array(), $cookies = array(), $post = false)
    {
        $ch = curl_init();
        $cookiePairs = array();
        foreach ($cookies as $name => $value) {
            $cookiePairs[] = $name . '=' . $value;
        }
        $headers = array(
            'User-Agent: ' . $this->agent,
            'Accept: */*',
            'Accept-Encoding: gzip',
        );
        $options = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_ENCODING => 'gzip',
            CURLOPT_TIMEOUT => 20,
            CURLOPT_HTTPHEADER => $headers,
        );
        if ($cookiePairs) {
            $options[CURLOPT_COOKIE] = implode('; ', $cookiePairs);
        }
        if ($post) {
            $options[CURLOPT_POST] = true;
            $options[CURLOPT_POSTFIELDS] = http_build_query($fields);
            $headers[] = 'Content-Type: application/x-www-form-urlencoded';
            $options[CURLOPT_HTTPHEADER] = $headers;
        } elseif ($fields) {
            $separator = (strpos($url, '?') === false) ? '?' : '&';
            $options[CURLOPT_URL] = $url . $separator . http_build_query($fields);
        }
        curl_setopt_array($ch, $options);
        $raw = curl_exec($ch);
        $error = curl_error($ch);
        $status = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $headerSize = (int)curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        curl_close($ch);
        if ($raw === false) {
            $this->log('Xiaomi HTTP error: ' . $error);
            return array('status' => 0, 'body' => '', 'cookies' => array());
        }
        $headerBlock = substr($raw, 0, $headerSize);
        $body = substr($raw, $headerSize);
        $cookiesOut = array();
        if (preg_match_all('/^Set-Cookie:\s*([^=\r\n]+)=([^;\r\n]+)/mi', $headerBlock, $matches)) {
            foreach ($matches[1] as $index => $name) {
                $cookiesOut[trim($name)] = $matches[2][$index];
            }
        }
        return array('status' => $status, 'body' => $body, 'cookies' => $cookiesOut);
    }

    private function parseJson($body)
    {
        $body = str_replace('&&&START&&&', '', $body);
        return json_decode($body, true);
    }

    private function baseCookies()
    {
        return array(
            'sdkVersion' => 'accountsdk-18.8.15',
            'deviceId' => $this->deviceId,
        );
    }

    public function login()
    {
        $step1 = $this->request(
            'https://account.xiaomi.com/pass/serviceLogin?sid=xiaomiio&_json=true',
            array(),
            $this->baseCookies() + array('userId' => $this->username)
        );
        $json = $this->parseJson($step1['body']);
        if ($step1['status'] != 200 || empty($json['_sign'])) {
            $this->log('Xiaomi login step 1 failed');
            return false;
        }
        $this->sign = $json['_sign'];

        $fields = array(
            'sid' => 'xiaomiio',
            'hash' => strtoupper(md5($this->password)),
            'callback' => 'https://sts.api.io.mi.com/sts',
            'qs' => '%3Fsid%3Dxiaomiio%26_json%3Dtrue',
            'user' => $this->username,
            '_sign' => $this->sign,
            '_json' => 'true',
        );
        $step2 = $this->request(
            'https://account.xiaomi.com/pass/serviceLoginAuth2',
            $fields,
            $this->baseCookies() + array('userId' => $this->username),
            false
        );
        $json = $this->parseJson($step2['body']);
        if ($step2['status'] != 200 || empty($json['ssecurity']) || empty($json['location'])) {
            $this->log('Xiaomi login step 2 failed');
            return false;
        }
        $this->ssecurity = $json['ssecurity'];
        $this->userId = isset($json['userId']) ? $json['userId'] : '';

        $step3 = $this->request($json['location'], array(), $this->baseCookies());
        if ($step3['status'] != 200 || empty($step3['cookies']['serviceToken'])) {
            $this->log('Xiaomi login step 3 failed');
            return false;
        }
        $this->serviceToken = $step3['cookies']['serviceToken'];
        return true;
    }

    private function apiUrl($country)
    {
        $prefix = ($country === 'cn' || $country === '') ? '' : ($country . '.');
        return 'https://' . $prefix . 'api.io.mi.com/app';
    }

    private function signedNonce($nonce)
    {
        return base64_encode(hash('sha256', base64_decode($this->ssecurity) . base64_decode($nonce), true));
    }

    private function callApi($url, $data)
    {
        $millis = (int)round(microtime(true) * 1000);
        $nonce = base64_encode(random_bytes(8) . pack('N', (int)($millis / 60000)));
        $signedNonce = $this->signedNonce($nonce);
        $withoutApp = str_replace('/app', '', $url);
        $parts = explode('com', $withoutApp, 2);
        $path = isset($parts[1]) ? $parts[1] : $withoutApp;
        $signatureString = $path . '&' . $signedNonce . '&' . $nonce . '&data=' . $data;
        $signature = base64_encode(hash_hmac('sha256', $signatureString, base64_decode($signedNonce), true));

        $cookies = array(
            'userId' => $this->userId,
            'yetAnotherServiceToken' => $this->serviceToken,
            'serviceToken' => $this->serviceToken,
            'locale' => 'en_GB',
            'timezone' => 'GMT+02:00',
            'is_daylight' => '1',
            'dst_offset' => '3600000',
            'channel' => 'MI_APP_STORE',
        );
        $headers = array(
            'Accept-Encoding: gzip',
            'User-Agent: ' . $this->agent,
            'Content-Type: application/x-www-form-urlencoded',
            'x-xiaomi-protocal-flag-cli: PROTOCAL-HTTP2',
        );
        $ch = curl_init();
        $cookiePairs = array();
        foreach ($cookies as $name => $value) {
            $cookiePairs[] = $name . '=' . $value;
        }
        $options = array(
            CURLOPT_URL => $url . '?signature=' . urlencode($signature) . '&_nonce=' . urlencode($nonce) . '&data=' . urlencode($data),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => '',
            CURLOPT_ENCODING => 'gzip',
            CURLOPT_TIMEOUT => 20,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_COOKIE => implode('; ', $cookiePairs),
        );
        curl_setopt_array($ch, $options);
        $body = curl_exec($ch);
        $status = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if ($status != 200 || $body === false) {
            $this->log('Xiaomi API call failed: ' . $status);
            return null;
        }
        return json_decode($body, true);
    }

    public function getDevices($country)
    {
        $result = $this->callApi(
            $this->apiUrl($country) . '/home/device_list',
            '{"getVirtualModel":false,"getHuamiDevices":0}'
        );
        if (!isset($result['result']['list'])) {
            return array();
        }
        return $result['result']['list'];
    }

    public function getBeaconKey($country, $did)
    {
        $result = $this->callApi(
            $this->apiUrl($country) . '/v2/device/blt_get_beaconkey',
            '{"did":"' . $did . '","pdid":1}'
        );
        if (!isset($result['result']['beaconkey'])) {
            return '';
        }
        return $result['result']['beaconkey'];
    }
}