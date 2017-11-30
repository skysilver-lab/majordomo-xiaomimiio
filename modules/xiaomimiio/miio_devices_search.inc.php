<?php
/*
* @version 0.1 (wizard)
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
  
$res = SQLSelect("SELECT * FROM miio_devices WHERE $qry ORDER BY " . $sortby_miio_devices);

if ($res[0]['ID']) {
	//paging($res, 100, $out); // search result paging
	$total = count($res);
	for($i = 0; $i < $total; $i++) {
		// some action for every record if required
	}
	$out['RESULT'] = $res;
}
