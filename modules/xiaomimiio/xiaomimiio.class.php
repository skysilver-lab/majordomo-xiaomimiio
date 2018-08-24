<?php
/**
* Xiaomi miIO
* @package project
* @author <skysilver.da@gmail.com>
* @copyright 2017-2018 Agaphonov Dmitri aka skysilver <skysilver.da@gmail.com> (c)
* @version 1.9b
*/

define ('MIIO_YEELIGHT_WHITE_BULB_PROPS', 'power,bright,flow_params,flowing');
define ('MIIO_YEELIGHT_COLOR_BULB_PROPS', 'power,bright,ct,rgb,hue,sat,color_mode,flow_params,flowing');
define ('MIIO_YEELIGHT_STRIP_PROPS', 'power,bright,ct,rgb,hue,sat,color_mode,flow_params,flowing');
define ('MIIO_YEELIGHT_CEILING_LIGHT_PROPS', 'power,bright,ct,nl_br,color_mode,flow_params,flowing');
define ('MIIO_YEELIGHT_LAMP_LIGHT_PROPS', 'power,bright,ct,flow_params,flowing');
define ('MIIO_YEELIGHT_BSLAMP1_PROPS', 'power,bright,ct,rgb,hue,sat,nl_br,color_mode,flow_params,flowing,pdo_status,save_state,nighttime,miband_sleep');

define ('MIIO_PHILIPS_LIGHT_BULB_PROPS', 'power,bright,cct,snm,dv');
define ('MIIO_PHILIPS_LIGHT_CANDLE_PROPS', 'power,bright,cct');
define ('MIIO_PHILIPS_LIGHT_CEILING_PROPS', 'power,bright,cct,snm,dv,bl,ac');

define ('MIIO_PHILIPS_EYECARE_LAMP_2_PROPS', 'power,bright,notifystatus,ambstatus,ambvalue,eyecare,scene_num,bls,dvalue');

define ('MIIO_CHUANGMI_PLUG_M1_PROPS', 'power,temperature');
define ('MIIO_CHUANGMI_PLUG_V1_PROPS', 'power,temperature,usb_on,wifi_led');

define ('MIIO_ZIMI_POWERSTRIP_2_PROPS', 'power,temperature,current,power_consume_rate,wifi_led');

define ('MIIO_ZHIMI_HUMIDIFIER_PROPS', 'power,humidity,temp_dec,mode,led_b,buzzer');
define ('MIIO_ZHIMI_HUMIDIFIER_2_PROPS', 'power,humidity,temp_dec,mode,depth,speed,dry,use_time,led_b,buzzer,child_lock,limit_hum');

define ('MIIO_ZHIMI_AIRPURIFIER_MA2_PROPS', 'power,aqi,average_aqi,humidity,temp_dec,bright,mode,favorite_level,filter1_life,use_time,purify_volume,led,buzzer,child_lock');

define ('MIIO_MIWIFISPEAKER_V1_PROPS', 'umi,volume,rel_time');

define ('MIIO_MIVACUUM_1_STATE_CODES', serialize (array('0' =>	'Unknown',
                                          '1' =>   'Initiating',
                                          '2' =>   'Sleeping',
                                          '3' =>   'Waiting',
                                          '4' =>   'Remote control active',
                                          '5' =>   'Cleaning',
                                          '6' =>   'Back to home',
                                          '7' =>   'Manual mode',
                                          '8' =>   'Charging',
                                          '9' =>   'Charging Error',
                                          '10' => 'Pause',
                                          '11' => 'Spot Cleaning',
                                          '12' => 'In Error',
                                          '13' => 'Shutting down',
                                          '14' => 'Updating',
                                          '15' => 'Docking',
                                          '16' => 'Going to target',
                                          '17' => 'Zoned cleaning',
                                          '100' => 'Full',
                                          '101' => 'Wet cleaning',
                                          '105' => 'Turbo')));

define ('MIIO_MIVACUUM_1_ERROR_CODES', serialize (array('0' =>	'No error',
														'1' => 	'Laser distance sensor error',
														'2' => 	'Collision sensor error',
														'3' => 	'Wheels on top of void, move robot',
														'4' => 	'Clean hovering sensors, move robot',
														'5' => 	'Clean main brush',
														'6' => 	'Clean side brush',
														'7' => 	'Main wheel stuck',
														'8' => 	'Device stuck, clean area',
														'9' => 	'Dust collector missing',
														'10' => 'Clean filter',
														'11' => 'Stuck in magnetic barrier',
														'12' => 'Low battery',
														'13' => 'Charging fault',
														'14' => 'Battery fault',
														'15' => 'Wall sensors dirty, wipe them',
														'16' => 'Place me on flat surface',
														'17' => 'Side brushes problem, reboot me',
														'18' => 'Suction fan problem',
														'19' => 'Unpowered charging station')));
					
class xiaomimiio extends module {

	/**
	* xiaomimiio
	*
	* Module class constructor
	*
	* @access private
	*/

	function xiaomimiio() {
		$this->name = 'xiaomimiio';
		$this->title = 'Xiaomi miIO';
		$this->module_category = '<#LANG_SECTION_DEVICES#>';
		$this->checkInstalled();
	}
	
	/**
	* saveParams
	*
	* Saving module parameters
	*
	* @access public
	*/
	
	function saveParams($data = 0) {
		
		$p = array();
		
		if (IsSet($this->id)) {
			$p['id'] = $this->id;
		}
		if (IsSet($this->view_mode)) {
			$p['view_mode'] = $this->view_mode;
		}
		if (IsSet($this->edit_mode)) {
			$p['edit_mode'] = $this->edit_mode;
		}
		if (IsSet($this->data_source)) {
			$p['data_source'] = $this->data_source;
		}
		if (IsSet($this->tab)) {
			$p['tab'] = $this->tab;
		}
		
		return parent::saveParams($p);
		
	}
	
	/**
	* getParams
	*
	* Getting module parameters from query string
	*
	* @access public
	*/
	function getParams() {
  
		global $id;
		global $mode;
		global $view_mode;
		global $edit_mode;
		global $data_source;
		global $tab;
		
		if (isset($id)) {
			$this->id = $id;
		}
		if (isset($mode)) {
			$this->mode = $mode;
		}
		if (isset($view_mode)) {
			$this->view_mode = $view_mode;
		}
		if (isset($edit_mode)) {
			$this->edit_mode = $edit_mode;
		}
		if (isset($data_source)) {
			$this->data_source = $data_source;
		}
		if (isset($tab)) {
			$this->tab = $tab;
		}
	}

	/**
	* Run
	*
	* Description
	*
	* @access public
	*/
	
	function run() {
		
		global $session;
		
		$out = array();
		
		if ($this->action == 'admin') {
			$this->admin($out);
		} else {
			$this->usual($out);
		}
		
		if (IsSet($this->owner->action)) {
			$out['PARENT_ACTION'] = $this->owner->action;
		}
  
		if (IsSet($this->owner->name)) {
			$out['PARENT_NAME'] = $this->owner->name;
		}
  
		$out['VIEW_MODE'] = $this->view_mode;
		$out['EDIT_MODE'] = $this->edit_mode;
		$out['MODE'] = $this->mode;
		$out['ACTION'] = $this->action;
		$out['DATA_SOURCE'] = $this->data_source;
		$out['TAB'] = $this->tab;
		
		$this->data = $out;
		
		$p = new parser(DIR_TEMPLATES . $this->name . '/' . $this->name . '.html', $this->data, $this);
		$this->result = $p->result;
	}

	/**
	* BackEnd
	*
	* Module backend
	*
	* @access public
	*/
	
	function admin(&$out) {
 
		$this->getConfig();
 
		$out['API_IP'] = $this->config['API_IP'];
		$out['API_DISC_PERIOD'] = $this->config['API_DISC_PERIOD'];
		$out['API_LOG_DEBMES'] = $this->config['API_LOG_DEBMES'];
		$out['API_LOG_CYCLE'] = $this->config['API_LOG_CYCLE'];
		$out['API_LOG_MIIO'] = $this->config['API_LOG_MIIO'];
		
		if ((time() - gg('cycle_xiaomimiioRun')) < 15 ) {
			$out['CYCLERUN'] = 1;
		} else {
			$out['CYCLERUN'] = 0;
		}
		
		if ($this->view_mode == 'update_settings') {
			
			global $api_ip;
			$this->config['API_IP'] = $api_ip;
			
			global $api_disc_period;
			$this->config['API_DISC_PERIOD'] = (int)$api_disc_period;

			global $api_log_debmes;
			$this->config['API_LOG_DEBMES'] = (int)$api_log_debmes;
		
			global $api_log_cycle;
			$this->config['API_LOG_CYCLE'] = (int)$api_log_cycle;
			
			global $api_log_miio;
			$this->config['API_LOG_MIIO'] = (int)$api_log_miio;

			$this->saveConfig();
			
			// После изменения настроек модуля перезапускаем цикл
			setGlobal('cycle_xiaomimiioControl', 'restart');

			$this->redirect("?");
		}
	
		if (isset($this->data_source) && !$_GET['data_source'] && !$_POST['data_source']) {
			$out['SET_DATASOURCE'] = 1;
		}
 
		if ($this->data_source == 'miio_devices' || $this->data_source == '') {
			
			if ($this->view_mode == '' || $this->view_mode == 'search_miio_devices') {
				$this->search_miio_devices($out);
			}

			if ($this->view_mode == 'discover') {
				if ($this->config['API_LOG_DEBMES']) DebMes('Starting manual search for devices in the network', 'xiaomimiio');
				$this->discover();
				if ($this->config['API_LOG_DEBMES']) DebMes('Manual search for devices in the network is finished', 'xiaomimiio');
				$this->redirect('?');
			}

			if ($this->view_mode == 'propupd_miio_devices') {
				if ($this->config['API_LOG_DEBMES']) DebMes('Starting manual update the properties of the device', 'xiaomimiio');
				$this->requestStatus($this->id);
				if ($this->config['API_LOG_DEBMES']) DebMes('Manual update the properties of the device is finished', 'xiaomimiio');
				$this->redirect('?');
			}
			
			if ($this->view_mode == 'edit_miio_devices') {
				$this->edit_miio_devices($out, $this->id);
			}
			
			if ($this->view_mode == 'delete_miio_devices') {
				$this->delete_miio_devices($this->id);
				$this->redirect('?data_source=miio_devices');
			}
		}
	}

	/**
	* addToQueue
	*
	* Добавление команды в очередь
	*
	* @access private
	*/
	
	function addToQueue($device_id, $method, $data = '[]') {
	
		$rec = array();
		$rec['DEVICE_ID'] = (int)$device_id;
		$rec['METHOD'] = $method;
		$rec['DATA'] = $data;
		$rec['ADDED'] = date('Y-m-d H:i:s');
		
		SQLInsert('miio_queue', $rec);
	
	}

	/**
	* discover
	*
	* Поиск miIO-устройств в локальной сети
	*
	* @access public
	*/

	function discover($ip = '') {

		$this->getConfig();
 
		if ($miio_module->config['API_IP']) $bind_ip = $miio_module->config['API_IP'];
		 else $bind_ip = '0.0.0.0';
		if ($miio_module->config['API_LOG_MIIO']) $miio_debug = true;
		 else $miio_debug = false;

		if (!class_exists('miIO', false)) {
			include_once(DIR_MODULES . 'xiaomimiio/lib/miio.class.php');
		}

		$midev = new miIO(null, $bind_ip, null, $miio_debug);

		// Выполняем broadcast-поиск устройств в локальной сети
		if ($this->config['API_LOG_DEBMES']) DebMes("Run miIO-discover command", 'xiaomimiio');
		$res = $midev->discover();
		if ($this->config['API_LOG_DEBMES']) DebMes("End miIO-discover command", 'xiaomimiio');

		if ($res) {
			// Обрабатываем результат поиска
			$reply = $midev->data;

			if ($reply != '') {
				if ($this->config['API_LOG_DEBMES']) DebMes("Reply = $reply", 'xiaomimiio');

				$all_devices = SQLSelect('SELECT * FROM miio_devices');
				$count_devices = count($all_devices);
				if ($this->config['API_LOG_DEBMES']) DebMes("Current count of devices $count_devices", 'xiaomimiio');
				$found_devices = json_decode($reply, true);

				if (is_array($found_devices['devices'])) {
					foreach($found_devices['devices'] as $dev) {
						$dev = json_decode($dev, true);
						$ip = $dev['ip'];
						$device_type_code = $dev['devicetype'];
						$device_serial = $dev['serial'];
						$token = $dev['token'];

						if (preg_match('/^[0fF]+$/', $token)) $token = '';

						if (preg_match('/^[0fF]+$/', $device_type_code) || preg_match('/^[0fF]+$/', $device_serial)) {
							if ($this->config['API_LOG_DEBMES']) DebMes("Device $ip has wrong type code $device_type_code and serial number $device_serial", 'xiaomimiio');
							continue;
						}

						//TODO: новые сравниваются по sid и devcode, но если устройство было добавлено вручную, то эти параметры будут отсутствовать,
						//соотвественно устройство добавится как новое, а не перезапишет (обновит) добавленно вручную.
						$dev_rec = SQLSelectOne("SELECT * FROM miio_devices WHERE DEVICE_TYPE_CODE='$device_type_code' AND SERIAL='$device_serial'");

						if ($dev_rec['ID']) {
							// Если устройство уже есть в БД, то обновим его IP, токен и свойство online
							$dev_rec['IP'] = $ip;
							if ($token != '') $dev_rec['TOKEN'] = $token;

							if ($this->config['API_LOG_DEBMES']) DebMes("Update the ip address and the token for the device $ip", 'xiaomimiio');
							SQLUpdate('miio_devices', $dev_rec);

							// Ответившее устройство выкинем из претендентов на оффлайн
							for ($i = 0; $i < $count_devices; $i++) {
								if ($dev_rec['ID'] == $all_devices[$i]['ID']) {
									unset($all_devices[$i]);
									break;
								}
							}

							$this->processCommand($dev_rec['ID'], 'online', 1);
						} else {
							// Если устройство нет в БД, то добавим его
							$dev_rec = array();
							$dev_rec['IP'] = $ip;
							if ($token != '') $dev_rec['TOKEN'] = $token;

							$dev_rec['SERIAL'] = $device_serial;
							$dev_rec['DEVICE_TYPE_CODE'] = $device_type_code;
							$dev_rec['TITLE'] = 'New ' . $dev_rec['DEVICE_TYPE_CODE'];
							if ($this->config['API_LOG_DEBMES']) DebMes("Add new device with $ip", 'xiaomimiio');

							// Если есть токен, то пробуем получить тип устройства из miIO.info
							if ($dev_rec['TOKEN']) {
								if ($this->config['API_LOG_DEBMES']) DebMes('Try to get device model from miIO.info for the device ' . $dev_rec['IP'], 'xiaomimiio');
								$midev->data = '';
								$midev->ip = $dev_rec['IP'];
								$midev->token = $dev_rec['TOKEN'];
								if ($midev->getInfo(time())) {
									if ($midev->data != '') {
										$info = json_decode($midev->data, true);
										$dev_type = $info['result']['model'];
										if ($this->config['API_LOG_DEBMES']) DebMes($dev_rec['IP'] . ' is ' . $dev_type, 'xiaomimiio');
										if ($dev_type != '') $dev_rec['DEVICE_TYPE'] = $dev_type;
									}
								}
							}

                     $dev_rec['ID'] = SQLInsert('miio_devices', $dev_rec);

                     // Базовые метрики устройств
                     $this->processCommand($dev_rec['ID'], 'online', 1);
                     $this->processCommand($dev_rec['ID'], 'command', '');
                     $this->processCommand($dev_rec['ID'], 'message', '');

                     // Специфичные метрики для некоторых устройств
                     if ($dev_rec['DEVICE_TYPE'] != '') {
                        $this->requestStatus($dev_rec['ID']);
                        if (($dev_rec['DEVICE_TYPE'] == 'lumi.gateway.v3') || ($dev_rec['DEVICE_TYPE'] == 'lumi.acpartner.v3')) {
                           $this->processCommand($dev_rec['ID'], 'add_program', '');
                           $this->processCommand($dev_rec['ID'], 'del_program', '');
                           $this->processCommand($dev_rec['ID'], 'get_arming', '');
                        } else if ($dev_rec['DEVICE_TYPE'] == 'chuangmi.ir.v2' || $dev_rec['DEVICE_TYPE'] == 'lumi.acpartner.v3') {
                           $this->processCommand($dev_rec['ID'], 'ir_play', '');
                        } else if ($dev_rec['DEVICE_TYPE'] == 'xiaomi.wifispeaker.v1') {
                           $this->processCommand($dev_rec['ID'], 'vol_up', '');
                           $this->processCommand($dev_rec['ID'], 'vol_down', '');
                        } else if ($dev_rec['DEVICE_TYPE'] == 'lumi.acpartner.v3') {
                           $this->processCommand($dev_rec['ID'], 'power', '');
                           $this->processCommand($dev_rec['ID'], 'load_power', '');
                        }  else if ($dev_rec['DEVICE_TYPE'] == 'rockrobo.vacuum.v1' || $dev_rec['DEVICE_TYPE'] == 'roborock.vacuum.s5') {
                           $this->processCommand($dev_rec['ID'], 'goto_target', '');
                           $this->processCommand($dev_rec['ID'], 'zoned_clean', '');
                        }
                     }
						}
					}
				}
			
				// Для имеющихся в БД, но не ответивших, устройств выставим свойство online в 0 (оффлайн)
				$count_devices = count($all_devices);
				if ($this->config['API_LOG_DEBMES']) DebMes("Current count of offline devices $count_devices", 'xiaomimiio');

				if (count($all_devices) > 0) {
					foreach($all_devices as $dev) {
						$ip = $dev['IP'];
						if ($this->config['API_LOG_DEBMES']) DebMes("Device $ip is offline", 'xiaomimiio');
						$this->processCommand($dev['ID'], 'online', 0);
					}
				}
			}
		} else {
			if ($this->config['API_LOG_DEBMES']) DebMes('Not received any response from devices', 'xiaomimiio');
		}

	}

	/**
	* requestInfo
	*
	* Запрос сведений miIO.info
	*
	* @access public
	*/
	
	function requestInfo($device_id) {
	
		$this->addToQueue($device_id, 'miIO.info');
	
	}

	/**
	* requestStatus
	*
	* Запрос статусов устройств
	*
	* @access public
	*/

	function requestStatus($device_id) {
		
		$device_rec = SQLSelectOne("SELECT * FROM miio_devices WHERE ID=" . (int)$device_id);

		if (($device_rec['DEVICE_TYPE'] == 'philips.light.bulb') || ($device_rec['DEVICE_TYPE'] == 'philips.light.downlight')) {
			//
			$props = explode(',', MIIO_PHILIPS_LIGHT_BULB_PROPS);
			$total = count($props);
			for ($i = 0; $i < $total; $i++) {
				$props[$i] = '"' . $props[$i] . '"';
			}
			$this->addToQueue($device_id, 'get_prop', '['.implode(',',$props).']');
		} elseif ($device_rec['DEVICE_TYPE'] == 'philips.light.candle') {
			//
			$props = explode(',', MIIO_PHILIPS_LIGHT_CANDLE_PROPS);
			$total = count($props);
			for ($i = 0; $i < $total; $i++) {
				$props[$i] = '"' . $props[$i] . '"';
			}
			$this->addToQueue($device_id, 'get_prop', '['.implode(',',$props).']');
		} elseif ($device_rec['DEVICE_TYPE'] == 'philips.light.sread1') {
			//
			$props = explode(',', MIIO_PHILIPS_EYECARE_LAMP_2_PROPS);
			$total = count($props);
			for ($i = 0; $i < $total; $i++) {
				$props[$i] = '"' . $props[$i] . '"';
			}
			$this->addToQueue($device_id, 'get_prop', '['.implode(',',$props).']');
		} elseif ($device_rec['DEVICE_TYPE'] == 'yeelink.light.mono1') {
			//
			$props = explode(',', MIIO_YEELIGHT_WHITE_BULB_PROPS);
			$total = count($props);
			for ($i = 0; $i < $total; $i++) {
				$props[$i] = '"' . $props[$i] . '"';
			}
			$this->addToQueue($device_id, 'get_prop', '[' . implode(',', $props) . ']');
		} elseif ($device_rec['DEVICE_TYPE'] == 'yeelink.light.color1') {
			//
			$props = explode(',', MIIO_YEELIGHT_COLOR_BULB_PROPS);
			$total = count($props);
			for ($i = 0; $i < $total; $i++) {
				$props[$i] = '"' . $props[$i] . '"';
			}
			$this->addToQueue($device_id, 'get_prop', '[' . implode(',', $props) . ']');
		} else if (($device_rec['DEVICE_TYPE'] == 'rockrobo.vacuum.v1') || ($device_rec['DEVICE_TYPE'] == 'roborock.vacuum.s5')) {
         //
         $this->addToQueue($device_id, 'get_status');
         sleep(1);
         $this->addToQueue($device_id, 'get_consumable');
         sleep(1);
         $this->addToQueue($device_id, 'get_custom_mode');
		} elseif ($device_rec['DEVICE_TYPE'] == 'chuangmi.plug.m1') {
			//
			$props = explode(',', MIIO_CHUANGMI_PLUG_M1_PROPS);
			$total = count($props);
			for ($i = 0; $i < $total; $i++) {
				$props[$i] = '"' . $props[$i] . '"';
			}
			$this->addToQueue($device_id, 'get_prop', '[' . implode(',', $props) . ']');
		} elseif (($device_rec['DEVICE_TYPE'] == 'chuangmi.plug.v1') || ($device_rec['DEVICE_TYPE'] == 'chuangmi.plug.v3')) {
			//
			$props = explode(',', MIIO_CHUANGMI_PLUG_V1_PROPS);
			$total = count($props);
			for ($i = 0; $i < $total; $i++) {
				$props[$i] = '"' . $props[$i] . '"';
			}
			$this->addToQueue($device_id, 'get_prop', '[' . implode(',', $props) . ']');
			if ($device_rec['DEVICE_TYPE'] == 'chuangmi.plug.v3') {
				sleep(1);
				$this->addToQueue($device_id, 'get_power');
			}
		} elseif (($device_rec['DEVICE_TYPE'] == 'lumi.gateway.v3') || ($device_rec['DEVICE_TYPE'] == 'lumi.acpartner.v3')) {
			//
         if ($device_rec['DEVICE_TYPE'] == 'lumi.acpartner.v3') {
            $this->addToQueue($device_id, 'get_device_prop', '["lumi.0","ac_power"]');
         }
         $this->addToQueue($device_id, 'get_prop_fm', '[]');
			if ($this->view_mode == 'propupd_miio_devices') {
				$this->addToQueue($device_id, 'get_lumi_dpf_aes_key', '[]');
				$this->addToQueue($device_id, 'get_zigbee_channel', '[]');
			}
			$this->addToQueue($device_id, 'get_arming', '[]');
			$this->addToQueue($device_id, 'get_channels', '{"start":0}');
         //TODO: $this->addToQueue($device_id, 'get_channels', '{"start":10}');
         //      Если станций больше 10, 20.
		} elseif ($device_rec['DEVICE_TYPE'] == 'philips.light.ceiling') {
			//
			$props = explode(',', MIIO_PHILIPS_LIGHT_CEILING_PROPS);
			$total = count($props);
			for ($i = 0; $i < $total; $i++) {
				$props[$i] = '"' . $props[$i] . '"';
			}
			$this->addToQueue($device_id, 'get_prop', '['.implode(',',$props).']');
		} elseif ($device_rec['DEVICE_TYPE'] == 'yeelink.light.ceiling1') {
			//
			$props = explode(',', MIIO_YEELIGHT_CEILING_LIGHT_PROPS);
			$total = count($props);
			for ($i = 0; $i < $total; $i++) {
				$props[$i] = '"' . $props[$i] . '"';
			}
			$this->addToQueue($device_id, 'get_prop', '[' . implode(',', $props) . ']');
		} elseif ($device_rec['DEVICE_TYPE'] == 'yeelink.light.lamp1') {
			//
			$props = explode(',', MIIO_YEELIGHT_LAMP_LIGHT_PROPS);
			$total = count($props);
			for ($i = 0; $i < $total; $i++) {
				$props[$i] = '"' . $props[$i] . '"';
			}
			$this->addToQueue($device_id, 'get_prop', '[' . implode(',', $props) . ']');
		} elseif ($device_rec['DEVICE_TYPE'] == 'yeelink.light.strip1') {
			//
			$props = explode(',', MIIO_YEELIGHT_STRIP_PROPS);
			$total = count($props);
			for ($i = 0; $i < $total; $i++) {
				$props[$i] = '"' . $props[$i] . '"';
			}
			$this->addToQueue($device_id, 'get_prop', '[' . implode(',', $props) . ']');
		} elseif ($device_rec['DEVICE_TYPE'] == 'zimi.powerstrip.v2') {
			//
			$props = explode(',', MIIO_ZIMI_POWERSTRIP_2_PROPS);
			$total = count($props);
			for ($i = 0; $i < $total; $i++) {
				$props[$i] = '"' . $props[$i] . '"';
			}
			$this->addToQueue($device_id, 'get_prop', '[' . implode(',', $props) . ']');
		} elseif ($device_rec['DEVICE_TYPE'] == 'zhimi.humidifier.v1') {
			//
			$props = explode(',', MIIO_ZHIMI_HUMIDIFIER_PROPS);
			$total = count($props);
			for ($i = 0; $i < $total; $i++) {
				$props[$i] = '"' . $props[$i] . '"';
			}
			$this->addToQueue($device_id, 'get_prop', '[' . implode(',', $props) . ']');
		} elseif ($device_rec['DEVICE_TYPE'] == 'zhimi.humidifier.ca1') {
			//
			$props = explode(',', MIIO_ZHIMI_HUMIDIFIER_2_PROPS);
			$total = count($props);
			for ($i = 0; $i < $total; $i++) {
				$props[$i] = '"' . $props[$i] . '"';
			}
			$this->addToQueue($device_id, 'get_prop', '[' . implode(',', $props) . ']');
		} elseif ($device_rec['DEVICE_TYPE'] == 'zhimi.airpurifier.ma2') {
			//
			$props = explode(',', MIIO_ZHIMI_AIRPURIFIER_MA2_PROPS);
			$total = count($props);
			for ($i = 0; $i < $total; $i++) {
				$props[$i] = '"' . $props[$i] . '"';
			}
			$this->addToQueue($device_id, 'get_prop', '[' . implode(',', $props) . ']');
		} elseif ($device_rec['DEVICE_TYPE'] == 'yeelink.light.bslamp1') {
			//
			$props = explode(',', MIIO_YEELIGHT_BSLAMP1_PROPS);
			$total = count($props);
			for ($i = 0; $i < $total; $i++) {
				$props[$i] = '"' . $props[$i] . '"';
			}
			$this->addToQueue($device_id, 'get_prop', '[' . implode(',', $props) . ']');
		} elseif ($device_rec['DEVICE_TYPE'] == 'xiaomi.wifispeaker.v1') {
			//
			$props = explode(',', MIIO_MIWIFISPEAKER_V1_PROPS);
			$total = count($props);
			for ($i = 0; $i < $total; $i++) {
				$props[$i] = '"' . $props[$i] . '"';
			}
			$this->addToQueue($device_id, 'get_prop', '[' . implode(',', $props) . ']');
		}

	}

	/**
	* FrontEnd
	*
	* Module frontend
	*
	* @access public
	*/

	function usual(&$out) {

		if ($this->ajax) {
			global $op;
			if ($op == 'process') {
				global $device_id;
				global $message;
				global $command;
				$this->processMessage($message, $command, $device_id);
			} else if ($op == 'broadcast_search') {
				$this->getConfig();
				if ($this->config['API_LOG_DEBMES']) DebMes('Starting periodic search for devices in the network', 'xiaomimiio');
				$this->discover();
				if ($this->config['API_LOG_DEBMES']) DebMes('Periodic search for devices in the network is finished', 'xiaomimiio');
			} else if ($op == 'get_miio_info') {

				$dip = $_GET['dip'];
				$dtoken = $_GET['dtoken'];

				header("HTTP/1.0: 200 OK\n");
				header('Content-Type: text/html; charset=utf-8');

				if (!class_exists('miIO', false)) {
					include_once(DIR_MODULES . 'xiaomimiio/lib/miio.class.php');
				}
				$this->getConfig();

				if ($miio_module->config['API_IP']) $bind_ip = $miio_module->config['API_IP'];
				 else $bind_ip = '0.0.0.0';
				if ($miio_module->config['API_LOG_MIIO']) $miio_debug = true;
				 else $miio_debug = false;

				$dev = new miIO($dip, $bind_ip, $dtoken, $miio_debug);

				if ($dev->getInfo(time())) {
					if ($dev->data == '') $info = 'Сведения miIO.info не получены. Вероятно, указан неверный токен.';
					 else $info = $dev->data;
				} else $info = 'Что-то пошло не так...';

				echo $info;
				exit;
			} else if ($op == 'test_api_cmd') {

				$dip = $_GET['dip'];
				$dtoken = $_GET['dtoken'];
				$cmd = $_GET['dcmd'];
				$opt = $_GET['dopt'];

				header("HTTP/1.0: 200 OK\n");
				header('Content-Type: text/html; charset=utf-8');

				if (!class_exists('miIO', false)) {
					include_once(DIR_MODULES . 'xiaomimiio/lib/miio.class.php');
				}
				$this->getConfig();

				if ($miio_module->config['API_IP']) $bind_ip = $miio_module->config['API_IP'];
				 else $bind_ip = '0.0.0.0';
				if ($miio_module->config['API_LOG_MIIO']) $miio_debug = true;
				 else $miio_debug = false;

				$dev = new miIO($dip, $bind_ip, $dtoken, $miio_debug);

				if ($dev->msgSendRcv($cmd, $opt, time())) {
					if ($dev->data == '') $info = 'Результат выполнения команды не получен. Вероятно, указан неверный токен.';
					 else $info = $dev->data;
				} else $info = 'Что-то пошло не так...';

				echo $info;
				exit;
			} else if ($op == 'prop_update') {
            $did = $_GET['did'];
            $this->requestStatus($did);
            if ($this->config['API_LOG_DEBMES']) DebMes('Manual update the properties of the device ' . $did, 'xiaomimiio');
         } else if ($op == 'single_prop_update') {
            $did = $_GET['did'];
            $cmd = $_GET['dcmd'];
            $opt = $_GET['dopt'];
            $this->addToQueue($did, $cmd, $opt);
            $this->getConfig();
            if ($this->config['API_LOG_DEBMES']) DebMes('Manual update the one propertie ' . $cmd . 'of the device ' . $did, 'xiaomimiio');
         }
			echo 'OK';
			exit;
		}
	}

	/**
	* miio_devices search
	*
	* @access public
	*/
	
	function search_miio_devices(&$out) {
	
		require(DIR_MODULES.$this->name . '/miio_devices_search.inc.php');

	}

	/**
	* miio_devices edit/add
	*
	* @access public
	*/
	
	function edit_miio_devices(&$out, $id) {

		require(DIR_MODULES.$this->name . '/miio_devices_edit.inc.php');
	
	}

	/**
	* miio_devices delete record
	*
	* @access public
	*/
	
	function delete_miio_devices($id) {

		$rec = SQLSelectOne("SELECT * FROM miio_devices WHERE ID='$id'");

		SQLExec("DELETE FROM miio_commands WHERE DEVICE_ID='" . $rec['ID'] . "'");
		SQLExec("DELETE FROM miio_devices WHERE ID='" . $rec['ID'] . "'");

	}
	
	/**
	* propertySetHandle
	*
	* Обработчик привязанных свойств и методов
	*
	* @access private
	*/
	
	function propertySetHandle($object, $property, $value) {
	
		$this->getConfig();
		
		$table = 'miio_commands';
	
		$properties = SQLSelect("SELECT miio_commands.*, miio_devices.TOKEN, miio_devices.DEVICE_TYPE FROM miio_commands LEFT JOIN miio_devices ON miio_devices.ID=miio_commands.DEVICE_ID WHERE miio_commands.LINKED_OBJECT LIKE '".DBSafe($object)."' AND miio_commands.LINKED_PROPERTY LIKE '".DBSafe($property)."'");

		/*
			ID	TITLE	NOTE	VALUE	DEVICE_ID	LINKED_OBJECT	LINKED_PROPERTY	LINKED_METHOD	UPDATE				TOKEN	DEVICE_TYPE
			122	power	""		0		19			miioRelay01		status			""				2018-03-20 00:50:34	xxxxx	yeelink.light.mono1	
		*/
		
		$total = count($properties);
   
		if ($total) {
			for($i = 0; $i < $total; $i++) {
				// Если есть токен, то обрабатываем команду и ставим ее в очередь. Без токена ничего не делаем.
				if ($properties[$i]['TOKEN'] != '') {
					
					if ($properties[$i]['TITLE'] == 'command') {
						if ($value == 'prop_update') {
							// Обновление сведений об устройстве по запросу
							$this->requestStatus($properties[$i]['DEVICE_ID']);
							if ($this->config['API_LOG_DEBMES']) DebMes('Manual update the properties of the device ' . $properties[$i]['DEVICE_ID'], 'xiaomimiio');
						} else {
							// Отправка любой команды (метода) без параметров.
							// Например, miIO.info, toggle, app_start и др.
							$this->addToQueue($properties[$i]['DEVICE_ID'], $value, '[]');
						}
						//TODO: после отправки команды желательно обновить сведения об устройстве,
						//но при этом перезапишется поле message (удалится результат выполнения команды),
						//что может быть неприемлемо.
						//$this->requestStatus($properties[$i]['DEVICE_ID']);
					} elseif ($properties[$i]['TITLE'] == 'power') {
                  // Команда на включение и выключение
                  if ($properties[$i]['DEVICE_TYPE'] == 'lumi.acpartner.v3') {
                     $method = 'toggle_plug';
                  } else {
                     $method = 'set_power';
                  }
                  if ($value) {
                     $this->addToQueue($properties[$i]['DEVICE_ID'], $method, '["on"]');
                  } else {
                     $this->addToQueue($properties[$i]['DEVICE_ID'], $method, '["off"]');
                  }
                  // TO-DO: Если у-во yeelight, то используем дополнительные опции команды (effect, duration, mode).
					} elseif ($properties[$i]['TITLE'] == 'buzzer') {
						// Команда на включение и выключение пищалки
						if ($value) {
							$this->addToQueue($properties[$i]['DEVICE_ID'], 'set_buzzer', '["on"]');
						} else {
							$this->addToQueue($properties[$i]['DEVICE_ID'], 'set_buzzer', '["off"]');
						}
					} elseif ($properties[$i]['TITLE'] == 'bright') {
						// Команда на изменение яркости (в % от 1 до 100)
						$value = (int)$value;
						if ($value < 1) $value = 1;
						if ($value > 100) $value = 100;
						$this->addToQueue($properties[$i]['DEVICE_ID'], 'set_bright', "[$value]");
					} elseif ($properties[$i]['TITLE'] == 'cct') {
						// Команда на изменение цветовой температуры (в % от 1 до 100)
						$value = (int)$value;
						if ($value < 1) $value = 1;
						if ($value > 100) $value = 100;
						$this->addToQueue($properties[$i]['DEVICE_ID'], 'set_cct', "[$value]");
					} elseif ($properties[$i]['TITLE'] == 'ct') {
						// Команда на изменение цветовой температуры (в кельвинах от 1700 до 6500)
						$value = (int)$value;
						if ($value < 1700) $value = 1700;
						if ($value > 6500) $value = 6500;
						$this->addToQueue($properties[$i]['DEVICE_ID'], 'set_ct_abx', '[' . $value . ',"sudden",200]');
					} elseif ($properties[$i]['TITLE'] == 'rgb') {
						// Команда на изменение цвета RGB (от 0 до 16777215)
						// RGB = (R*65536)+(G*256)+B, где R, G и B десятичные значения от 0 до 255.
						$value = preg_replace('/^#/', '', $value);
						$val = hexdec($value);
						if ($val != 0 && $val < 16777216) {
							$this->addToQueue($properties[$i]['DEVICE_ID'], 'set_rgb', '[' . $val . ',"smooth",100]');
						}
					} elseif ($properties[$i]['TITLE'] == 'wifi_led') {
						// Команда на включение и выключение индикатора wifi
						if ($value) {
							$this->addToQueue($properties[$i]['DEVICE_ID'], 'set_wifi_led', '["on"]');
						} else {
							$this->addToQueue($properties[$i]['DEVICE_ID'], 'set_wifi_led', '["off"]');
						}
					} elseif ($properties[$i]['TITLE'] == 'usb_on') {
						// Команда на включение и выключение usb-порта розетки
						if ($value) {
							$this->addToQueue($properties[$i]['DEVICE_ID'], 'set_usb_on', '[]');
						} else {
							$this->addToQueue($properties[$i]['DEVICE_ID'], 'set_usb_off', '[]');
						}
					} elseif ($properties[$i]['TITLE'] == 'ir_play') {
                  // Команда для отправки IR-кода
                  if ($properties[$i]['DEVICE_TYPE'] == 'chuangmi.ir.v2') {
                     $this->addToQueue($properties[$i]['DEVICE_ID'], 'miIO.ir_play', '{"freq":38400,"code":"' . $value . '"}');
                  }
                  else if ($properties[$i]['DEVICE_TYPE'] == 'lumi.acpartner.v3') {
                     $this->addToQueue($properties[$i]['DEVICE_ID'], 'send_ir_code', '["' . $value . '"]');
                  }
                  //{"id":1,"method":"miIO.ir_play","params":{"freq":38400,"code":"Z6VHABACAABE...QA="}}
					} elseif ($properties[$i]['TITLE'] == 'snm') {
						// Установить фиксированные сцены (1-Яркий, 2-ТВ, 3-тёплый, 4-ночь)
						if ($value < 1) $value = 1;
						if ($value > 4) $value = 4;
						$this->addToQueue($properties[$i]['DEVICE_ID'], 'apply_fixed_scene', "[$value]");
					} elseif ($properties[$i]['TITLE'] == 'dv') {
						// Таймер отключения (в секундах)
						if ($value < 0) $value = 1;
						if ($value > 21600) $value = 21600;
						$this->addToQueue($properties[$i]['DEVICE_ID'], 'delay_off', "[$value]");
					} elseif ($properties[$i]['TITLE'] == 'bl') {
						// Интеллектуальный ночник
						if ($value) {
							$this->addToQueue($properties[$i]['DEVICE_ID'], 'enable_bl', '[1]');
						} else {
							$this->addToQueue($properties[$i]['DEVICE_ID'], 'enable_bl', '[0]');
						}
					} elseif ($properties[$i]['TITLE'] == 'ac') {
						// Автонастройка цветовой температуры
						if ($value) {
							$this->addToQueue($properties[$i]['DEVICE_ID'], 'enable_ac', '[1]');
						} else {
							$this->addToQueue($properties[$i]['DEVICE_ID'], 'enable_ac', '[0]');
						}
					} elseif ($properties[$i]['TITLE'] == 'nl_br') {
						// Ночной режим (ночник, "луна")
						if ($value) {
							$bright = SQLSelectOne("SELECT miio_commands.VALUE FROM miio_commands WHERE miio_commands.TITLE LIKE 'bright' AND DEVICE_ID=" . $properties[$i]['DEVICE_ID']);
							$this->addToQueue($properties[$i]['DEVICE_ID'], 'set_scene', '["nightlight",' . $bright['VALUE'] . ']');
						} else {
							$ct = SQLSelectOne("SELECT miio_commands.VALUE FROM miio_commands WHERE miio_commands.TITLE LIKE 'ct' AND DEVICE_ID=" . $properties[$i]['DEVICE_ID']);
							$this->addToQueue($properties[$i]['DEVICE_ID'], 'set_ct_abx', '[' . $ct['VALUE'] . ',"sudden",100]');
						}
					} elseif ($properties[$i]['TITLE'] == 'vol_up') {
						// Команда увеличения громкости на указанную величину
						$value = (int)$value;
						if ($value < 1) $value = 1;
						if ($value > 100) $value = 100;
						$this->addToQueue($properties[$i]['DEVICE_ID'], 'vol_up', "[$value]");
					} elseif ($properties[$i]['TITLE'] == 'vol_down') {
						// Команда уменьшения громкости на указанную величину
						$value = (int)$value;
						if ($value < 1) $value = 1;
						if ($value > 100) $value = 100;
						$this->addToQueue($properties[$i]['DEVICE_ID'], 'vol_down', "[$value]");
					} elseif ($properties[$i]['TITLE'] == 'led') {
						// 
						if ($value) {
							$this->addToQueue($properties[$i]['DEVICE_ID'], 'set_led', '["on"]');
						} else {
							$this->addToQueue($properties[$i]['DEVICE_ID'], 'set_led', '["off"]');
						}
					} elseif ($properties[$i]['TITLE'] == 'child_lock') {
						// 
						if ($value) {
							$this->addToQueue($properties[$i]['DEVICE_ID'], 'set_child_lock', '["on"]');
						} else {
							$this->addToQueue($properties[$i]['DEVICE_ID'], 'set_child_lock', '["off"]');
						}
					} elseif ($properties[$i]['TITLE'] == 'favorite_level') {
						// 
						$value = (int)$value;
						if ($value < 0) $value = 0;
						if ($value > 100) $value = 100;
						$this->addToQueue($properties[$i]['DEVICE_ID'], 'set_level_favorite', "[$value]");
					} elseif ($properties[$i]['TITLE'] == 'dry') {
						// 
						if ($value) {
							$this->addToQueue($properties[$i]['DEVICE_ID'], 'set_dry', '["on"]');
						} else {
							$this->addToQueue($properties[$i]['DEVICE_ID'], 'set_dry', '["off"]');
						}
					} elseif ($properties[$i]['TITLE'] == 'led_b') {
						// Управление светодиодом (подсветкой)
						switch($value) {
							case 'bright':
								$value = 0;
								break;
							case 'dim':
								$value = 1;
								break;
							case 'off':
								$value = 2;
								break;
							default:
								$value = 0;
							break;
						}
						$this->addToQueue($properties[$i]['DEVICE_ID'], 'set_led_b', '["' . $value . '"]');	
					} elseif ($properties[$i]['TITLE'] == 'mode') {
						// 
						if($properties[$i]['DEVICE_TYPE'] == 'zhimi.humidifier.v1') {
							// Изменение режима (silent, medium, high)
							if ($value == 'silent' || $value == 'medium' || $value == 'high') {
								$this->addToQueue($properties[$i]['DEVICE_ID'], 'set_mode', '["' . $value . '"]');
							}
						} elseif($properties[$i]['DEVICE_TYPE'] == 'zhimi.humidifier.ca1') {
							// Изменение режима (auto, silent, medium, high)
							if ($value == 'auto' || $value == 'silent' || $value == 'medium' || $value == 'high') {
								$this->addToQueue($properties[$i]['DEVICE_ID'], 'set_mode', '["' . $value . '"]');
							}
						} elseif($properties[$i]['DEVICE_TYPE'] == 'zhimi.airpurifier.ma2') {
							// Изменение режима (silent, auto, favorite)
							if ($value == 'silent' || $value == 'auto' || $value == 'favorite') {
								$this->addToQueue($properties[$i]['DEVICE_ID'], 'set_mode', '["' . $value . '"]');
							}
						}
               } elseif ($properties[$i]['TITLE'] == 'custom_mode') {
                  // Изменение режима работы (мощности) пылесоса (от 1 до 100%, 101 - влажная уборка, 105 - турбо)
                  $this->addToQueue($properties[$i]['DEVICE_ID'], 'set_custom_mode', '[' . $value . ']');
               } elseif ($properties[$i]['TITLE'] == 'zoned_clean') {
                  // Уборка указанных зон (параметры - либо одна зона [[zone1]], либо список зон [[zone1],[zone2]])
                  // [x1 Integer, y1 Integer, x2 Integer, y2 Integer, times Integer]
                  // {"id":8338,"method":"app_zoned_clean","params":[[26234,26042,27284,26642,5]]}
                  // {"id":8338,"method":"app_zoned_clean","params":[[26234,26042,27284,26642,1],[26232,25304,27282,25804,2],[26246,24189,27296,25139,3]]}
                  $this->addToQueue($properties[$i]['DEVICE_ID'], 'app_zoned_clean', '[' . $value . ']');
               } elseif ($properties[$i]['TITLE'] == 'goto_target') {
                  // Движение в заданную точку (параметры [x Integer, y Integer])
                  // {"id": 25736111,"method": "app_goto_target","params": [24200,20200]}
                  $this->addToQueue($properties[$i]['DEVICE_ID'], 'app_goto_target', '[' . $value . ']');
               } elseif ($properties[$i]['TITLE'] == 'flow') {
						// 
						if ($value != '') {
							$this->addToQueue($properties[$i]['DEVICE_ID'], 'start_cf', "[$value]");
						} else {
							$this->addToQueue($properties[$i]['DEVICE_ID'], 'stop_cf', '[]');
						}
					} elseif ($properties[$i]['TITLE'] == 'filter1_life') {
						// Сброс ресурса фильтра
						if ($value == '0' || $value == '') {
							$this->addToQueue($properties[$i]['DEVICE_ID'], 'set_f1_hour_used', '[0]');
						}
					} elseif ($properties[$i]['TITLE'] == 'limit_hum') {
						// Установка верхнего предела увлажнения (30, 40, 50, 60, 70, 80)
						$value = (int)$value;
						if (($value >= 30) && ($value <= 80) && (($value%10) == 0)) {
							$this->addToQueue($properties[$i]['DEVICE_ID'], 'set_limit_hum', "[$value]");
						}
					}

					if(($properties[$i]['DEVICE_TYPE'] == 'lumi.gateway.v3') || ($properties[$i]['DEVICE_TYPE'] == 'lumi.acpartner.v3')) {
						if ($properties[$i]['TITLE'] == 'current_volume') {
							// Изменение громкости
							$value = (int)$value;
							if ($value < 0) $value = 0;
							if ($value > 100) $value = 100;
							$this->addToQueue($properties[$i]['DEVICE_ID'], 'volume_ctrl_fm', '["' . $value . '"]');
						} else if ($properties[$i]['TITLE'] == 'current_status') {
							// Команды управления проигрыванием (on, off, toggle, next, prev)
							$this->addToQueue($properties[$i]['DEVICE_ID'], 'play_fm', '["' . $value . '"]');
						} else if ($properties[$i]['TITLE'] == 'arming_mode') {
							// Команды включения охраны (on, off)
							$this->addToQueue($properties[$i]['DEVICE_ID'], 'set_arming', '["' . $value . '"]');
						} 
						else if ($properties[$i]['TITLE'] == 'add_program') {
							// Добавление новой радиостанции (по URL)
							$this->addToQueue($properties[$i]['DEVICE_ID'], 'add_channels', '{"chs":[{"id":' . time() . ',"url":"' . $value . '","type":0}]}');
						} else if ($properties[$i]['TITLE'] == 'current_program') {
							// Проиграть конкретную (по ID) радиостанцию с текущей громкостью
							$volume = SQLSelectOne("SELECT VALUE FROM miio_commands WHERE DEVICE_ID='" . $properties[$i]['DEVICE_ID'] . "' AND TITLE='current_volume'")['VALUE'];
							$this->addToQueue($properties[$i]['DEVICE_ID'], 'play_specify_fm', "[$value,$volume]");
						} else if ($properties[$i]['TITLE'] == 'del_program') {
							// Удалить радиостанцию (по ID)
							$all_chs = SQLSelectOne("SELECT VALUE FROM miio_commands WHERE DEVICE_ID='" . $properties[$i]['DEVICE_ID'] . "' AND TITLE='all_program'")['VALUE'];
							$all_chs = json_decode($all_chs, true);
							foreach($all_chs['chs'] as $ch) {
								if ($ch['id'] == $value) {
									$ch_url = $ch['url'];
									break;
								}
							}
							$this->addToQueue($properties[$i]['DEVICE_ID'], 'remove_channels', '{"chs":[{"id":' . $value . ',"url":"' . $ch_url . '","type":0}]}');
						}
					}
					SQLExec("UPDATE miio_commands SET VALUE='" . DBSafe($value) . "', UPDATED='" . date('Y-m-d H:i:s') . "' WHERE ID=" . $properties[$i]['ID']);
				}
			}
		}
	}

	/**
	* processCommand
	*
	* ...
	*
	* @access private
	*/

	function processCommand($device_id, $command, $value, $params = 0) {

		$cmd_rec = SQLSelectOne("SELECT * FROM miio_commands WHERE DEVICE_ID=".(int)$device_id." AND TITLE LIKE '".DBSafe($command)."'");

		if (!$cmd_rec['ID']) {
			$cmd_rec = array();
			$cmd_rec['TITLE'] = $command;
			$cmd_rec['DEVICE_ID'] = $device_id;
			$cmd_rec['ID'] = SQLInsert('miio_commands', $cmd_rec);
		}

		$old_value = $cmd_rec['VALUE'];

		$cmd_rec['VALUE'] = $value;
		$cmd_rec['UPDATED'] = date('Y-m-d H:i:s');
		SQLUpdate('miio_commands', $cmd_rec);

      // Если значение метрики не изменилось, то выходим.
      if ($old_value == $value) return;

      // Иначе обновляем привязанное свойство.
      if ($cmd_rec['LINKED_OBJECT'] && $cmd_rec['LINKED_PROPERTY']) {
         setGlobal($cmd_rec['LINKED_OBJECT'] . '.' . $cmd_rec['LINKED_PROPERTY'], $value, array($this->name => '0'));
      }

      // И вызываем привязанный метод.
      if ($cmd_rec['LINKED_OBJECT'] && $cmd_rec['LINKED_METHOD']) {
         if (!is_array($params)) {
            $params = array();
         }
         $params['VALUE'] = $value;
         $params['OLD_VALUE'] = $old_value;
         $params['NEW_VALUE'] = $value;

         callMethodSafe($cmd_rec['LINKED_OBJECT'] . '.' . $cmd_rec['LINKED_METHOD'], $params);
      }

	}

	/**
	* processMessage
	*
	* Обработка ответов от устройств
	*
	* @access private
	*/

	function processMessage($message, $command, $device_id) {

		$this->getConfig();
		
		if ($this->config['API_LOG_DEBMES']) DebMes("Incoming message from $device_id ($command): $message", 'xiaomimiio');
		
		$res_commands = array();

		if ($device_id) {
			$device = SQLSelectOne("SELECT * FROM miio_devices WHERE ID=" . (int)$device_id);
		}

		$data = json_decode($message, true);

      if (isset($data['error']) && $data['error'] == 'Device not answered') {
         if ($device['ID']) {
            $res_commands[] = array('command' => 'online', 'value' => 0);
            $res_commands[] = array('command' => 'message', 'value' => $message);
         }
      } elseif ($command == 'discover_all') {
			if (is_array($data['devices'])) {
				foreach($data['devices'] as $dev) {
					$dev = json_decode($dev, true);
					$device_type_code = $dev['devicetype'];
					$device_serial = $dev['serial'];
					$token = $dev['token'];
					
					if (preg_match('/^[0fF]+$/', $token)) {
						$token = '';
					}
					
					$dev_rec = SQLSelectOne("SELECT * FROM miio_devices WHERE DEVICE_TYPE_CODE='".$device_type_code."' AND SERIAL='".$device_serial."'");
					
					if ($dev_rec['ID']) {
						$dev_rec['IP'] = $dev['ip'];
						if ($token != '') {
							$dev_rec['TOKEN'] = $token;
						}
						SQLUpdate('miio_devices', $dev_rec);
					} else {
						$dev_rec = array();
						$dev_rec['IP'] = $dev['ip'];
						if ($token != '') {
							$dev_rec['TOKEN'] = $token;
						}
						$dev_rec['SERIAL'] = $device_serial;
						$dev_rec['DEVICE_TYPE_CODE'] = $device_type_code;
						$dev_rec['TITLE'] = 'New ' . $dev_rec['DEVICE_TYPE_CODE'];
						$dev_rec['ID'] = SQLInsert('miio_devices', $dev_rec);
					}
					$this->processCommand($dev_rec['ID'], 'online', 1);
				}
			} 
		} elseif ($device['ID']) {

			$res_commands[] = array('command' => 'online', 'value' => 1);
			$res_commands[] = array('command' => 'message', 'value' => $message);

			if (($device['DEVICE_TYPE'] == 'lumi.gateway.v3') || ($device['DEVICE_TYPE'] == 'lumi.acpartner.v3')) {
				if ($command == 'get_prop_fm' && is_array($data['result'])) {
					foreach($data['result'] as $key => $value) {
						$res_commands[] = array('command' => $key, 'value' => $value);
					}
				}
				if ($command == 'get_channels' && is_array($data['result'])) {
					$res_commands[] = array('command' => 'all_program', 'value' => $data['result']);
				}
				if ($command == 'get_arming' && is_array($data['result'])) {
					$res_commands[] = array('command' => 'get_arming', 'value' => $data['result'][0]);
				}
				if ($command == 'get_lumi_dpf_aes_key' && is_array($data['result'])) {
					$res_commands[] = array('command' => 'lumi_dpf_aes_key', 'value' => $data['result'][0]);
				}
				if ($command == 'get_zigbee_channel' && is_array($data['result'])) {
					$res_commands[] = array('command' => 'zigbee_channel', 'value' => $data['result'][0]);
				}
            if ($device['DEVICE_TYPE'] == 'lumi.acpartner.v3') {
               if ($command == 'get_device_prop' && is_array($data['result'])) {
                  $res_commands[] = array('command' => 'load_power', 'value' => $data['result'][0]);
               }
            }
			} elseif ($device['DEVICE_TYPE'] == 'yeelink.light.mono1' && $command == 'get_prop' && is_array($data['result'])) {
				$props = explode(',', MIIO_YEELIGHT_WHITE_BULB_PROPS);
				$i = 0;
				foreach($props as $key) {
					$value = $data['result'][$i];
					if ($key == 'flow_params') $key = 'flow';
					$res_commands[] = array('command' => $key, 'value' => $value);
					$i++;
				}
			} elseif (($device['DEVICE_TYPE'] == 'philips.light.bulb') || ($device['DEVICE_TYPE'] == 'philips.light.downlight')) {
				if ($command == 'get_prop' && is_array($data['result'])) {
					$props = explode(',', MIIO_PHILIPS_LIGHT_BULB_PROPS);
					$i = 0;
					foreach($props as $key) {
						$value = $data['result'][$i];
						$res_commands[] = array('command' => $key, 'value' => $value);
						$i++;
					}
				}
			} elseif ($device['DEVICE_TYPE'] == 'philips.light.candle' && $command == 'get_prop' && is_array($data['result'])) {
				$props = explode(',', MIIO_PHILIPS_LIGHT_CANDLE_PROPS);
				$i = 0;
				foreach($props as $key) {
					$value = $data['result'][$i];
					$res_commands[] = array('command' => $key, 'value' => $value);
					$i++;
				}
			} elseif ($device['DEVICE_TYPE'] == 'philips.light.sread1' && $command == 'get_prop' && is_array($data['result'])) {
				$props = explode(',', MIIO_PHILIPS_EYECARE_LAMP_2_PROPS);
				$i = 0;
				foreach($props as $key) {
					$value = $data['result'][$i];
					$res_commands[] = array('command' => $key, 'value' => $value);
					$i++;
				}
			} elseif ($device['DEVICE_TYPE'] == 'yeelink.light.color1' && $command == 'get_prop' && is_array($data['result'])) {
				$props = explode(',', MIIO_YEELIGHT_COLOR_BULB_PROPS);
				$i = 0;
				foreach($props as $key) {
					$value = $data['result'][$i];
					if ($key == 'flow_params') $key = 'flow';
					if ($key == 'rgb') {
						$value = str_pad(dechex($value), 6, '0', STR_PAD_LEFT);
					}
					$res_commands[] = array('command' => $key, 'value' => $value);
					$i++;
				}
			} elseif (($device['DEVICE_TYPE'] == 'rockrobo.vacuum.v1') || ($device['DEVICE_TYPE'] == 'roborock.vacuum.s5')) {
				if (($command == 'get_status' || $command == 'get_consumable') && is_array($data['result'])) {
					foreach($data['result'][0] as $key => $value) {
						$res_commands[] = array('command' => $key, 'value' => $value);
						if ($key == 'state') {
							$state_codes = unserialize (MIIO_MIVACUUM_1_STATE_CODES);
							if (array_key_exists($value, $state_codes)) $res_commands[] = array('command' => 'state_text', 'value' => $state_codes[$value]);
						}
						if ($key == 'error_code') {
							$error_codes = unserialize (MIIO_MIVACUUM_1_ERROR_CODES);
							if (array_key_exists($value, $error_codes)) $res_commands[] = array('command' => 'error_text', 'value' => $error_codes[$value]);
						}
					}
				} else if ($command == 'get_custom_mode' && is_array($data['result'])) {
               //get_custom_mode    {"result":[60],"id":1535013272}
               $res_commands[] = array('command' => 'custom_mode', 'value' => $data['result'][0]);
            }
			} elseif ($device['DEVICE_TYPE'] == 'chuangmi.plug.m1' && $command == 'get_prop' && is_array($data['result'])) {
				$props = explode(',', MIIO_CHUANGMI_PLUG_M1_PROPS);
				$i = 0;
				foreach($props as $key) {
					$value = $data['result'][$i];
					$res_commands[] = array('command' => $key, 'value' => $value);
					$i++;
				}
			} elseif (($device['DEVICE_TYPE'] == 'chuangmi.plug.v1') || ($device['DEVICE_TYPE'] == 'chuangmi.plug.v3')) {
				if ($command == 'get_prop' && is_array($data['result'])) {
					$props = explode(',', MIIO_CHUANGMI_PLUG_V1_PROPS);
					$i = 0;
					foreach($props as $key) {
						$value = $data['result'][$i];
						if ($key == 'usb_on') {
							if ($value == 'true') $value = 1;
							else if ($value == 'false') $value = 0;
						}
						$res_commands[] = array('command' => $key, 'value' => $value);
						$i++;
					}
				} elseif ($command == 'get_power') {
					$key = 'load_power';
					$value = $data['result'][0];
					if ($value == '' || $value == 'null' || $value == null) $value = '0';
					$value = $value / 100;
					$res_commands[] = array('command' => $key, 'value' => $value);
				}
			} elseif ($device['DEVICE_TYPE'] == 'philips.light.ceiling' && $command == 'get_prop' && is_array($data['result'])) {
				$props = explode(',', MIIO_PHILIPS_LIGHT_CEILING_PROPS);
				$i = 0;
				foreach($props as $key) {
					$value = $data['result'][$i];
					$res_commands[] = array('command' => $key, 'value' => $value);
					$i++;
				}
			} elseif ($device['DEVICE_TYPE'] == 'yeelink.light.ceiling1' && $command == 'get_prop' && is_array($data['result'])) {
				$props = explode(',', MIIO_YEELIGHT_CEILING_LIGHT_PROPS);
				$i = 0;
				foreach($props as $key) {
					$value = $data['result'][$i];
					if ($key == 'flow_params') $key = 'flow';
					if ($key == 'nl_br' && $value != 0) {
						$res_commands[4]['value'] = $value;	// свойство bright
					} else {
						$res_commands[] = array('command' => $key, 'value' => $value);
					}
					$i++;
				}
			} elseif ($device['DEVICE_TYPE'] == 'yeelink.light.lamp1' && $command == 'get_prop' && is_array($data['result'])) {
				$props = explode(',', MIIO_YEELIGHT_LAMP_LIGHT_PROPS);
				$i = 0;
				foreach($props as $key) {
					$value = $data['result'][$i];
					if ($key == 'flow_params') $key = 'flow';
					$res_commands[] = array('command' => $key, 'value' => $value);
					$i++;
				}
			} elseif ($device['DEVICE_TYPE'] == 'yeelink.light.strip1' && $command == 'get_prop' && is_array($data['result'])) {
				$props = explode(',', MIIO_YEELIGHT_STRIP_PROPS);
				$i = 0;
				foreach($props as $key) {
					$value = $data['result'][$i];
					if ($key == 'flow_params') $key = 'flow';
					if ($key == 'rgb') {
						$value = str_pad(dechex($value), 6, '0', STR_PAD_LEFT);
					}
					$res_commands[] = array('command' => $key, 'value' => $value);
					$i++;
				}
			} elseif ($device['DEVICE_TYPE'] == 'zimi.powerstrip.v2' && $command == 'get_prop' && is_array($data['result'])) {
				$props = explode(',', MIIO_ZIMI_POWERSTRIP_2_PROPS);
				$i = 0;
				foreach($props as $key) {
					$value = $data['result'][$i];
					if ($key == 'current' || $key == 'power_consume_rate') {
						if ($value == '' || $value == 'null' || $value == null) $value = '0.00';
					}
					if ($key == 'mode') {
						if ($value == 'null' || $value == null) $value = '';
					}
					$res_commands[] = array('command' => $key, 'value' => $value);
					$i++;
				}
			} elseif (($device['DEVICE_TYPE'] == 'zhimi.humidifier.v1') || ($device['DEVICE_TYPE'] == 'zhimi.humidifier.ca1')) {
				if ($command == 'get_prop' && is_array($data['result'])) {
					if ($device['DEVICE_TYPE'] == 'zhimi.humidifier.v1') {
						$props = explode(',', MIIO_ZHIMI_HUMIDIFIER_PROPS);
					} elseif ($device['DEVICE_TYPE'] == 'zhimi.humidifier.ca1') {
						$props = explode(',', MIIO_ZHIMI_HUMIDIFIER_2_PROPS);
					}
					$i = 0;
					foreach($props as $key) {
						$value = $data['result'][$i];
						if ($key == 'temp_dec') {
							$value = $value / 10;
							$key = 'temperature';
						}
						if ($key == 'led_b') {
							switch($value) {
								case 0:
									$value = 'bright';
									break;
								case 1:
									$value = 'dim';
									break;
								case 2:
									$value = 'off';
									break;
								default:
									$value = 'unknown';
									break;
							}
						}
						$res_commands[] = array('command' => $key, 'value' => $value);
						$i++;
					}
				}
			} elseif ($device['DEVICE_TYPE'] == 'zhimi.airpurifier.ma2' && $command == 'get_prop' && is_array($data['result'])) {
				$props = explode(',', MIIO_ZHIMI_AIRPURIFIER_MA2_PROPS);
				$i = 0;
				foreach($props as $key) {
					$value = $data['result'][$i];
					if ($key == 'temp_dec') {
						$value = $value / 10;
						$key = 'temperature';
					}
					if ($key == 'bright') $key = 'illumination';
					$res_commands[] = array('command' => $key, 'value' => $value);
					$i++;
				}
			} elseif ($device['DEVICE_TYPE'] == 'yeelink.light.bslamp1' && $command == 'get_prop' && is_array($data['result'])) {
				$props = explode(',', MIIO_YEELIGHT_BSLAMP1_PROPS);
				$i = 0;
				foreach($props as $key) {
					$value = $data['result'][$i];
					if ($key == 'flow_params') $key = 'flow';
					if ($key == 'rgb') {
						$value = str_pad(dechex($value), 6, '0', STR_PAD_LEFT);
					}
					$res_commands[] = array('command' => $key, 'value' => $value);
					$i++;
				}
			} elseif ($device['DEVICE_TYPE'] == 'xiaomi.wifispeaker.v1' && $command == 'get_prop' && is_array($data['result'])) {
				foreach(json_decode($data['result'][0],true) as $key => $value) {
					$res_commands[] = array('command' => $key, 'value' => $value);
				}
				$res_commands[] = array('command' => 'volume', 'value' => $data['result'][1]);
				$res_commands[] = array('command' => 'rel_time', 'value' => $data['result'][2]);
			}
		}

      foreach ($res_commands as $c) {
         $cmd = $c['command'];
         $val = $c['value'];
         if ($cmd == 'power' || $cmd == 'wifi_led' || $cmd == 'buzzer' || $cmd == 'led' || $cmd == 'child_lock'|| $cmd == 'dry') {
            if ($val == 'on') $val = 1;
             else if ($val == 'off') $val = 0;
         }
         $this->processCommand($device['ID'], $cmd, $val);
      }

   }
	
	/**
	* Install
	*
	* Module installation routine
	*
	* @access private
	*/
 
	function install($data = '') {
		
		//setGlobal('cycle_xiaomimiioControl', 'start');
		//setGlobal('cycle_xiaomimiioAutoRestart', '1');
		
		parent::install();
		
	}
	
	/**
	* Uninstall
	*
	* Module uninstall routine
	*
	* @access public
	*/
	
	function uninstall() {
		
		/*
			TO-DO:
			- перед удалением таблиц нужно остановить цикл, если он запущен, чтобы не было ошибок SQL
			- также нужно удалить сведения о цикле из Xray и свойства из объекта ThisComputer
			  (ThisComputer.cycle_xiaomimiioRun, ThisComputer.cycle_xiaomimiioControl, 
			   ThisComputer.cycle_xiaomimiioDisabled, ThisComputer.cycle_xiaomimiioAutoRestart)
		*/
		
		SQLExec('DROP TABLE IF EXISTS miio_devices');
		SQLExec('DROP TABLE IF EXISTS miio_commands');
		SQLExec('DROP TABLE IF EXISTS miio_queue');
  
		parent::uninstall();
		
	}
	
	/**
	* dbInstall
	*
	* Database installation routine
	*
	* @access private
	*/
	function dbInstall($data = '') {

		$data = <<<EOD
			miio_devices: ID int(10) unsigned NOT NULL auto_increment
			miio_devices: TITLE varchar(100) NOT NULL DEFAULT ''
			miio_devices: IP varchar(255) NOT NULL DEFAULT ''
			miio_devices: TOKEN varchar(255) NOT NULL DEFAULT ''
			miio_devices: MAC varchar(255) NOT NULL DEFAULT ''
			miio_devices: DEVICE_TYPE varchar(255) NOT NULL DEFAULT ''
			miio_devices: DEVICE_TYPE_CODE varchar(255) NOT NULL DEFAULT ''
			miio_devices: TIME_DIFF int(10) NOT NULL DEFAULT '0'
			miio_devices: MODEL varchar(255) NOT NULL DEFAULT ''
			miio_devices: HW_VER varchar(255) NOT NULL DEFAULT ''
			miio_devices: SERIAL varchar(255) NOT NULL DEFAULT ''
			miio_devices: SETTINGS text
			miio_devices: UPDATE_PERIOD int(10) NOT NULL DEFAULT '0'
			miio_devices: NEXT_UPDATE datetime
			miio_devices: UPDATED datetime
 
			miio_commands: ID int(10) unsigned NOT NULL auto_increment
			miio_commands: TITLE varchar(100) NOT NULL DEFAULT ''
			miio_commands: NOTE varchar(100) NOT NULL DEFAULT ''
			miio_commands: VALUE text
			miio_commands: DEVICE_ID int(10) NOT NULL DEFAULT '0'
			miio_commands: LINKED_OBJECT varchar(100) NOT NULL DEFAULT ''
			miio_commands: LINKED_PROPERTY varchar(100) NOT NULL DEFAULT ''
			miio_commands: LINKED_METHOD varchar(100) NOT NULL DEFAULT ''
			miio_commands: UPDATED datetime
 
			miio_queue: ID int(10) unsigned NOT NULL auto_increment
			miio_queue: DEVICE_ID int(10) NOT NULL DEFAULT '0'
			miio_queue: METHOD varchar(100)
			miio_queue: DATA text
			miio_queue: ADDED datetime
EOD;
		
		parent::dbInstall($data);
	}
	
// --------------------------------------------------------------------
}
/*
*
* TW9kdWxlIGNyZWF0ZWQgTm92IDI1LCAyMDE3IHVzaW5nIFNlcmdlIEouIHdpemFyZCAoQWN0aXZlVW5pdCBJbmMgd3d3LmFjdGl2ZXVuaXQuY29tKQ==
*
*/
