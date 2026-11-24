<?php
if ($this->mode == 'update') {
    $login = trim((string)gr('cloud_login'));
    $pass = (string)gr('cloud_password');
    $region = trim((string)gr('cloud_region'));
    $read_only = (int)gr('read_only', 'int');
    $out['READ_ONLY'] = $read_only;

    $regions = array('cn', 'de', 'us', 'ru', 'tw', 'sg', 'in', 'i2');
    if ($region !== '' && !in_array($region, $regions, true)) {
        $region = '';
    }
    $scanRegions = ($region === '') ? $regions : array($region);

    $out['OUTPUT'] = '';
    if ($login === '' || $pass === '') {
        $out['OUTPUT'] = 'Вкажіть логін і пароль Xiaomi.';
    } else {
        include_once(DIR_MODULES . 'xiaomimiio/lib/xiaomi_cloud.class.php');
        $connector = new XiaomiCloudConnector($login, $pass, false);
        if (!$connector->login()) {
            $out['OUTPUT'] = 'Не вдалося увійти в хмару Xiaomi. Перевірте логін, пароль і регіон.';
        } else {
            $lines = array();
            $result = array();
            foreach ($scanRegions as $currentRegion) {
                $devices = $connector->getDevices($currentRegion);
                if (empty($devices)) {
                    $lines[] = 'Пристроїв у регіоні ' . $currentRegion . ' не знайдено.';
                    continue;
                }
                $lines[] = 'Пристрої в регіоні ' . $currentRegion . ':';
                foreach ($devices as $device) {
                    $item = array(
                        'NAME' => isset($device['name']) ? $device['name'] : '',
                        'ID' => isset($device['did']) ? $device['did'] : '',
                        'IP' => isset($device['localip']) ? $device['localip'] : '',
                        'TOKEN' => isset($device['token']) ? $device['token'] : '',
                        'MODEL' => isset($device['model']) ? $device['model'] : '',
                        'BLE KEY' => '',
                    );
                    if ($item['ID'] !== '' && strpos($item['ID'], 'blt') !== false) {
                        $item['BLE KEY'] = $connector->getBeaconKey($currentRegion, $item['ID']);
                    }
                    $lines[] = 'new-device';
                    foreach ($item as $key => $value) {
                        if ($value !== '') {
                            $lines[] = '{' . $key . '}={' . $value . '}';
                        }
                    }
                    if ($item['ID'] !== '') {
                        $result[$item['ID']] = $item;
                    }
                }
                $lines[] = '---------';
            }
            $out['OUTPUT'] = implode("\n", $lines);

            if (!$read_only) {
                $updatedDevices = 0;
                foreach ($result as $device) {
                    if (empty($device['IP'])) {
                        continue;
                    }
                    $deviceRec = SQLSelectOne("SELECT * FROM miio_devices WHERE IP='" . DBSafe($device['IP']) . "'");
                    if ($deviceRec['ID'] && ($deviceRec['DEVICE_TYPE'] === $device['MODEL'] || $deviceRec['DEVICE_TYPE'] === '')) {
                        if (preg_match('/^new /is', $deviceRec['TITLE'])) {
                            $deviceRec['TITLE'] = $device['NAME'];
                        }
                        if ($device['TOKEN'] !== '') {
                            $deviceRec['TOKEN'] = $device['TOKEN'];
                        }
                        if ($device['MODEL'] !== '') {
                            $deviceRec['DEVICE_TYPE'] = $device['MODEL'];
                        }
                        SQLUpdate('miio_devices', $deviceRec);
                        $updatedDevices++;
                    }
                }
                if ($updatedDevices) {
                    $this->discover();
                }
            }
        }
    }
    $out['CLOUD_LOGIN'] = htmlspecialchars($login);
    $out['CLOUD_REGION'] = htmlspecialchars($region);
}