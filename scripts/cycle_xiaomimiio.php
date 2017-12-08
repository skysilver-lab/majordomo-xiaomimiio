<?php
/**
* Xiaomi miIO Cycle
* @author <skysilver.da@gmail.com>
* @copyright 2017 Agaphonov Dmitri aka skysilver <skysilver.da@gmail.com> (c)
* @version 0.7b
*/

chdir(dirname(__FILE__) . '/../');

include_once('./config.php');
include_once('./lib/loader.php');
include_once('./lib/threads.php');

set_time_limit(0);

$db = new mysql(DB_HOST, '', DB_USER, DB_PASSWORD, DB_NAME);

include_once('./load_settings.php');
include_once(DIR_MODULES . 'control_modules/control_modules.class.php');

$ctl = new control_modules();

include_once(DIR_MODULES . 'xiaomimiio/xiaomimiio.class.php');
include_once(DIR_MODULES . 'xiaomimiio/lib/miio.class.php');

$miio_module = new xiaomimiio();
$miio_module->getConfig();

echo date('H:i:s') . ' Running ' . basename(__FILE__) . PHP_EOL;

$latest_check = 0;
$latest_disc = 0;
$check_period = 5;

$bind_ip = '0.0.0.0';
$miio_debug = false;
$cycle_debug = false;
$debmes_debug = false;
$disc_period = 120;

if ($miio_module->config['API_IP']) $bind_ip = $miio_module->config['API_IP'];
if ($miio_module->config['API_LOG_MIIO']) $miio_debug = true;
if ($miio_module->config['API_LOG_CYCLE']) $cycle_debug = true;
if ($miio_module->config['API_LOG_DEBMES']) $debmes_debug = true;
if ($miio_module->config['API_DISC_PERIOD']) $disc_period = (int)$miio_module->config['API_DISC_PERIOD'];
 
echo date('H:i:s') . ' Init miIO ' . PHP_EOL;
echo date('H:i:s') . " Bind IP - $bind_ip" . PHP_EOL;
echo date('H:i:s') . " Discover period - $disc_period seconds" . PHP_EOL;
echo date('H:i:s') . ' Cycle debug - ' . ($cycle_debug ? 'yes' : 'no') . PHP_EOL;
echo date('H:i:s') . ' DebMes debug - ' . ($debmes_debug ? 'yes' : 'no') . PHP_EOL;
echo date('H:i:s') . ' miIO-Lib debug - ' . ($miio_debug ? 'yes' : 'no') . PHP_EOL;

$dev = new miIO(null, $bind_ip, null, $miio_debug);

while (1) {

	if ((time()-$latest_check) >= $check_period) {
		$latest_check = time();
		setGlobal((str_replace('.php', '', basename(__FILE__))) . 'Run', time(), 1);
	}

	$queue = SQLSelect("SELECT miio_queue.*, miio_devices.TOKEN, miio_devices.DEVICE_TYPE, miio_devices.IP FROM miio_queue LEFT JOIN miio_devices ON miio_queue.DEVICE_ID=miio_devices.ID ORDER BY miio_queue.ID");
    
	if ($queue[0]['ID']) {
        $total = count($queue);
		//$prev_id = '';
        for ($i = 0; $i < $total; $i++) {
			
            if ($cycle_debug) echo date('H:i:s') . ' Queue command: ' . json_encode($queue[$i]) . PHP_EOL;
			
			//if ($prev_id == $queue[$i]['DEVICE_ID']) {
				//if ($cycle_debug) echo date('H:i:s') . ' The previous command was to this device. Make a small pause (1 sec).' . PHP_EOL;
				//sleep(1);
			//}
				
			//$prev_id = $queue[$i]['DEVICE_ID'];
			
            SQLExec("DELETE FROM miio_queue WHERE ID=" . $queue[$i]['ID']);

            $reply = '';
			$dev->data = '';

            if ($queue[$i]['DEVICE_ID']) {
                if ($queue[$i]['IP']) {
                    $dev->ip = $queue[$i]['IP'];
                } else {
                    $dev->ip = null;
                }
                if ($queue[$i]['TOKEN']) {
                    $dev->token = $queue[$i]['TOKEN'];
                } else {
                    $dev->token = null;
                }
				//TO-DO: перед отправкой команды у-ву нужно задать разницу времени между сервером и локальным временем у-ва.
				//это значение уникально для каждого у-ва, поэтому логично его хранить в базе и обновлять при периодическом поиске или пинге.
				//это также избавит от необходимости слать hello-пакет перед каждой командой
				$msg_id = substr(time().$i, 3);
                if($dev->msgSendRcv($queue[$i]['METHOD'], $queue[$i]['DATA'], $msg_id)) {
					$reply = $dev->data;
				} else {
					if ($cycle_debug) echo date('H:i:s') . " Reply: device not answered \n";
				}
            }

            if ($reply != '') {
				if ($cycle_debug) echo date('H:i:s') . " Reply: $reply \n";
                $url = BASE_URL.'/ajax/xiaomimiio.html?op=process&command='.urlencode($queue[$i]['METHOD']).'&device_id='.$queue[$i]['DEVICE_ID'].'&message='.urlencode($reply);
				getURLBackground($url, 0);
				if ($cycle_debug) echo date('H:i:s') . ' Background processing of the response is started' . PHP_EOL;
            }
        }
    }

    $devices = SQLSelect("SELECT * FROM miio_devices WHERE UPDATE_PERIOD>0 AND NEXT_UPDATE<=NOW() AND DEVICE_TYPE!='' AND TOKEN!=''");
    
	if ($devices[0]['ID']) {
        $total = count($devices);
        for ($i = 0; $i < $total; $i++) {
            $devices[$i]['NEXT_UPDATE'] = date('Y-m-d H:i:s', time()+(int)$devices[$i]['UPDATE_PERIOD']);
            SQLUpdate('miio_devices', $devices[$i]);
			$ip = $devices[$i]['IP'];
			if ($cycle_debug) echo date('H:i:s') . " Request to update the properties of the device $ip" . PHP_EOL;
            $miio_module->requestStatus($devices[$i]['ID']);
		}
    }
	
	if ((time() - $latest_disc) >= $disc_period) {
        $latest_disc = time();
        if ($cycle_debug) echo date('H:i:s') . " Starting periodic search for devices in the network (every $disc_period seconds)" . PHP_EOL;
		$url = BASE_URL.'/ajax/xiaomimiio.html?op=broadcast_search';
        getURLBackground($url, 0);
		if ($cycle_debug) echo date('H:i:s') . ' Background search process is started' . PHP_EOL;
    }
	
	if (file_exists('./reboot') || IsSet($_GET['onetime'])) {
		$db->Disconnect();
		echo date('H:i:s') . ' Stopping by command REBOOT or ONETIME' . basename(__FILE__) . PHP_EOL;
		exit;
	}

	sleep(1);
}

echo date('H:i:s') . ' Unexpected close of cycle' . PHP_EOL;

DebMes('Unexpected close of cycle: ' . basename(__FILE__));
