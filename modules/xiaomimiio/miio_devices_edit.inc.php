<?php
/*
* @author <skysilver.da@gmail.com>
* @copyright 2017-2020 Agaphonov Dmitri aka skysilver <skysilver.da@gmail.com> (c)
* @version 3.0
*/

if ($this->owner->name == 'panel') {
	$out['CONTROLPANEL'] = 1;
}

$table_name = 'miio_devices';

$rec = SQLSelectOne("SELECT * FROM $table_name WHERE ID='$id'");

if ($this->mode == 'refresh') {
    $this->requestStatus($rec['ID']);
    sleep(2);
    $this->redirect("?view_mode=".$this->view_mode."&tab=".$this->tab."&id=".$rec['ID']);
}

if ($this->mode == 'update') {

	$this->getConfig();
	$ok = 1;

	if ($this->tab == '') {

		$rec['TITLE'] = gr('title');
		if ($rec['TITLE'] == '') {
			$out['ERR_TITLE'] = 1;
			$ok = 0;
		}

		$rec['IP'] = gr('ip');
		if ($rec['IP'] == '') {
			$out['ERR_IP'] = 1;
			$ok = 0;
		}

		$rec['TOKEN'] = gr('token');
		$device_type = gr('device_type');
		if ($device_type!='') {
            $rec['DEVICE_TYPE'] = $device_type;
        }

		$rec['UPDATE_PERIOD'] = gr('update_period','int');
		if ($rec['UPDATE_PERIOD'] > 0) {
			$rec['NEXT_UPDATE'] = date('Y-m-d H:i:s');
		}

      // Базовые метрики устройств
      $commands = array('online', 'command', 'message');

      // Специфичные метрики для некоторых устройств
      if ($rec['DEVICE_TYPE'] == 'lumi.gateway.v3') {
         $commands[] = 'add_program';
         $commands[] = 'del_program';
      } else if ($rec['DEVICE_TYPE'] == 'lumi.acpartner.v3') {
         $commands[] = 'add_program';
         $commands[] = 'del_program';
         $commands[] = 'ir_play';
         $commands[] = 'power';
         $commands[] = 'load_power';
      } else if ($rec['DEVICE_TYPE'] == 'chuangmi.ir.v2') {
         $commands[] = 'ir_play';
      } else if ($rec['DEVICE_TYPE'] == 'xiaomi.wifispeaker.v1') {
         $commands[] = 'vol_up';
         $commands[] = 'vol_down';
      } else if ($rec['DEVICE_TYPE'] == 'rockrobo.vacuum.v1' || $rec['DEVICE_TYPE'] == 'roborock.vacuum.s5') {
         $commands[] = 'goto_target';
         $commands[] = 'zoned_clean';
         if ($rec['DEVICE_TYPE'] == 'roborock.vacuum.s5') {
            $commands[] = 'segment_clean';
         }
      } else if ($rec['DEVICE_TYPE'] == 'hfjh.fishbowl.v1') {
         $commands[] = 'auto_feed';
         $commands[] = 'single_feed';
      } else if ($rec['DEVICE_TYPE'] == '090615.switch.xswitch03') {
         $commands[] = 'switch_all';
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

			// При сохранении настроек устройства выставим статус оффлайн
			$this->processCommand($rec['ID'], 'online', 0);
			
			if ($rec['DEVICE_TYPE'] == 'chuangmi.ir.v2') {
				//$this->processCommand($rec['ID'], 'freq', 38400);
			}

			// Если есть токен и IP, запросим сведения miIO.info, 
			if ($rec['TOKEN'] != '' && $rec['IP'] != '') {
				$this->requestInfo($rec['ID']);
				// а также, если определен тип устройства, то запросим текущие параметры (статус).
				if ($rec['DEVICE_TYPE'] != '') {
               $this->requestStatus($rec['ID']);
               if (($rec['DEVICE_TYPE'] == 'lumi.gateway.v3') || ($rec['DEVICE_TYPE'] == 'lumi.acpartner.v3')) {
                  $this->addToQueue($rec['ID'], 'get_lumi_dpf_aes_key', '[]');
                  $this->addToQueue($rec['ID'], 'get_zigbee_channel', '[]');
               }
            }
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

   $delete_id = gr('delete_id','int');
   if ($delete_id) {
      $prop = SQLSelectOne("SELECT LINKED_OBJECT,LINKED_PROPERTY FROM miio_commands WHERE ID='{$delete_id}'");
      removeLinkedProperty($prop['LINKED_OBJECT'], $prop['LINKED_PROPERTY'], $this->name);
      SQLExec("DELETE FROM miio_commands WHERE ID='{$delete_id}'");
   }
   
   if ($rec['DEVICE_TYPE'] == 'lumi.gateway.v3') {
      // Для шлюза на вкладку data выводим только определенные свойства, т.к. для свойств радио есть отдельная вкладка
      $properties = SQLSelect("SELECT * FROM miio_commands WHERE DEVICE_ID='" . $rec['ID'] . "' AND TITLE IN ('online','command','message','lumi_dpf_aes_key','zigbee_channel','arming_mode') ORDER BY TITLE");
   } else if ($rec['DEVICE_TYPE'] == 'lumi.acpartner.v3') {
      $properties = SQLSelect("SELECT * FROM miio_commands WHERE DEVICE_ID='" . $rec['ID'] . "' AND TITLE IN ('online','command','message','lumi_dpf_aes_key','zigbee_channel', 'ir_play', 'power', 'load_power','arming_mode') ORDER BY TITLE");
   } else {
      $properties = SQLSelect("SELECT * FROM miio_commands WHERE DEVICE_ID='" . $rec['ID'] . "' ORDER BY TITLE");
   }

   $total = count($properties);

   for($i = 0; $i < $total; $i++) {

      if ($this->mode == 'update') {

         $old_linked_object = $properties[$i]['LINKED_OBJECT'];
         $old_linked_property = $properties[$i]['LINKED_PROPERTY'];

         global ${'linked_object'.$properties[$i]['ID']};
         $properties[$i]['LINKED_OBJECT'] = trim(${'linked_object'.$properties[$i]['ID']});

         global ${'linked_property'.$properties[$i]['ID']};
         $properties[$i]['LINKED_PROPERTY'] = trim(${'linked_property'.$properties[$i]['ID']});

         global ${'linked_method'.$properties[$i]['ID']};
         $properties[$i]['LINKED_METHOD'] = trim(${'linked_method'.$properties[$i]['ID']});

         // Если юзер удалил привязанные свойство и метод, но забыл про объект, то очищаем его.
         if ($properties[$i]['LINKED_OBJECT'] != '' && ($properties[$i]['LINKED_PROPERTY'] == '' && $properties[$i]['LINKED_METHOD'] == '')) {
            $properties[$i]['LINKED_OBJECT'] = '';
         }

         // Если юзер удалил только привязанный объект, то свойство и метод тоже очищаем.
         if ($properties[$i]['LINKED_OBJECT'] == '' && ($properties[$i]['LINKED_PROPERTY'] != '' || $properties[$i]['LINKED_METHOD'] != '')) {
            $properties[$i]['LINKED_PROPERTY'] = '';
            $properties[$i]['LINKED_METHOD'] = '';
         }

         if ($old_linked_object && $old_linked_property && ($old_linked_property != $properties[$i]['LINKED_PROPERTY'] || $old_linked_object != $properties[$i]['LINKED_OBJECT'])) {
            removeLinkedProperty($old_linked_object, $old_linked_property, $this->name);
         }

         if ($properties[$i]['LINKED_OBJECT'] && $properties[$i]['LINKED_PROPERTY']) {
            addLinkedProperty($properties[$i]['LINKED_OBJECT'], $properties[$i]['LINKED_PROPERTY'], $this->name);
         }

         SQLUpdate('miio_commands', $properties[$i]);
      }

		if (file_exists(DIR_MODULES . 'devices/devices.class.php')) {
			if ($properties[$i]['TITLE'] == 'power') $properties[$i]['SDEVICE_TYPE'] = 'relay';
			elseif ($properties[$i]['TITLE'] == 'buzzer') $properties[$i]['SDEVICE_TYPE'] = 'relay';
			elseif ($properties[$i]['TITLE'] == 'wifi_led') $properties[$i]['SDEVICE_TYPE'] = 'relay';
			elseif ($properties[$i]['TITLE'] == 'usb_on') $properties[$i]['SDEVICE_TYPE'] = 'relay';
			elseif ($properties[$i]['TITLE'] == 'led') $properties[$i]['SDEVICE_TYPE'] = 'relay';
			elseif ($properties[$i]['TITLE'] == 'child_lock') $properties[$i]['SDEVICE_TYPE'] = 'relay';
			elseif ($properties[$i]['TITLE'] == 'bright') $properties[$i]['SDEVICE_TYPE'] = 'dimmer';
			elseif ($properties[$i]['TITLE'] == 'cct') $properties[$i]['SDEVICE_TYPE'] = 'dimmer';
			elseif ($properties[$i]['TITLE'] == 'ct') $properties[$i]['SDEVICE_TYPE'] = 'dimmer';
			elseif ($properties[$i]['TITLE'] == 'nl_br') $properties[$i]['SDEVICE_TYPE'] = 'dimmer';
			elseif ($properties[$i]['TITLE'] == 'rgb') $properties[$i]['SDEVICE_TYPE'] = 'rgb';
			elseif ($properties[$i]['TITLE'] == 'temperature') $properties[$i]['SDEVICE_TYPE'] = 'sensor_temp';
			elseif ($properties[$i]['TITLE'] == 'humidity') $properties[$i]['SDEVICE_TYPE'] = 'sensor_humidity';
			elseif ($properties[$i]['TITLE'] == 'illumination') $properties[$i]['SDEVICE_TYPE'] = 'sensor_light';
			elseif ($properties[$i]['TITLE'] == 'current') $properties[$i]['SDEVICE_TYPE'] = 'sensor_current';
			elseif ($properties[$i]['TITLE'] == 'power_consume_rate') $properties[$i]['SDEVICE_TYPE'] = 'sensor_power';
			elseif ($properties[$i]['TITLE'] == 'load_power') $properties[$i]['SDEVICE_TYPE'] = 'sensor_power';
			elseif ($properties[$i]['TITLE'] == 'aqi') $properties[$i]['SDEVICE_TYPE'] = 'sensor_state';
			elseif ($properties[$i]['TITLE'] == 'average_aqi') $properties[$i]['SDEVICE_TYPE'] = 'sensor_state';
			elseif ($properties[$i]['TITLE'] == 'favorite_level') $properties[$i]['SDEVICE_TYPE'] = 'dimmer';
			elseif ($properties[$i]['TITLE'] == 'filter1_life') $properties[$i]['SDEVICE_TYPE'] = 'sensor_percentage';
			elseif ($properties[$i]['TITLE'] == 'f1_hour_used') $properties[$i]['SDEVICE_TYPE'] = 'sensor_state';
			elseif ($properties[$i]['TITLE'] == 'use_time') $properties[$i]['SDEVICE_TYPE'] = 'sensor_state';
			elseif ($properties[$i]['TITLE'] == 'motor1_speed') $properties[$i]['SDEVICE_TYPE'] = 'sensor_state';
			elseif ($properties[$i]['TITLE'] == 'purify_volume') $properties[$i]['SDEVICE_TYPE'] = 'sensor_state';
			elseif ($properties[$i]['TITLE'] == 'f1_hour') $properties[$i]['SDEVICE_TYPE'] = 'sensor_state';
			elseif ($properties[$i]['TITLE'] == 'dry') $properties[$i]['SDEVICE_TYPE'] = 'relay';
			elseif ($properties[$i]['TITLE'] == 'depth') $properties[$i]['SDEVICE_TYPE'] = 'sensor_percentage';
			elseif ($properties[$i]['TITLE'] == 'speed') $properties[$i]['SDEVICE_TYPE'] = 'sensor_state';
			elseif ($properties[$i]['TITLE'] == 'flow') $properties[$i]['SDEVICE_TYPE'] = 'sensor_state';
			elseif ($properties[$i]['TITLE'] == 'flowing') $properties[$i]['SDEVICE_TYPE'] = 'sensor_state';
			elseif ($properties[$i]['TITLE'] == 'hue') $properties[$i]['SDEVICE_TYPE'] = 'sensor_state';
			elseif ($properties[$i]['TITLE'] == 'sat') $properties[$i]['SDEVICE_TYPE'] = 'sensor_state';
			elseif ($properties[$i]['TITLE'] == 'color_mode') $properties[$i]['SDEVICE_TYPE'] = 'sensor_state';
			elseif ($properties[$i]['TITLE'] == 'snm') $properties[$i]['SDEVICE_TYPE'] = 'sensor_state';
			elseif ($properties[$i]['TITLE'] == 'dv') $properties[$i]['SDEVICE_TYPE'] = 'sensor_state';
			elseif ($properties[$i]['TITLE'] == 'bl') $properties[$i]['SDEVICE_TYPE'] = 'sensor_state';
			elseif ($properties[$i]['TITLE'] == 'ac') $properties[$i]['SDEVICE_TYPE'] = 'sensor_state';
			elseif ($properties[$i]['TITLE'] == 'limit_hum') $properties[$i]['SDEVICE_TYPE'] = 'sensor_humidity';
			elseif ($properties[$i]['TITLE'] == 'voltage') $properties[$i]['SDEVICE_TYPE'] = 'sensor_voltage';
			elseif ($properties[$i]['TITLE'] == 'eyecare') $properties[$i]['SDEVICE_TYPE'] = 'relay';
			else    $properties[$i]['SDEVICE_TYPE'] = 'sensor_general';
		}
	}
	$out['PROPERTIES'] = $properties;
}

if ($this->tab == 'gwradio' && (($rec['DEVICE_TYPE'] == 'lumi.gateway.v3') || ($rec['DEVICE_TYPE'] == 'lumi.acpartner.v3'))) {

	$new_id = 0;
	$delete_id = gr('delete_id','int');
	if ($delete_id) {
		SQLExec("DELETE FROM miio_commands WHERE ID='" . (int)$delete_id . "'");
	}

	$properties = SQLSelect("SELECT * FROM miio_commands WHERE DEVICE_ID='" . $rec['ID'] . "' AND TITLE IN ('add_program','del_program','current_program','current_progress','current_volume','current_status','all_program') ORDER BY ID");

	$total = count($properties);

	for($i = 0; $i < $total; $i++) {
		if ($properties[$i]['ID'] == $new_id) continue;

		if ($this->mode == 'update') {

			$old_linked_object = $properties[$i]['LINKED_OBJECT'];
			$old_linked_property = $properties[$i]['LINKED_PROPERTY'];

			global ${'linked_object'.$properties[$i]['ID']};
			$properties[$i]['LINKED_OBJECT'] = trim(${'linked_object'.$properties[$i]['ID']});

			global ${'linked_property'.$properties[$i]['ID']};
			$properties[$i]['LINKED_PROPERTY'] = trim(${'linked_property'.$properties[$i]['ID']});

			global ${'linked_method'.$properties[$i]['ID']};
			$properties[$i]['LINKED_METHOD'] = trim(${'linked_method'.$properties[$i]['ID']});

			SQLUpdate('miio_commands', $properties[$i]);

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

if ($this->tab == '' && (($rec['DEVICE_TYPE'] == 'lumi.gateway.v3') || ($rec['DEVICE_TYPE'] == 'lumi.acpartner.v3'))) {

   $lanKey = SQLSelectOne("SELECT VALUE FROM miio_commands WHERE DEVICE_ID='" . $rec['ID'] . "' AND TITLE='lumi_dpf_aes_key'");

   if (!empty($lanKey) && isset($lanKey['VALUE']) && $lanKey['VALUE'] != '') {
      $out['LAN_KEY'] = $lanKey['VALUE'];
   } else {
      $out['LAN_KEY'] = '';
   }
}

if ($this->tab == 'help') {
	$out['LANG'] = SETTINGS_SITE_LANGUAGE;
	if ($rec['DEVICE_TYPE'] != '') {
		$devType = $rec['DEVICE_TYPE'];
	} else {
		$devType = 'unknown';
	}

	//$out['HELP_PATH'] = DIR_TEMPLATES . 'xiaomimiio/help/' . SETTINGS_SITE_LANGUAGE . '/help_' . $devType . '.html';
	$out['HELP_PATH'] = '/help/' . SETTINGS_SITE_LANGUAGE . '/help_' . $devType . '.html';

	// Проверим наличие файла-справки для текущего языка МДМ
	if (!file_exists($out['HELP_PATH'])) {
		// если файла нет, то выводим файл-справку на русском языке
		//$out['HELP_PATH'] = DIR_TEMPLATES . 'xiaomimiio/help/ru/help_' . $devType . '.html';
		$out['HELP_PATH'] = '/help/ru/help_' . $devType . '.html';
	}
}

if (is_array($rec)) {
	foreach($rec as $k => $v) {
		if (!is_array($v)) {
			$rec[$k] = htmlspecialchars($v);
		}
	}
}

outHash($rec, $out);
