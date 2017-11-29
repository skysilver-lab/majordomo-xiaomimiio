<?php
chdir(dirname(__FILE__) . '/../');

include_once("./config.php");
include_once("./lib/loader.php");
include_once("./lib/threads.php");

set_time_limit(0);

$db = new mysql(DB_HOST, '', DB_USER, DB_PASSWORD, DB_NAME);

include_once("./load_settings.php");
include_once(DIR_MODULES . "control_modules/control_modules.class.php");

$ctl = new control_modules();

include_once(DIR_MODULES . 'xiaomimiio/xiaomimiio.class.php');
include_once(DIR_MODULES . 'xiaomimiio/lib/miio.class.php');

$miio_module = new xiaomimiio();
$miio_module->getConfig();

echo date('H:i:s') . " running " . basename(__FILE__) . PHP_EOL;

$latest_check = 0;
$checkEvery = 5;

if ($miio_module->config['API_IP']) {
	$bind_ip = $miio_module->config['API_IP'];
} else {
    $bind_ip = '0.0.0.0';
}

if ($miio_module->config['API_LOG_MIIO']) {
	$debug = true;
} else {
    $debug = false;
}

$debug = false;
$dev = new miIO(null, $bind_ip, null, $debug);

while (1) {

	if ((time()-$latest_check) >= $checkEvery) {
		$latest_check = time();
		setGlobal((str_replace('.php', '', basename(__FILE__))) . 'Run', time(), 1);
	}

	$queue = SQLSelect("SELECT miio_queue.*, miio_devices.TOKEN, miio_devices.DEVICE_TYPE, miio_devices.IP FROM miio_queue LEFT JOIN miio_devices ON miio_queue.DEVICE_ID=miio_devices.ID ORDER BY miio_queue.ADDED");
    
	if ($queue[0]['ID']) {
        $total = count($queue);
        for ($i = 0; $i < $total; $i++) {

            echo date('H:i:s') . " Queue command: " . json_encode($queue[$i]) . PHP_EOL;
            SQLExec("DELETE FROM miio_queue WHERE ID=" . $queue[$i]['ID']);
            $reply = '';
			$dev->data = '';
            if ($queue[$i]['METHOD'] == 'discover_all') {
                // discover command
				// т.к. процесс не быстрый, чтобы не стопорить цикл в этом месте, лучше запускать поиск в дочернем процессе
				// /ajax/xiaomimiio.html?op=discover_all
                $dev->discover();
                $reply = $dev->data;
            } elseif ($queue[$i]['DEVICE_ID']) {
                // get status command
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
				//перед отправкой команды у-ву нужно задать разницу времени между сервером и локальным временем у-ва.
				//это значение уникально для каждого у-ва, поэтому логично его хранить в базе и обновлять при периодическом поиске или пинге.
				//это также избавит от необходимости слать hello-пакет перед каждой командой
                if($dev->msgSendRcv($queue[$i]['METHOD'], $queue[$i]['DATA'], time())) { //msgSendRcv($command, $parameters = NULL, $id = 1)
					$reply = $dev->data;
				} else {
					echo date('H:i:s') . " Reply: устройство не ответило на запрос \n";
				}
            }

            if ($reply != '') {
				echo date('H:i:s') . " Reply: $reply \n";
                $url = BASE_URL.'/ajax/xiaomimiio.html?op=process&command='.urlencode($queue[$i]['METHOD']).'&device_id='.$queue[$i]['DEVICE_ID'].'&message='.urlencode($reply);
                $res = get_headers($url);
            }
        }
    }

    $devices = SQLSelect("SELECT * FROM miio_devices WHERE UPDATE_PERIOD>0 AND NEXT_UPDATE<=NOW()");
    if ($devices[0]['ID']) {
		//echo date('Y-m-d H:i:s') . " Запрос статуса устройств" . PHP_EOL;
        $total = count($devices);
        for ($i = 0; $i < $total; $i++) {
            $devices[$i]['NEXT_UPDATE'] = date('Y-m-d H:i:s', time()+(int)$devices[$i]['UPDATE_PERIOD']);
            SQLUpdate('miio_devices', $devices[$i]);
			$id = $devices[$i]['ID'];
			echo date('H:i:s') . " Запрос статуса устройства ID$id" . PHP_EOL;
            $miio_module->requestStatus($devices[$i]['ID']);
		}
    }

	if (file_exists('./reboot') || IsSet($_GET['onetime'])) {
		$db->Disconnect();
		exit;
	}

	sleep(1);
}

DebMes("Unexpected close of cycle: " . basename(__FILE__));
