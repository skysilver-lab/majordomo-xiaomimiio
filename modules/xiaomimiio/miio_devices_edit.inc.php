<?php
/*
* @author <skysilver.da@gmail.com>
* @copyright 2017-2018 Agaphonov Dmitri aka skysilver <skysilver.da@gmail.com> (c)
* @version 1.1b
*/

if ($this->owner->name == 'panel') {
	$out['CONTROLPANEL'] = 1;
}

$table_name = 'miio_devices';

$rec = SQLSelectOne("SELECT * FROM $table_name WHERE ID='$id'");

if ($this->mode == 'update') {

	$this->getConfig();
	$ok = 1;
	
	if ($this->tab == '') {

		global $title;
		$rec['TITLE'] = $title;
		if ($rec['TITLE'] == '') {
			$out['ERR_TITLE'] = 1;
			$ok = 0;
		}

		global $ip;
		$rec['IP'] = $ip;
		if ($rec['IP'] == '') {
			$out['ERR_IP'] = 1;
			$ok = 0;
		}
		
		global $token;
		$rec['TOKEN'] = $token;
		
		global $device_type;
		$rec['DEVICE_TYPE'] = $device_type;

		global $update_period;
		$rec['UPDATE_PERIOD'] = (int)$update_period;
		if ($rec['UPDATE_PERIOD'] > 0) {
			$rec['NEXT_UPDATE'] = date('Y-m-d H:i:s');
		}
			
		$commands = array('online', 'command', 'message');
		if ($rec['DEVICE_TYPE'] == 'lumi.gateway.v3') {
			$commands[] = 'add_program';
			$commands[] = 'del_program';
		}
		if ($rec['DEVICE_TYPE'] == 'chuangmi.ir.v2') {
			$commands[] = 'ir_play';
		}
		if ($rec['DEVICE_TYPE'] == 'xiaomi.wifispeaker.v1') {
			$commands[] = 'vol_up';
			$commands[] = 'vol_down';
		}
		
	}

	if ($ok) {
		if ($rec['ID']) {
			if ($this->config['API_LOG_DEBMES']) DebMes('Save params for device with IP ' . $rec['IP'], 'xiaomimiio');
			SQLUpdate($table_name, $rec);
		} else {
			if ($this->config['API_LOG_DEBMES']) DebMes('Manual add new device with IP ' . $rec['IP'], 'xiaomimiio');
			$rec['ID'] = SQLInsert($table_name, $rec);
		}
		
		$out['OK'] = 1;

		if ($this->tab == '') {
			foreach($commands as $cmd) {
				$cmd_rec = SQLSelectOne("SELECT * FROM miio_commands WHERE DEVICE_ID=" . $rec['ID'] . " AND TITLE = '" . $cmd . "'");
				if (!$cmd_rec['ID']) {
					$cmd_rec = array();
					$cmd_rec['TITLE'] = $cmd;
					$cmd_rec['DEVICE_ID'] = $rec['ID'];
					SQLInsert('miio_commands', $cmd_rec);
				}
			}
			
			// При сохранении настроек устройства выставим статус оффлайн, затем
			$this->processCommand($rec['ID'], 'online', 0);
			// если есть токен и IP, запросим сведения miIO.info, 
			if ($rec['TOKEN'] != '' && $rec['IP'] != '') {
				$this->requestInfo($rec['ID']);
				// а также, если определен тип устройства, то запросим текущие параметры (статус).
				if ((int)$update_period == 0 && $rec['DEVICE_TYPE'] != '') $this->requestStatus($rec['ID']);
				// Если тип устройства не указан, то пробуем получить тип устройства из miIO.info
				if ($rec['DEVICE_TYPE'] == '') {
					if ($this->config['API_LOG_DEBMES']) DebMes('Try to get device model from miIO.info for the device ' . $rec['IP'], 'xiaomimiio');
					
					$this->getConfig();
					
					if ($miio_module->config['API_IP']) $bind_ip = $miio_module->config['API_IP'];
					 else $bind_ip = '0.0.0.0';
					if ($miio_module->config['API_LOG_MIIO']) $miio_debug = true;
					 else $miio_debug = false;
					
					if (!class_exists('miIO', false)) {
						include_once(DIR_MODULES . 'xiaomimiio/lib/miio.class.php');
					}
					$midev = new miIO($rec['IP'], $bind_ip, $rec['TOKEN'], $miio_debug);
					if ($midev->getInfo(time())) {
						if ($midev->data != '') {
							$info = json_decode($midev->data, true);
							$dev_type = $info['result']['model'];
							if ($this->config['API_LOG_DEBMES']) DebMes($rec['IP'] . ' is ' . $dev_type, 'xiaomimiio');
							if ($dev_type != '') {
								$rec['DEVICE_TYPE'] = $dev_type;
								SQLUpdate($table_name, $rec);
								$this->requestStatus($rec['ID']);						
							}
						}
					}
				}
			}
		}
	} else {
		$out['ERR'] = 1;
	}
}

if ($this->tab == 'data') {

	$new_id = 0;
	global $delete_id;
	
	if ($delete_id) {
		SQLExec("DELETE FROM miio_commands WHERE ID='" . (int)$delete_id . "'");
	}
	
	if ($rec['DEVICE_TYPE'] == 'lumi.gateway.v3') {
		// Для шлюза на вкладку data выводим только определенные свойства, т.к. для свойств радио есть отдельная вкладка
		$properties = SQLSelect("SELECT * FROM miio_commands WHERE DEVICE_ID='" . $rec['ID'] . "' AND TITLE IN ('online','command','message','lumi_dpf_aes_key','zigbee_channel') ORDER BY ID");
	} else {
		$properties = SQLSelect("SELECT * FROM miio_commands WHERE DEVICE_ID='" . $rec['ID'] . "' ORDER BY ID");
	}
	
	$total = count($properties);
	
	for($i = 0; $i < $total; $i++) {
		if ($properties[$i]['ID'] == $new_id) continue;
		
		if ($this->mode == 'update') {
			
			global ${'linked_object'.$properties[$i]['ID']};
			$properties[$i]['LINKED_OBJECT'] = trim(${'linked_object'.$properties[$i]['ID']});
			
			global ${'linked_property'.$properties[$i]['ID']};
			$properties[$i]['LINKED_PROPERTY'] = trim(${'linked_property'.$properties[$i]['ID']});
			
			global ${'linked_method'.$properties[$i]['ID']};
			$properties[$i]['LINKED_METHOD'] = trim(${'linked_method'.$properties[$i]['ID']});
			
			SQLUpdate('miio_commands', $properties[$i]);
			
			$old_linked_object = $properties[$i]['LINKED_OBJECT'];
			$old_linked_property = $properties[$i]['LINKED_PROPERTY'];
			
			if ($old_linked_object && $old_linked_object != $properties[$i]['LINKED_OBJECT'] && $old_linked_property && $old_linked_property != $properties[$i]['LINKED_PROPERTY']) {
				removeLinkedProperty($old_linked_object, $old_linked_property, $this->name);
			}
		}
		
		$properties[$i]['VALUE'] = str_replace('",','", ',$properties[$i]['VALUE']);

		if ($properties[$i]['LINKED_OBJECT'] && $properties[$i]['LINKED_PROPERTY']) {
			addLinkedProperty($properties[$i]['LINKED_OBJECT'], $properties[$i]['LINKED_PROPERTY'], $this->name);
		}
	
		if (file_exists(DIR_MODULES . 'devices/devices.class.php')) {
			if ($properties[$i]['TITLE'] == 'power') {
				$properties[$i]['SDEVICE_TYPE'] = 'relay';
			}
			if ($properties[$i]['TITLE'] == 'buzzer') {
				$properties[$i]['SDEVICE_TYPE'] = 'relay';
			}
			if ($properties[$i]['TITLE'] == 'wifi_led') {
				$properties[$i]['SDEVICE_TYPE'] = 'relay';
			}
			if ($properties[$i]['TITLE'] == 'bright') {
				$properties[$i]['SDEVICE_TYPE'] = 'dimmer';
			}
			if ($properties[$i]['TITLE'] == 'cct') {
				$properties[$i]['SDEVICE_TYPE'] = 'dimmer';
			}
			if ($properties[$i]['TITLE'] == 'ct') {
				$properties[$i]['SDEVICE_TYPE'] = 'dimmer';
			}
			if ($properties[$i]['TITLE'] == 'rgb') {
				$properties[$i]['SDEVICE_TYPE'] = 'rgb';
			}
			if ($properties[$i]['TITLE'] == 'temperature') {
				$properties[$i]['SDEVICE_TYPE'] = 'sensor_temp';
			}
			if ($properties[$i]['TITLE'] == 'humidity') {
				$properties[$i]['SDEVICE_TYPE'] = 'sensor_humidity';
			}
			if ($properties[$i]['TITLE'] == 'current') {
				$properties[$i]['SDEVICE_TYPE'] = 'sensor_current';
			}
			if ($properties[$i]['TITLE'] == 'power_consume_rate') {
				$properties[$i]['SDEVICE_TYPE'] = 'sensor_power';
			}
		}
	}
	$out['PROPERTIES'] = $properties;   
}

if ($this->tab == 'gwradio' && $rec['DEVICE_TYPE'] == 'lumi.gateway.v3') {
	
	$new_id = 0;
	global $delete_id;
	
	if ($delete_id) {
		SQLExec("DELETE FROM miio_commands WHERE ID='" . (int)$delete_id . "'");
	}
	
	$properties = SQLSelect("SELECT * FROM miio_commands WHERE DEVICE_ID='" . $rec['ID'] . "' AND TITLE IN ('add_program','del_program','current_program','current_progress','current_volume','current_status','all_program') ORDER BY ID");
	
	$total = count($properties);
	
	for($i = 0; $i < $total; $i++) {
		if ($properties[$i]['ID'] == $new_id) continue;
					
		if ($this->mode == 'update') {
			
			global ${'linked_object'.$properties[$i]['ID']};
			$properties[$i]['LINKED_OBJECT'] = trim(${'linked_object'.$properties[$i]['ID']});
			
			global ${'linked_property'.$properties[$i]['ID']};
			$properties[$i]['LINKED_PROPERTY'] = trim(${'linked_property'.$properties[$i]['ID']});
			
			global ${'linked_method'.$properties[$i]['ID']};
			$properties[$i]['LINKED_METHOD'] = trim(${'linked_method'.$properties[$i]['ID']});
			
			SQLUpdate('miio_commands', $properties[$i]);
			
			$old_linked_object = $properties[$i]['LINKED_OBJECT'];
			$old_linked_property = $properties[$i]['LINKED_PROPERTY'];
			
			if ($old_linked_object && $old_linked_object != $properties[$i]['LINKED_OBJECT'] && $old_linked_property && $old_linked_property != $properties[$i]['LINKED_PROPERTY']) {
				removeLinkedProperty($old_linked_object, $old_linked_property, $this->name);
			}
		}
		
		$properties[$i]['VALUE'] = str_replace('",','", ',$properties[$i]['VALUE']);

		if ($properties[$i]['LINKED_OBJECT'] && $properties[$i]['LINKED_PROPERTY']) {
			addLinkedProperty($properties[$i]['LINKED_OBJECT'], $properties[$i]['LINKED_PROPERTY'], $this->name);
		}
	}
	$out['PROPERTIES'] = $properties;   

}

if (is_array($rec)) {
	foreach($rec as $k => $v) {
		if (!is_array($v)) {
			$rec[$k] = htmlspecialchars($v);
		}
	}
}

outHash($rec, $out);
