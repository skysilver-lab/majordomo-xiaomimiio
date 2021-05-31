<?php
/*
* @author <skysilver.da@gmail.com>
* @copyright 2017-2020 Agaphonov Dmitri aka skysilver <skysilver.da@gmail.com> (c)
* @version 3.0
*/

global $session;

if ($this->owner->name == 'panel') {
	$out['CONTROLPANEL'] = 1;
}

$qry = '1';

global $save_qry;

if ($save_qry) {
	$qry = $session->data['miio_devices_qry'];
} else {
	$session->data['miio_devices_qry'] = $qry;
}

if (!$qry) $qry = '1';

$sortby_miio_devices = 'ID DESC';

$out['SORTBY'] = $sortby_miio_devices;
  
$res = SQLSelect("SELECT * FROM miio_devices WHERE $qry ORDER BY $sortby_miio_devices");

if ($res[0]['ID']) {
	$total = count($res);
	for($i = 0; $i < $total; $i++) {
		$dev_id = $res[$i]['ID'];
		$online = SQLSelectOne("SELECT VALUE FROM miio_commands WHERE DEVICE_ID='$dev_id' AND TITLE='online'");
		$res[$i]['ONLINE'] = $online['VALUE'];
		$commands = SQLSelect("SELECT * FROM miio_commands WHERE LINKED_OBJECT!='' AND DEVICE_ID=".$dev_id);
		if ($commands[0]['ID']) {
			$res[$i]['COMMANDS']=$commands;
		}
	}
	$out['RESULT'] = $res;
}
