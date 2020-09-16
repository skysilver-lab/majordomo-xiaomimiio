<?php
/**
* Xiaomi miIO
* @package project
* @author <skysilver.da@gmail.com>
* @copyright 2017-2020 Agaphonov Dmitri aka skysilver <skysilver.da@gmail.com> (c)
* @version 3.0
*/

define ('EXTENDED_LOGGING', 0);

define ('MIIO_YEELIGHT_WHITE_BULB_PROPS', 'power,bright,flow_params,flowing');
define ('MIIO_YEELIGHT_COLOR_BULB_PROPS', 'power,bright,ct,rgb,hue,sat,color_mode,flow_params,flowing');
define ('MIIO_YEELIGHT_STRIP_PROPS', 'power,bright,ct,rgb,hue,sat,color_mode,flow_params,flowing');
define ('MIIO_YEELIGHT_CEILING_LIGHT_PROPS', 'power,bright,ct,nl_br,color_mode,flow_params,flowing');
define ('MIIO_YEELIGHT_LAMP_LIGHT_PROPS', 'power,bright,ct,flow_params,flowing');
define ('MIIO_YEELIGHT_BSLAMP1_PROPS', 'power,bright,ct,rgb,hue,sat,nl_br,color_mode,flow_params,flowing,pdo_status,save_state,nighttime,miband_sleep');
define ('MIIO_YEELIGHT_CEILING_LIGHT_650_PROPS', 'power,bright,ct,nl_br,color_mode,flow_params,flowing,bg_power,bg_bright,bg_rgb,bg_ct,bg_flow_params,bg_flowing');

define ('MIIO_PHILIPS_LIGHT_BULB_PROPS', 'power,bright,cct,snm,dv');
define ('MIIO_PHILIPS_LIGHT_CANDLE_PROPS', 'power,bright,cct');
define ('MIIO_PHILIPS_LIGHT_CEILING_PROPS', 'power,bright,cct,snm,dv,bl,ac');

define ('MIIO_PHILIPS_EYECARE_LAMP_2_PROPS', 'power,bright,notifystatus,ambstatus,ambvalue,eyecare,scene_num,bls,dvalue');

define ('MIIO_CHUANGMI_PLUG_M1_PROPS', 'power,temperature');
define ('MIIO_CHUANGMI_PLUG_V1_PROPS', 'power,usb_on,temperature,wifi_led');

define ('MIIO_ZIMI_POWERSTRIP_2_PROPS', 'power,temperature,current,power_consume_rate,wifi_led');
define ('MIIO_QMI_POWERSTRIP_1_PROPS', 'power,temperature,current,power_consume_rate,voltage');

define ('MIIO_ZHIMI_HUMIDIFIER_PROPS', 'power,humidity,temp_dec,mode,led_b,buzzer');
define ('MIIO_ZHIMI_HUMIDIFIER_2_PROPS', 'power,humidity,temp_dec,mode,depth,speed,dry,use_time,led_b,buzzer,child_lock,limit_hum');

define ('MIIO_ZHIMI_AIRPURIFIER_MA2_PROPS', 'power,aqi,average_aqi,humidity,temp_dec,bright,mode,favorite_level,filter1_life,use_time,purify_volume,led,buzzer,child_lock');
define ('MIIO_ZHIMI_AIRPURIFIER_V3_PROPS', 'power,aqi,bright,mode,filter1_life,led,buzzer,child_lock');

define ('MIIO_MIWIFISPEAKER_V1_PROPS', 'umi,volume,rel_time');

define ('MIIO_ZHIMI_FAN_SA1_PROPS', 'power,angle,speed,speed_level,natural_level,poweroff_time,ac_power,use_time,led_b,buzzer,child_lock');

define ('MIIO_AIRMONITOR_S1_PROPS', 'battery,battery_state,co2,humidity,pm25,temperature,tvoc');

define ('MIIO_YUNMI_KETTLE_R1_PROPS', 'water_remain_time,flush_time,flush_flag,tds,time,curr_tempe,setup_tempe,custom_tempe1,min_set_tempe,drink_remind,drink_remind_time,run_status,work_mode,drink_time_count');

define ('MIIO_DEERMA_HUMIDIFIER_MJJSQ_PROPS', 'OnOff_State,TemperatureValue,Humidity_Value,HumiSet_Value,Humidifier_Gear,Led_State,TipSound_State,waterstatus,watertankstatus');

define ('MIIO_HFJH_FISHBOWL_V1_PROPS','Equipment_Status,feed_switch,heater_switch,led_board_brightness,led_board_color,led_board_model,led_board_speed,pump_switch,pump_value,water_tds,water_temp,water_temp_value');

define ('MIIO_VIOMIVACUUM_V7_PROPS', 'run_state,mode,err_state,battary_life,box_type,s_time,s_area,suction_grade,water_grade');

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
                                          '10' =>  'Pause',
                                          '11' =>  'Spot Cleaning',
                                          '12' =>  'In Error',
                                          '13' =>  'Shutting down',
                                          '14' =>  'Updating',
                                          '15' =>  'Docking',
                                          '16' =>  'Going to target',
                                          '17' =>  'Zoned cleaning',
                                          '18' =>  'Room cleaning',
                                          '100' => 'Full',
                                          '101' => 'Wet cleaning',
                                          '105' => 'Turbo')));

define ('MIIO_VIOMIVACUUM_V7_STATE_CODES', serialize (array('0' => 'Waiting',
                                          '1' =>   'Going to target',
                                          '2' =>   'Waiting',
                                          '3' =>   'Cleaning',
                                          '4' =>   'Back to home',
                                          '5' =>   'Docking',
                                          '6' =>   'Zoned cleaning')));

define ('MIIO_MIVACUUM_1_ERROR_CODES', serialize (array('0' =>	'No error',
                                          '1' =>   'Laser distance sensor error',
                                          '2' =>   'Collision sensor error',
                                          '3' =>   'Wheels on top of void, move robot',
                                          '4' =>   'Clean hovering sensors, move robot',
                                          '5' =>   'Clean main brush',
                                          '6' =>   'Clean side brush',
                                          '7' =>   'Main wheel stuck',
                                          '8' =>   'Device stuck, clean area',
                                          '9' =>   'Dust collector missing',
                                          '10' =>  'Clean filter',
                                          '11' =>  'Stuck in magnetic barrier',
                                          '12' =>  'Low battery',
                                          '13' =>  'Charging fault',
                                          '14' =>  'Battery fault',
                                          '15' =>  'Wall sensors dirty, wipe them',
                                          '16' =>  'Place me on flat surface',
                                          '17' =>  'Side brushes problem, reboot me',
                                          '18' =>  'Suction fan problem',
                                          '19' =>  'Unpowered charging station',
                                          '20' =>  'Unknown Error',
                                          '21' =>  'Laser pressure sensor problem',
                                          '22' =>  'Charge sensor problem',
                                          '23' =>  'Dock problem',
                                          '24' =>  'No-go zone or invisible wall detected',
                                          '254' => 'Bin full',
                                          '255' => 'Internal error',
                                          '-1' =>  'Unknown Error')));

define ('MIIO_VIOMIVACUUM_V7_ERROR_CODES', serialize (array('500' => 'Radar timed out',
                                          '501' => 'Wheels stuck',
                                          '502' => 'Low battery',
                                          '503' => 'Dust bin missing',
                                          '508' => 'Uneven ground',
                                          '509' => 'Cliff sensor error',
                                          '510' => 'Collision sensor error',
                                          '511' => 'Could not return to dock',
                                          '512' => 'Could not return to dock',
                                          '513' => 'Could not navigate',
                                          '514' => 'Vacuum stuck',
                                          '515' => 'Charging error',
                                          '516' => 'Mop temperature error',
                                          '521' => 'Water tank is not installed',
                                          '522' => 'Mop is not installed',
                                          '525' => 'Insufficient water in water tank',
                                          '527' => 'Remove mop',
                                          '528' => 'Dust bin missing',
                                          '529' => 'Mop and water tank missing',
                                          '530' => 'Mop and water tank missing',
                                          '531' => 'Water tank is not installed',
                                          '2101' => 'Unsufficient battery, continuing cleaning after recharge')));


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
		$out['API_SOCKET_TIMEOUT'] = $this->config['API_SOCKET_TIMEOUT'];
		$out['API_LOG_DEBMES'] = $this->config['API_LOG_DEBMES'];
		$out['API_LOG_CYCLE'] = $this->config['API_LOG_CYCLE'];
		$out['API_LOG_MIIO'] = $this->config['API_LOG_MIIO'];

		if ((time() - (int)gg('cycle_xiaomimiioRun')) < 15 ) {
			$out['CYCLERUN'] = 1;
		} else {
			$out['CYCLERUN'] = 0;
		}

		if ($this->view_mode == 'update_settings') {

			global $api_ip;
			$this->config['API_IP'] = $api_ip;

         global $api_disc_period;
         $this->config['API_DISC_PERIOD'] = (int)$api_disc_period;

         global $api_socket_timeout;
         if ($api_socket_timeout < 1) {
            $api_socket_timeout = 1;
         } else if ($api_socket_timeout > 10) {
            $api_socket_timeout = 10;
         }
         $this->config['API_SOCKET_TIMEOUT'] = (int)$api_socket_timeout;

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

	function addToQueue($device_id, $method, $data = '[]', $timeshift = 0) {

		$rec = array();
		$rec['DEVICE_ID'] = (int)$device_id;
		$rec['METHOD'] = $method;
		$rec['DATA'] = $data;
      if ($timeshift > 0) {
         $rec['ADDED'] = date('Y-m-d H:i:s', time() + $timeshift);
      } else {
         $rec['ADDED'] = date('Y-m-d H:i:s');
      }

      if ($this->config['API_LOG_DEBMES']) DebMes("Outgoing message to $device_id ($method): $data", 'xiaomimiio');

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
                        if ($dev_rec['DEVICE_TYPE'] == 'lumi.gateway.v3') {
                           $this->processCommand($dev_rec['ID'], 'add_program', '');
                           $this->processCommand($dev_rec['ID'], 'del_program', '');
                        } else if ($dev_rec['DEVICE_TYPE'] == 'lumi.acpartner.v3') {
                           $this->processCommand($dev_rec['ID'], 'add_program', '');
                           $this->processCommand($dev_rec['ID'], 'del_program', '');
                           $this->processCommand($dev_rec['ID'], 'ir_play', '');
                           $this->processCommand($dev_rec['ID'], 'power', '');
                           $this->processCommand($dev_rec['ID'], 'load_power', '');
                        } else if ($dev_rec['DEVICE_TYPE'] == 'chuangmi.ir.v2') {
                           $this->processCommand($dev_rec['ID'], 'ir_play', '');
                        } else if ($dev_rec['DEVICE_TYPE'] == 'xiaomi.wifispeaker.v1') {
                           $this->processCommand($dev_rec['ID'], 'vol_up', '');
                           $this->processCommand($dev_rec['ID'], 'vol_down', '');
                        } else if ($dev_rec['DEVICE_TYPE'] == 'rockrobo.vacuum.v1' || $dev_rec['DEVICE_TYPE'] == 'roborock.vacuum.s5') {
                           $this->processCommand($dev_rec['ID'], 'goto_target', '');
                           $this->processCommand($dev_rec['ID'], 'zoned_clean', '');
                           if ($dev_rec['DEVICE_TYPE'] == 'roborock.vacuum.s5') {
                              $this->processCommand($dev_rec['ID'], 'segment_clean', '');
                           }
                        } else if ($dev_rec['DEVICE_TYPE'] == 'hfjh.fishbowl.v1') {
                           $this->processCommand($dev_rec['ID'], 'auto_feed', '');
                           $this->processCommand($dev_rec['ID'], 'single_feed', '');
                        } else if ($dev_rec['DEVICE_TYPE'] == '090615.switch.xswitch03') {
                           $this->processCommand($dev_rec['ID'], 'switch_all', '');
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
			$this->addToQueue($device_id, 'get_consumable');
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
				$this->addToQueue($device_id, 'get_device_prop', '["lumi.0","plug_state","ac_power"]');
			}
			$this->addToQueue($device_id, 'get_arming', '[]');
			$this->addToQueue($device_id, 'get_prop_fm', '[]');
			if ($this->view_mode == 'propupd_miio_devices') {
				$this->addToQueue($device_id, 'get_lumi_dpf_aes_key', '[]');
				$this->addToQueue($device_id, 'get_zigbee_channel', '[]');
			}
			$this->addToQueue($device_id, 'get_channels', '{"start":0}', 4);
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
		} elseif (($device_rec['DEVICE_TYPE'] == 'yeelink.light.ceiling1') || ($device_rec['DEVICE_TYPE'] == 'yeelink.light.ceiling8') || ($device_rec['DEVICE_TYPE'] == 'yeelink.light.ceiling3')) {
			//
			$props = explode(',', MIIO_YEELIGHT_CEILING_LIGHT_PROPS);
			$total = count($props);
			for ($i = 0; $i < $total; $i++) {
				$props[$i] = '"' . $props[$i] . '"';
			}
			$this->addToQueue($device_id, 'get_prop', '[' . implode(',', $props) . ']');
		} elseif ($device_rec['DEVICE_TYPE'] == 'yeelink.light.ceiling4') {
			//
			$props = explode(',', MIIO_YEELIGHT_CEILING_LIGHT_650_PROPS);
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
		} elseif ($device_rec['DEVICE_TYPE'] == 'qmi.powerstrip.v1') {
			//
			$props = explode(',', MIIO_QMI_POWERSTRIP_1_PROPS);
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
		} elseif ($device_rec['DEVICE_TYPE'] == 'zhimi.airpurifier.v3') {
			//
			$props = explode(',', MIIO_ZHIMI_AIRPURIFIER_V3_PROPS);
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
		} elseif ($device_rec['DEVICE_TYPE'] == 'zhimi.fan.sa1') {
			//
			$props = explode(',', MIIO_ZHIMI_FAN_SA1_PROPS);
			$total = count($props);
			for ($i = 0; $i < $total; $i++) {
				$props[$i] = '"' . $props[$i] . '"';
			}
			$this->addToQueue($device_id, 'get_prop', '[' . implode(',', $props) . ']');
		} elseif ($device_rec['DEVICE_TYPE'] == 'cgllc.airmonitor.s1') {
			//
			$props = explode(',', MIIO_AIRMONITOR_S1_PROPS);
			$total = count($props);
			for ($i = 0; $i < $total; $i++) {
				$props[$i] = '"' . $props[$i] . '"';
			}
			$this->addToQueue($device_id, 'get_prop', '[' . implode(',', $props) . ']');
      } elseif ($device_rec['DEVICE_TYPE'] == 'cgllc.airmonitor.b1') {
         //
         $this->addToQueue($device_id, 'get_air_data', '[]');
      } elseif ($device_rec['DEVICE_TYPE'] == 'zhimi.airpurifier.mb3') {
         $this->addToQueue($device_id, 'get_properties', '[{"did":"power","siid":2,"piid":2},{"did":"fan_level","siid":2,"piid":4},{"did":"mode","siid":2,"piid":5},{"did":"humidity","siid":3,"piid":7},{"did":"temperature","siid":3,"piid":8},{"did":"aqi","siid":3,"piid":6},{"did":"filter_life","siid":4,"piid":3},{"did":"filter_hours_used","siid":4,"piid":5},{"did":"buzzer","siid":5,"piid":1},{"did":"led_b","siid":6,"piid":1},{"did":"led","siid":6,"piid":6},{"did":"child_lock","siid":7,"piid":1},{"did":"favorite_level","siid":10,"piid":10}]');
         $this->addToQueue($device_id, 'get_properties', '[{"did":"use_time","siid":12,"piid":1},{"did":"purify_volume","siid":13,"piid":1},{"did":"average_aqi","siid":13,"piid":2}]');
      } elseif ($device_rec['DEVICE_TYPE'] == 'viomi.vacuum.v7') {
         //
         $props = explode(',', MIIO_VIOMIVACUUM_V7_PROPS);
         $total = count($props);
         for ($i = 0; $i < $total; $i++) {
            $props[$i] = '"' . $props[$i] . '"';
         }
         $this->addToQueue($device_id, 'get_prop', '[' . implode(',', $props) . ']');
      } elseif (($device_rec['DEVICE_TYPE'] == 'yunmi.kettle.r1') || ($device_rec['DEVICE_TYPE'] == 'yunmi.kettle.r2') || ($device_rec['DEVICE_TYPE'] == 'yunmi.kettle.r3')) {
         //
         $props = explode(',', MIIO_YUNMI_KETTLE_R1_PROPS);
         $total = count($props);
         for ($i = 0; $i < $total; $i++) {
            $props[$i] = '"' . $props[$i] . '"';
         }
         $this->addToQueue($device_id, 'get_prop', '[' . implode(',', $props) . ']');
      } elseif ($device_rec['DEVICE_TYPE'] == 'deerma.humidifier.mjjsq') {
         //
         $props = explode(',', MIIO_DEERMA_HUMIDIFIER_MJJSQ_PROPS);
         $total = count($props);
         for ($i = 0; $i < $total; $i++) {
            $props[$i] = '"' . $props[$i] . '"';
         }
         $this->addToQueue($device_id, 'get_prop', '[' . implode(',', $props) . ']');
      } elseif ($device_rec['DEVICE_TYPE'] == 'hfjh.fishbowl.v1') {
         //
         $props = explode(',', MIIO_HFJH_FISHBOWL_V1_PROPS);
         $total = count($props);
         for ($i = 0; $i < $total; $i++) {
            $props[$i] = '"' . $props[$i] . '"';
         }
         $this->addToQueue($device_id, 'get_prop', '[' . implode(',', $props) . ']');
         $this->addToQueue($device_id, 'get_key_switch', '[]');
      } elseif ($device_rec['DEVICE_TYPE'] == 'uvfive.s_lamp.slmap2') {
         $this->addToQueue($device_id, 'get_properties', '[{"did":"power","siid":2,"piid":2},{"did":"state_code","siid":2,"piid":3},{"did":"poweroff_time","siid":2,"piid":6},{"did":"countdown","siid":2,"piid":7},{"did":"child_lock","siid":4,"piid":1}]');
      } elseif ($device_rec['DEVICE_TYPE'] == '090615.switch.xswitch03') {
         $this->addToQueue($device_id, 'get_prop', '[]');
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

				if ($this->config['API_IP']) $bind_ip = $this->config['API_IP'];
				 else $bind_ip = '0.0.0.0';
				if ($this->config['API_LOG_MIIO']) $miio_debug = true;
				 else $miio_debug = false;

				$dev = new miIO($dip, $bind_ip, $dtoken, $miio_debug);

            if ($this->config['API_SOCKET_TIMEOUT'] !== null) {
               $dev->send_timeout = (int)$this->config['API_SOCKET_TIMEOUT'];
            }

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

				if ($this->config['API_IP']) $bind_ip = $this->config['API_IP'];
				 else $bind_ip = '0.0.0.0';
				if ($this->config['API_LOG_MIIO']) $miio_debug = true;
				 else $miio_debug = false;

				$dev = new miIO($dip, $bind_ip, $dtoken, $miio_debug);

            if ($this->config['API_SOCKET_TIMEOUT'] !== null) {
               $dev->send_timeout = (int)$this->config['API_SOCKET_TIMEOUT'];
            }

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

      $this->DeleteLinkedProperties($id);

      SQLExec("DELETE FROM miio_commands WHERE DEVICE_ID='{$id}'");
      SQLExec("DELETE FROM miio_devices WHERE ID='{$id}'");

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
                  } else if ($properties[$i]['DEVICE_TYPE'] == 'viomi.vacuum.v7') {
                     if ($value == 'app_start') {
                        $this->addToQueue($properties[$i]['DEVICE_ID'], 'set_mode_withroom', '[0,1,0]');
                     } else if ($value == 'app_stop') {
                        $this->addToQueue($properties[$i]['DEVICE_ID'], 'set_mode', '[0]');
                     } else if ($value == 'app_pause') {
                        $this->addToQueue($properties[$i]['DEVICE_ID'], 'set_mode_withroom', '[0,2,0]');
                     } else if ($value == 'app_charge') {
                        $this->addToQueue($properties[$i]['DEVICE_ID'], 'set_charge', '[1]');
                     } else {
                        $this->addToQueue($properties[$i]['DEVICE_ID'], $value, '[]');
                     }
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
                  $method = 'set_power';
                  if ($properties[$i]['DEVICE_TYPE'] == 'zhimi.airpurifier.mb3' || $properties[$i]['DEVICE_TYPE'] == 'uvfive.s_lamp.slmap2') {
                     $method = 'set_properties';
                     $params = '[{"did":"power","siid":2,"piid":2,"value":' . ($value ? 'true' : 'false') . '}]';
                  } else if ($properties[$i]['DEVICE_TYPE'] == 'lumi.acpartner.v3') {
                     $method = 'toggle_plug';
                     $params = $value ? '["on"]' : '["off"]';
                  } else if ($properties[$i]['DEVICE_TYPE'] == 'deerma.humidifier.mjjsq') {
                     $method = 'Set_OnOff';
                     $params = '['. (int)$value .']';
                  } else {
                     $params = $value ? '["on"]' : '["off"]';
                  }
                  $this->addToQueue($properties[$i]['DEVICE_ID'], $method, $params);
                  // TO-DO: Если у-во yeelight, то используем дополнительные опции команды (effect, duration, mode).
               } elseif ($properties[$i]['TITLE'] == 'bg_power') {
                  // Команда на включение и выключение дополнительной подсветки
                  if ($value) {
                     $this->addToQueue($properties[$i]['DEVICE_ID'], 'bg_set_power', '["on"]');
                  } else {
                     $this->addToQueue($properties[$i]['DEVICE_ID'], 'bg_set_power', '["off"]');
                  }
               } elseif ($properties[$i]['TITLE'] == 'buzzer') {
                  // Команда на включение и выключение пищалки
                  $method = 'set_buzzer';
                  if($properties[$i]['DEVICE_TYPE'] == 'zhimi.fan.sa1') {
                     $params = $value ? '[2]' : '[0]';
                  } else if ($properties[$i]['DEVICE_TYPE'] == 'zhimi.airpurifier.mb3') {
                     $method = 'set_properties';
                     $params = '[{"did":"buzzer","siid":5,"piid":1,"value":' . ($value ? 'true' : 'false') . '}]';
                  } else if ($properties[$i]['DEVICE_TYPE'] == 'deerma.humidifier.mjjsq') {
                     $method = 'SetTipSound_Status';
                     $params = '['. (int)$value .']';
                  } else {
                     $params = $value ? '["on"]' : '["off"]';
                  }
                  $this->addToQueue($properties[$i]['DEVICE_ID'], $method, $params);
					} elseif ($properties[$i]['TITLE'] == 'bright') {
						// Команда на изменение яркости (в % от 1 до 100)
						$value = (int)$value;
						if ($value < 1) $value = 1;
						if ($value > 100) $value = 100;
						$this->addToQueue($properties[$i]['DEVICE_ID'], 'set_bright', "[$value]");
					} elseif ($properties[$i]['TITLE'] == 'bg_bright') {
						// Команда на изменение яркости дополнительной подсветки (в % от 1 до 100)
						$value = (int)$value;
						if ($value < 1) $value = 1;
						if ($value > 100) $value = 100;
						$this->addToQueue($properties[$i]['DEVICE_ID'], 'bg_set_bright', "[$value]");
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
					} elseif ($properties[$i]['TITLE'] == 'bg_ct') {
						// Команда на изменение цветовой температуры дополнительной подсветки (в кельвинах от 1700 до 6500)
						$value = (int)$value;
						if ($value < 1700) $value = 1700;
						if ($value > 6500) $value = 6500;
						$this->addToQueue($properties[$i]['DEVICE_ID'], 'bg_set_ct_abx', '[' . $value . ',"sudden",200]');
					} elseif ($properties[$i]['TITLE'] == 'rgb') {
						// Команда на изменение цвета RGB (от 0 до 16777215)
						// RGB = (R*65536)+(G*256)+B, где R, G и B десятичные значения от 0 до 255.
						$value = preg_replace('/^#/', '', $value);
						$val = hexdec($value);
						if ($val != 0 && $val < 16777216) {
							$this->addToQueue($properties[$i]['DEVICE_ID'], 'set_rgb', '[' . $val . ',"smooth",100]');
						}
					} elseif ($properties[$i]['TITLE'] == 'bg_rgb') {
						// Команда на изменение цвета RGB дополнительной подсветки (от 0 до 16777215)
						$value = preg_replace('/^#/', '', $value);
						$val = hexdec($value);
						if ($val != 0 && $val < 16777216) {
							$this->addToQueue($properties[$i]['DEVICE_ID'], 'bg_set_rgb', '[' . $val . ',"smooth",100]');
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
                  // Установить фиксированные сцены
                  // 1-Яркий, 2-ТВ, 3-тёплый, 4-ночь
                  // 1-Учеба, 2-Чтение, 3-Компьютер
                  if ($value < 1) $value = 1;
                  if ($properties[$i]['DEVICE_TYPE'] == 'philips.light.sread1') {
                     if ($value > 3) $value = 3;
                     $this->addToQueue($properties[$i]['DEVICE_ID'], 'set_user_scene', "[$value]");
                  } else {
                     if ($value > 4) $value = 4;
                     $this->addToQueue($properties[$i]['DEVICE_ID'], 'apply_fixed_scene', "[$value]");
                  }
               } elseif ($properties[$i]['TITLE'] == 'dv') {
                  // Таймер отключения (в секундах/минутах)
                  if ($value < 0) $value = 1;
                  if ($properties[$i]['DEVICE_TYPE'] == 'philips.light.sread1') {
                     // минуты
                     if ($value > 60) $value = 60;
                  } else {
                     // секунды
                     if ($value > 21600) $value = 21600;
                  }
                  $this->addToQueue($properties[$i]['DEVICE_ID'], 'delay_off', "[$value]");
               } elseif ($properties[$i]['TITLE'] == 'bl') {
                  // Интеллектуальный ночник
                  if($properties[$i]['DEVICE_TYPE'] == 'philips.light.sread1') {
                     $value = $value ? '["on"]' : '["off"]';
                  } else {
                     $value = $value ? '[1]' : '[0]';
                  }
                  $this->addToQueue($properties[$i]['DEVICE_ID'], 'enable_bl', $value);
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
                  $method = 'set_led';
                  if ($properties[$i]['DEVICE_TYPE'] == 'zhimi.airpurifier.mb3') {
                     $method = 'set_properties';
                     $params = '[{"did":"led","siid":6,"piid":6,"value":' . ($value ? 'true' : 'false') . '}]';
                  } else if ($properties[$i]['DEVICE_TYPE'] == 'deerma.humidifier.mjjsq') {
                     $method = 'SetLedState';
                     $params = '['. (int)$value .']';
                  } else {
                     $params = $value ? '["on"]' : '["off"]';
                  }
                  $this->addToQueue($properties[$i]['DEVICE_ID'], $method, $params);
               } elseif ($properties[$i]['TITLE'] == 'child_lock') {
                  // 
                  $method = 'set_child_lock';
                  if ($properties[$i]['DEVICE_TYPE'] == 'zhimi.airpurifier.mb3') {
                     $method = 'set_properties';
                     $params = '[{"did":"child_lock","siid":7,"piid":1,"value":' . ($value ? 'true' : 'false') . '}]';
                  } else if ($properties[$i]['DEVICE_TYPE'] == 'uvfive.s_lamp.slmap2') {
                     $method = 'set_properties';
                     $params = '[{"did":"child_lock","siid":4,"piid":1,"value":' . ($value ? 'true' : 'false') . '}]';
                  } else if ($properties[$i]['DEVICE_TYPE'] == 'hfjh.fishbowl.v1') {
                     $method = 'set_key_switch';
                     $params = $value ? '[true]' : '[false]';
                  } else {
                     $params = $value ? '["on"]' : '["off"]';
                  }
                  $this->addToQueue($properties[$i]['DEVICE_ID'], $method, $params);
               } elseif ($properties[$i]['TITLE'] == 'favorite_level') {
                  // 
                  $value = (int)$value;
                  $method = 'set_level_favorite';
                  if ($properties[$i]['DEVICE_TYPE'] == 'zhimi.airpurifier.mb3') {
                     $method = 'set_properties';
                     if ($value < 0) $value = 0;
                     if ($value > 14) $value = 14;
                     $params = '[{"did":"favorite_level","siid":10,"piid":10,"value":' . $value . '}]';
                  } else {
                     if ($value < 0) $value = 0;
                     if ($value > 100) $value = 100;
                     $params = '[' . $value . ']';
                  }
                  $this->addToQueue($properties[$i]['DEVICE_ID'], $method, $params);
               } elseif ($properties[$i]['TITLE'] == 'fan_level') {
                  // 
                  $value = (int)$value;
                  $method = 'set_properties';
                  if ($properties[$i]['DEVICE_TYPE'] == 'zhimi.airpurifier.mb3') {
                     if ($value < 1) $value = 1;
                     if ($value > 3) $value = 3;
                     $params = '[{"did":"fan_level","siid":2,"piid":4,"value":' . $value . '}]';
                  }
                  $this->addToQueue($properties[$i]['DEVICE_ID'], $method, $params);
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
								$params = 0;
								break;
							case 'dim':
								$params = 1;
								break;
							case 'off':
								$params = 2;
								break;
							default:
								$params = 0;
							break;
						}
						if ($properties[$i]['DEVICE_TYPE'] == 'zhimi.airpurifier.mb3') {
                     $this->addToQueue($properties[$i]['DEVICE_ID'],'set_properties', '[{"did":"led_b","siid":6,"piid":1,"value":' . $params . '}]');
                  } else {
                     $this->addToQueue($properties[$i]['DEVICE_ID'], 'set_led_b', '["' . $params . '"]');
                  }
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
						} elseif($properties[$i]['DEVICE_TYPE'] == 'zhimi.airpurifier.v3') {
							// Изменение режима (auto, silent, strong, low, medium, high, idle)
							if ($value == 'auto' || $value == 'silent' || $value == 'strong' || $value == 'low' ||
								 $value == 'medium' || $value == 'high' || $value == 'idle') {
								$this->addToQueue($properties[$i]['DEVICE_ID'], 'set_mode', '["' . $value . '"]');
							}
						} elseif($properties[$i]['DEVICE_TYPE'] == 'zhimi.airpurifier.mb3') {
                     switch($value) {
                        case 'auto': $params = 0; break;
                        case 'silent': $params = 1; break;
                        case 'favorite': $params = 2; break;
                        case 'fan': $params = 3; break;
                        default: $params = 0; break;
                     }
                     $this->addToQueue($properties[$i]['DEVICE_ID'],'set_properties', '[{"did":"mode","siid":2,"piid":5,"value":' . $params . '}]');
                  } elseif ($properties[$i]['DEVICE_TYPE'] == 'viomi.vacuum.v7') {
                     switch($value) {
                        case 'Vacuum': $params = 0; break;
                        case 'VacuumAndMop': $params = 1; break;
                        case 'Mop': $params = 2; break;
                        default: $params = 0; break;
                     }
                     $this->addToQueue($properties[$i]['DEVICE_ID'],'set_mop', '[' . $params . ']');
                  } elseif ($properties[$i]['DEVICE_TYPE'] == 'deerma.humidifier.mjjsq') {
                     switch($value) {
                        case 'low': $params = 1; break;
                        case 'medium': $params = 2; break;
                        case 'high': $params = 3; break;
                        case 'humidity': $params = 4; break;
                        default: $params = 1; break;
                     }
                     $this->addToQueue($properties[$i]['DEVICE_ID'],'Set_HumidifierGears', '[' . $params . ']');
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
               } elseif ($properties[$i]['TITLE'] == 'segment_clean') {
                  // Уборка указанных сегментов (комнат) по их идентификаторам
                  // {"id":8338,"method":"app_segment_clean","params":[1,2,3,4,10]}
                  $this->addToQueue($properties[$i]['DEVICE_ID'], 'app_segment_clean', '[' . $value . ']');
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
					} elseif ($properties[$i]['TITLE'] == 'bg_flow') {
						// 
						if ($value != '') {
							$this->addToQueue($properties[$i]['DEVICE_ID'], 'bg_start_cf', "[$value]");
						} else {
							$this->addToQueue($properties[$i]['DEVICE_ID'], 'bg_stop_cf', '[]');
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
					} elseif ($properties[$i]['TITLE'] == 'speed_level') {
                  // Уровень скорости вращения в обычном режиме (от 1 до 100)
                  if ($value) {
                     $value = (int)$value;
                     if ($value < 0) $value = 0;
                     if ($value > 100) $value = 100;
                     $this->addToQueue($properties[$i]['DEVICE_ID'], 'set_speed_level', '['.$value.']');
                  }
               } elseif ($properties[$i]['TITLE'] == 'angle') {
                  // Команда на включение выключение автоматического поворота вентилятора
                  if ($value) {
                     $this->addToQueue($properties[$i]['DEVICE_ID'], 'set_angle', '['.$value.']');
                  }
               } elseif ($properties[$i]['TITLE'] == 'natural_level') {
                  // Уровень скорости вращения в режиме "натуральный ветер" (от 1 до 100)
                  if ($value) {
                     $value = (int)$value;
                     if ($value < 0) $value = 0;
                     if ($value > 100) $value = 100;
                     $this->addToQueue($properties[$i]['DEVICE_ID'], 'set_natural_level', '['.$value.']');
                  }
               } elseif ($properties[$i]['TITLE'] == 'poweroff_time') {
                  // Команда на изменения таймера выключения 
                   if ($properties[$i]['DEVICE_TYPE'] == 'uvfive.s_lamp.slmap2') {
                     $value = (int)$value;
                     $this->addToQueue($properties[$i]['DEVICE_ID'], 'set_properties', '[{"did":"poweroff_time","siid":2,"piid":6,"value":' . $value . '}]');
                  } else {
                     if ($value) {
                        $this->addToQueue($properties[$i]['DEVICE_ID'], 'set_poweroff_time', '['.$value.']');
                     }
                  }
               } elseif ($properties[$i]['TITLE'] == 'angle_enable') {
                  // Команда на включение и выключение автоматического поворота вентилятора
                  if ($value) {
                     $this->addToQueue($properties[$i]['DEVICE_ID'], 'set_angle_enable', '["on"]');
                  } else {
                     $this->addToQueue($properties[$i]['DEVICE_ID'], 'set_angle_enable', '["off"]');
                  }
               } elseif ($properties[$i]['TITLE'] == 'eyecare') {
                  // Команда на включение и выключение автоматической подстройки яркости
                  if ($value) {
                     $this->addToQueue($properties[$i]['DEVICE_ID'], 'set_eyecare', '["on"]');
                  } else {
                     $this->addToQueue($properties[$i]['DEVICE_ID'], 'set_eyecare', '["off"]');
                  }
               } elseif ($properties[$i]['TITLE'] == 'ambstatus') {
                  // Команда на включение и выключение дополнительной подсветки
                  if ($value) {
                     $this->addToQueue($properties[$i]['DEVICE_ID'], 'enable_amb', '["on"]');
                  } else {
                     $this->addToQueue($properties[$i]['DEVICE_ID'], 'enable_amb', '["off"]');
                  }
               } elseif ($properties[$i]['TITLE'] == 'ambvalue') {
                  // Команда на изменение яркости дополнительной подсветки (в % от 1 до 100)
                  $value = (int)$value;
                  if ($value < 1) $value = 1;
                  if ($value > 100) $value = 100;
                  $this->addToQueue($properties[$i]['DEVICE_ID'], 'set_amb_bright', "[$value]");
               } elseif ($properties[$i]['TITLE'] == 'notifystatus') {
                  // Команда на включение и выключение напоминания об усталости глаз
                  if ($value) {
                     $this->addToQueue($properties[$i]['DEVICE_ID'], 'set_notifyuser', '["on"]');
                  } else {
                     $this->addToQueue($properties[$i]['DEVICE_ID'], 'set_notifyuser', '["off"]');
                  }
               } elseif ($properties[$i]['TITLE'] == 'suction_grade') {
                  // Команда на изменение мощности всасывания
                  if ($properties[$i]['DEVICE_TYPE'] == 'viomi.vacuum.v7') {
                     switch($value) {
                        case 'Silent': $params = 0; break;
                        case 'Standard': $params = 1; break;
                        case 'Medium': $params = 2; break;
                        case 'Turbo': $params = 3; break;
                        default: $params = 2; break;
                     }
                     $this->addToQueue($properties[$i]['DEVICE_ID'],'set_suction', '[' . $params . ']');
                  }
               } elseif ($properties[$i]['TITLE'] == 'target_humidity') {
                  // Установка верхнего предела увлажнения (в % от 0 до 99)
                  $value = (int)$value;
                  if ($properties[$i]['DEVICE_TYPE'] == 'deerma.humidifier.mjjsq') {
                     if ($value < 0) $value = 0;
                     if ($value > 99) $value = 99;
                     $this->addToQueue($properties[$i]['DEVICE_ID'],'Set_HumiValue', '[' . $value . ']');
                  }
               } elseif ($properties[$i]['TITLE'] == 'target_temperature') {
                  $value = (int)$value;
                  if ($properties[$i]['DEVICE_TYPE'] == 'hfjh.fishbowl.v1') {
                     // Установка температуры нагрева воды в аквариуме (от 18 до 32 градусов)
                     if ($value < 18) $value = 18;
                     if ($value > 32) $value = 32;
                     $this->addToQueue($properties[$i]['DEVICE_ID'],'set_water_temp_value', '[' . $value . ']');
                  }
               } elseif ($properties[$i]['TITLE'] == 'auto_feed') {
                  $value = (int)$value;
                  if ($properties[$i]['DEVICE_TYPE'] == 'hfjh.fishbowl.v1') {
                     // Управление режимом подачи корма по расписанию
                     $this->addToQueue($properties[$i]['DEVICE_ID'],'set_feed_switch', '[' . ($value ? 'true' : 'false') . ']');
                  }
               } elseif ($properties[$i]['TITLE'] == 'single_feed') {
                  $value = (int)$value;
                  if ($properties[$i]['DEVICE_TYPE'] == 'hfjh.fishbowl.v1' && $value == 1) {
                     // Одноразовая подача корма
                     $this->addToQueue($properties[$i]['DEVICE_ID'],'set_single_feed', '[true]');
                  }
               } elseif ($properties[$i]['TITLE'] == 'heater') {
                  $value = (int)$value;
                  if ($properties[$i]['DEVICE_TYPE'] == 'hfjh.fishbowl.v1') {
                     // Управление подогревом воды
                     $this->addToQueue($properties[$i]['DEVICE_ID'],'set_heater_switch', '[' . ($value ? 'true' : 'false') . ']');
                  }
               } elseif ($properties[$i]['TITLE'] == 'pump') {
                  $value = (int)$value;
                  if ($properties[$i]['DEVICE_TYPE'] == 'hfjh.fishbowl.v1') {
                     // Управление помпой
                     $this->addToQueue($properties[$i]['DEVICE_ID'],'set_pump_switch', '[' . ($value ? 'true' : 'false') . ']');
                  }
               } elseif ($properties[$i]['TITLE'] == 'water_flow') {
                  $value = (int)$value;
                  if ($properties[$i]['DEVICE_TYPE'] == 'hfjh.fishbowl.v1') {
                     // Производительность помпы
                     if ($value < 1) $value = 1;
                     if ($value > 100) $value = 100;
                     $this->addToQueue($properties[$i]['DEVICE_ID'],'set_pump_value', '[' . $value . ']');
                  }
               } elseif ($properties[$i]['TITLE'] == 'status') {
                  $value = (int)$value;
                  if ($properties[$i]['DEVICE_TYPE'] == 'hfjh.fishbowl.v1') {
                     // Состояние аквариума (включен/выключен)
                     $this->addToQueue($properties[$i]['DEVICE_ID'],'set_Equipment_Status', '[' . ($value ? 'true' : 'false') . ']');
                  }
               }

               if($properties[$i]['DEVICE_TYPE'] == 'hfjh.fishbowl.v1') {
                  if ($properties[$i]['TITLE'] == 'led_brightness' || $properties[$i]['TITLE'] == 'led_color' || $properties[$i]['TITLE'] == 'led_flow_speed' || $properties[$i]['TITLE'] == 'led_flowing') {
                     $flowing = SQLSelectOne("SELECT miio_commands.VALUE FROM miio_commands WHERE miio_commands.TITLE LIKE 'led_flowing' AND DEVICE_ID=" . $properties[$i]['DEVICE_ID'])['VALUE'];

                     $bright = SQLSelectOne("SELECT miio_commands.VALUE FROM miio_commands WHERE miio_commands.TITLE LIKE 'led_brightness' AND DEVICE_ID=" . $properties[$i]['DEVICE_ID'])['VALUE'];

                     $speed = SQLSelectOne("SELECT miio_commands.VALUE FROM miio_commands WHERE miio_commands.TITLE LIKE 'led_flow_speed' AND DEVICE_ID=" . $properties[$i]['DEVICE_ID'])['VALUE'];

                     $color = SQLSelectOne("SELECT miio_commands.VALUE FROM miio_commands WHERE miio_commands.TITLE LIKE 'led_color' AND DEVICE_ID=" . $properties[$i]['DEVICE_ID'])['VALUE'];
                     $color = hexdec(preg_replace('/^#/', '', $color));

                     if ($flowing == 1) $mode = 2;
                      else $mode = 1;

                     if ($properties[$i]['TITLE'] == 'led_brightness') {
                        $bright = (int)$value;
                        if ($bright < 0) $bright = 0;
                        if ($bright > 100) $bright = 100;
                     } elseif ($properties[$i]['TITLE'] == 'led_color') {
                        $value = preg_replace('/^#/', '', $value);
                        $color = hexdec($value);
                        if ($color < 0 && $color > 16777215) {
                           $color = 16777215;
                        }
                     } elseif ($properties[$i]['TITLE'] == 'led_flowing') {
                        $value = (int)$value;
                        if ($value == 1) $mode = 2;
                         else $mode = 1;
                     } elseif ($properties[$i]['TITLE'] == 'led_flow_speed') {
                        $speed = (int)$value;
                        if ($speed < 0) $speed = 0;
                        if ($speed > 100) $speed = 100;
                        $mode = 2;
                     }

                     if ($mode == 0 || $mode == 1) {
                        $params = "[$mode,$color,100,$bright]";
                     } else if ($mode == 2) {
                        $params = "[$mode,120,$speed,$bright]";
                     }

                     $this->addToQueue($properties[$i]['DEVICE_ID'],'set_led_board', $params);
                  }
               }

               if($properties[$i]['DEVICE_TYPE'] == 'hfjh.fishbowl.v1') {
                  if ($properties[$i]['TITLE'] == 'led_brightness' || $properties[$i]['TITLE'] == 'led_color' || $properties[$i]['TITLE'] == 'led_flow_speed' || $properties[$i]['TITLE'] == 'led_flowing') {
                     $flowing = SQLSelectOne("SELECT miio_commands.VALUE FROM miio_commands WHERE miio_commands.TITLE LIKE 'led_flowing' AND DEVICE_ID=" . $properties[$i]['DEVICE_ID'])['VALUE'];

                     $bright = SQLSelectOne("SELECT miio_commands.VALUE FROM miio_commands WHERE miio_commands.TITLE LIKE 'led_brightness' AND DEVICE_ID=" . $properties[$i]['DEVICE_ID'])['VALUE'];

                     $speed = SQLSelectOne("SELECT miio_commands.VALUE FROM miio_commands WHERE miio_commands.TITLE LIKE 'led_flow_speed' AND DEVICE_ID=" . $properties[$i]['DEVICE_ID'])['VALUE'];

                     $color = SQLSelectOne("SELECT miio_commands.VALUE FROM miio_commands WHERE miio_commands.TITLE LIKE 'led_color' AND DEVICE_ID=" . $properties[$i]['DEVICE_ID'])['VALUE'];
                     $color = hexdec(preg_replace('/^#/', '', $color));

                     if ($flowing == 1) $mode = 2;
                      else $mode = 1;

                     if ($properties[$i]['TITLE'] == 'led_brightness') {
                        $bright = (int)$value;
                        if ($bright < 0) $bright = 0;
                        if ($bright > 100) $bright = 100;
                     } elseif ($properties[$i]['TITLE'] == 'led_color') {
                        $value = preg_replace('/^#/', '', $value);
                        $color = hexdec($value);
                        if ($color < 0 && $color > 16777215) {
                           $color = 16777215;
                        }
                     } elseif ($properties[$i]['TITLE'] == 'led_flowing') {
                        $value = (int)$value;
                        if ($value == 1) $mode = 2;
                         else $mode = 1;
                     } elseif ($properties[$i]['TITLE'] == 'led_flow_speed') {
                        $speed = (int)$value;
                        if ($speed < 0) $speed = 0;
                        if ($speed > 100) $speed = 100;
                        $mode = 2;
                     }

                     if ($mode == 0 || $mode == 1) {
                        $params = "[$mode,$color,100,$bright]";
                     } else if ($mode == 2) {
                        $params = "[$mode,120,$speed,$bright]";
                     }

                     $this->addToQueue($properties[$i]['DEVICE_ID'],'set_led_board', $params);
                  }
               }

               if($properties[$i]['DEVICE_TYPE'] == '090615.switch.xswitch03') {
                  $value = (int)$value;
                  switch($properties[$i]['TITLE']) {
                     case 'channel_1': $method = 'SetSwitch1'; break;
                     case 'channel_2': $method = 'SetSwitch2'; break;
                     case 'channel_3': $method = 'SetSwitch3'; break;
                     case 'switch_all': $method = 'SetSwitchAll'; break;
                     case 'backlight': $method = 'SetBlacklight'; break;
                  }
                  if ($method == 'SetSwitchAll') {
                     $params = "[$value,$value,$value]";
                  } else {
                     $params = "[$value]";
                  }
                  $this->addToQueue($properties[$i]['DEVICE_ID'], $method, $params);
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
						} else if ($properties[$i]['TITLE'] == 'add_program') {
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
						} else if ($properties[$i]['TITLE'] == 'arming_mode') {
                     // Управление режимом охраны
                     if ($value) {
                        $this->addToQueue($properties[$i]['DEVICE_ID'], 'set_arming', '["on"]');
                     } else {
                        $this->addToQueue($properties[$i]['DEVICE_ID'], 'set_arming', '["off"]');
                     }
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
         $params['PROPERTY'] = $command;
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
					$res_commands[] = array('command' => 'all_program', 'value' => json_encode($data['result']));
				}
				if ($command == 'get_lumi_dpf_aes_key' && is_array($data['result'])) {
					$res_commands[] = array('command' => 'lumi_dpf_aes_key', 'value' => $data['result'][0]);
				}
				if ($command == 'get_zigbee_channel' && is_array($data['result'])) {
					$res_commands[] = array('command' => 'zigbee_channel', 'value' => $data['result'][0]);
				}
            if ($command == 'get_arming' && is_array($data['result'])) {
               if ($data['result'][0] != 'oning') {
                  $res_commands[] = array('command' => 'arming_mode', 'value' => $data['result'][0]);
               }
            }
            if ($device['DEVICE_TYPE'] == 'lumi.acpartner.v3') {
               if ($command == 'get_device_prop' && is_array($data['result'])) {
                  $res_commands[] = array('command' => 'power', 'value' => $data['result'][0]);
                  $res_commands[] = array('command' => 'load_power', 'value' => $data['result'][1]);
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
               if ($key == 'scene_num') $key = 'snm';
                else if ($key == 'dvalue') $key = 'dv';
                 else if ($key == 'bls') $key = 'bl';
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
						} else if ($key == 'error_code') {
							$error_codes = unserialize (MIIO_MIVACUUM_1_ERROR_CODES);
							if (array_key_exists($value, $error_codes)) $res_commands[] = array('command' => 'error_text', 'value' => $error_codes[$value]);
						} else if ($key == 'main_brush_work_time') {
							$value = round(300 - $value/3600);
							$res_commands[] = array('command' => 'main_brush_work_life', 'value' => ($value < 0) ? 0 : $value);
						} else if ($key == 'side_brush_work_time') {
							$value = round(200 - $value/3600);
							$res_commands[] = array('command' => 'side_brush_work_life', 'value' => ($value < 0) ? 0 : $value);
						} else if ($key == 'filter_work_time') {
							$value = round(150 - $value/3600);
							$res_commands[] = array('command' => 'filter_work_life', 'value' => ($value < 0) ? 0 : $value);
						} else if ($key == 'sensor_dirty_time') {
							$value = round(30 - $value/3600);
							$res_commands[] = array('command' => 'sensor_dirty_life', 'value' => ($value < 0) ? 0 : $value);
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
			} elseif (($device['DEVICE_TYPE'] == 'yeelink.light.ceiling1') || ($device['DEVICE_TYPE'] == 'yeelink.light.ceiling8') || ($device['DEVICE_TYPE'] == 'yeelink.light.ceiling3')) {
				if ($command == 'get_prop' && is_array($data['result'])) {
					$props = explode(',', MIIO_YEELIGHT_CEILING_LIGHT_PROPS);
					$i = 0;
					foreach($props as $key) {
						$value = $data['result'][$i];
						if ($key == 'flow_params') $key = 'flow';
						if ($key == 'nl_br' && $value != 0) {
							$res_commands[3]['value'] = $value;	// свойство bright
							$res_commands[] = array('command' => $key, 'value' => 1);
						} else {
							$res_commands[] = array('command' => $key, 'value' => $value);
						}
						$i++;
					}
				}
			} elseif ($device['DEVICE_TYPE'] == 'yeelink.light.ceiling4' && $command == 'get_prop' && is_array($data['result'])) {
				$props = explode(',', MIIO_YEELIGHT_CEILING_LIGHT_650_PROPS);
				$i = 0;
				foreach($props as $key) {
					$value = $data['result'][$i];
					if ($key == 'flow_params') $key = 'flow';
					if ($key == 'bg_flow_params') $key = 'bg_flow';
					if ($key == 'bg_rgb') {
						$value = str_pad(dechex($value), 6, '0', STR_PAD_LEFT);
					}
					if ($key == 'nl_br' && $value != 0) {
						$res_commands[3]['value'] = $value;	// свойство bright
						$res_commands[] = array('command' => $key, 'value' => 1);
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
						if ($value == '' || $value == 'null' || $value == null) $value = '0';
					}
					if ($key == 'mode') {
						if ($value == 'null' || $value == null) $value = '';
					}
					$res_commands[] = array('command' => $key, 'value' => $value);
					$i++;
				}
			} elseif ($device['DEVICE_TYPE'] == 'qmi.powerstrip.v1' && $command == 'get_prop' && is_array($data['result'])) {
				$props = explode(',', MIIO_QMI_POWERSTRIP_1_PROPS);
				$i = 0;
				foreach($props as $key) {
					$value = $data['result'][$i];
					if ($key == 'current') {
						if ($value == '' || $value == 'null' || $value == null) $value = '0';
						else $value = $value/1000;
					} elseif ($key == 'voltage') {
						if ($value == '' || $value == 'null' || $value == null) $value = '0';
						else $value = $value/100;
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
			} elseif ($device['DEVICE_TYPE'] == 'zhimi.airpurifier.v3' && $command == 'get_prop' && is_array($data['result'])) {
				$props = explode(',', MIIO_ZHIMI_AIRPURIFIER_V3_PROPS);
				$i = 0;
				foreach($props as $key) {
					$value = $data['result'][$i];
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
			} elseif ($device['DEVICE_TYPE'] == 'zhimi.fan.sa1' && $command == 'get_prop' && is_array($data['result'])) {
            $props = explode(',', MIIO_ZHIMI_FAN_SA1_PROPS);
            $i = 0;
            foreach($props as $key) {
               $value = $data['result'][$i];
               $res_commands[] = array('command' =>  $key, 'value' => $value);
               $i++;
            }
         } elseif ($device['DEVICE_TYPE'] == 'cgllc.airmonitor.s1' && $command == 'get_prop' && is_array($data['result'])) {
            foreach($data['result'] as $key => $value) {
               $res_commands[] = array('command' => $key, 'value' => $value);
            }
         } elseif ($device['DEVICE_TYPE'] == 'zhimi.airpurifier.mb3' && $command == 'get_properties' && is_array($data['result'])) {
            foreach($data['result'] as $res) {
               $value = $res['value'];
               if ($value === true) $value = 1;
                else if ($value === false) $value = 0;
               if ($res['did'] == 'led_b') {
                  switch($value) {
                     case 0: $value = 'bright'; break;
                     case 1: $value = 'dim'; break;
                     case 2: $value = 'off'; break;
                     default: $value = 'unknown'; break;
                  }
               } else if ($res['did'] == 'mode') {
                  switch($value) {
                     case 0: $value = 'auto'; break;
                     case 1: $value = 'silent'; break;
                     case 2: $value = 'favorite'; break;
                     case 3: $value = 'fan'; break;
                  }
               }
               $res_commands[] = array('command' => $res['did'], 'value' => $value);
            }
         } elseif ($device['DEVICE_TYPE'] == 'viomi.vacuum.v7' && $command == 'get_prop' && is_array($data['result'])) {
            $props = explode(',', MIIO_VIOMIVACUUM_V7_PROPS);
            $i = 0;
            foreach($props as $key) {
               $value = $data['result'][$i];
               if ($key == 'run_state') {
                  $key = 'state_code';
                  $state_codes = unserialize (MIIO_VIOMIVACUUM_V7_STATE_CODES);
                  if (array_key_exists($value, $state_codes)) $res_commands[] = array('command' => 'state_text', 'value' => $state_codes[$value]);
                   else $res_commands[] = array('command' => 'state_text', 'value' => 'Unknown');
               } else if ($key == 'err_state') {
                  $key = 'error_code';
                  $state_codes = unserialize (MIIO_VIOMIVACUUM_V7_ERROR_CODES);
                  if (array_key_exists($value, $state_codes)) $res_commands[] = array('command' => 'error_text', 'value' => $state_codes[$value]);
                   else $res_commands[] = array('command' => 'error_text', 'value' => 'Unknown');
               } else if ($key == 'mode') {
                  switch($value) {
                     case 0: $value = 'Vacuum'; break;
                     case 1: $value = 'VacuumAndMop'; break;
                     case 2: $value = 'Mop'; break;
                  }
               } else if ($key == 'box_type') {
                  switch($value) {
                     case 1: $value = 'Vacuum'; break;
                     case 2: $value = 'Water'; break;
                     case 3: $value = 'VacuumAndWater'; break;
                  }
               } else if ($key == 'suction_grade') {
                  switch($value) {
                     case 0: $value = 'Silent'; break;
                     case 1: $value = 'Standard'; break;
                     case 2: $value = 'Medium'; break;
                     case 3: $value = 'Turbo'; break;
                  }
               } else if ($key == 'water_grade') {
                  switch($value) {
                     case 11: $value = 'Low'; break;
                     case 12: $value = 'Medium'; break;
                     case 13: $value = 'High'; break;
                  }
               } else if ($key == 'battary_life') {
                  $key = 'battery';
               } else if ($key == 's_time') {
                  $key = 'clean_time';
               } else if ($key == 's_area') {
                  $key = 'clean_area';
               }
               $res_commands[] = array('command' => $key, 'value' => $value);
               $i++;
            }
         } elseif ($device['DEVICE_TYPE'] == 'cgllc.airmonitor.b1' && $command == 'get_air_data' && is_array($data['result'])) {
            foreach($data['result'] as $key => $value) {
               if ($key !== 'temperature_unit' && $key !== 'tvoc_unit') {
                  if ($key == 'co2e') {
                     $key = 'co2';
                  } else {
                     $value = round($value, 2);
                  }
                  $res_commands[] = array('command' => $key, 'value' => $value);
               }
            }
         } elseif (($device['DEVICE_TYPE'] == 'yunmi.kettle.r1') || ($device['DEVICE_TYPE'] == 'yunmi.kettle.r2') || ($device['DEVICE_TYPE'] == 'yunmi.kettle.r3')) {
            if ($command == 'get_prop' && is_array($data['result'])) {
               $props = explode(',', MIIO_YUNMI_KETTLE_R1_PROPS);
               $i = 0;
               foreach($props as $key) {
                  $value = $data['result'][$i];
                  $res_commands[] = array('command' => $key, 'value' => $value);
                  $i++;
               }
            }
         } elseif ($device['DEVICE_TYPE'] == 'deerma.humidifier.mjjsq' && $command == 'get_prop' && is_array($data['result'])) {
            $props = explode(',', MIIO_DEERMA_HUMIDIFIER_MJJSQ_PROPS);
            $i = 0;
            foreach($props as $key) {
               $value = $data['result'][$i];
               switch($key) {
                  case 'OnOff_State': $key = 'power'; break;
                  case 'TemperatureValue': $key = 'temperature'; break;
                  case 'Humidity_Value': $key = 'humidity'; break;
                  case 'HumiSet_Value': $key = 'target_humidity'; break;
                  case 'Humidifier_Gear': $key = 'mode'; break;
                  case 'Led_State': $key = 'led'; break;
                  case 'TipSound_State': $key = 'buzzer'; break;
                  case 'waterstatus': $key = 'water_status'; break;
                  case 'watertankstatus': $key = 'water_tank_status'; break;
               }
               if ($key == 'mode') {
                  switch($value) {
                     case 1: $value = 'low'; break;
                     case 2: $value = 'medium'; break;
                     case 3: $value = 'high'; break;
                     case 4: $value = 'humidity'; break;
                  }
               }
               $res_commands[] = array('command' => $key, 'value' => $value);
               $i++;
            }
         } elseif ($device['DEVICE_TYPE'] == 'hfjh.fishbowl.v1') {
            if ($command == 'get_prop' && is_array($data['result'])) {
               $props = explode(',', MIIO_HFJH_FISHBOWL_V1_PROPS);
               $i = 0;
               foreach($props as $key) {
                  $value = $data['result'][$i];
                  $i++;
                  if ($value === true) $value = 1;
                   else if ($value === false) $value = 0;
                  switch($key) {
                     case 'Equipment_Status': $key = 'status'; break;
                     case 'water_tds': $key = 'tds'; break;
                     case 'water_temp': $key = 'temperature'; break;
                     case 'water_temp_value': $key = 'target_temperature'; break;
                     case 'heater_switch': $key = 'heater'; break;
                     case 'pump_switch': $key = 'pump'; break;
                     case 'pump_value': $key = 'water_flow'; break;
                     case 'feed_switch': $key = 'auto_feed'; break;
                     case 'led_board_brightness': $key = 'led_brightness'; break;
                     case 'led_board_color': $key = 'led_color'; break;
                     case 'led_board_speed': $key = 'led_flow_speed'; break;
                  }
                  if ($key == 'led_color') {
                     $value = str_pad(dechex($value), 6, '0', STR_PAD_LEFT);
                  } else if ($key == 'led_board_model') {
                     if ($value == 2) $res_commands[] = array('command' => 'led_flowing', 'value' => 1);
                      else $res_commands[] = array('command' => 'led_flowing', 'value' => 0);
                     continue;
                  }
                  $res_commands[] = array('command' => $key, 'value' => $value);
               }
            } else if ('get_key_switch' && is_array($data['result'])) {
               $value = ($data['result'][0]) ? 1 : 0;
               $res_commands[] = array('command' => 'child_lock', 'value' => $value);
            }
         } elseif ($device['DEVICE_TYPE'] == 'uvfive.s_lamp.slmap2' && $command == 'get_properties' && is_array($data['result'])) {
            foreach($data['result'] as $res) {
               $value = $res['value'];
               if ($value === true) $value = 1;
                else if ($value === false) $value = 0;
               if ($res['did'] == 'state_code') {
                  switch($value) {
                     case 1: $state_text = 'off'; break;
                     case 3: $state_text = 'pause'; break;
                     case 4: $state_text = 'active'; break;
                  }
                  $res_commands[] = array('command' => 'state_text', 'value' => $state_text);
               }
               $res_commands[] = array('command' => $res['did'], 'value' => $value);
            }
         } elseif ($device['DEVICE_TYPE'] == '090615.switch.xswitch03' && $command == 'get_prop' && is_array($data['result'])) {
            $res_commands[] = array('command' => 'channel_1', 'value' => $data['result'][0]);
            $res_commands[] = array('command' => 'channel_2', 'value' => $data['result'][1]);
            $res_commands[] = array('command' => 'channel_3', 'value' => $data['result'][2]);
            $res_commands[] = array('command' => 'backlight', 'value' => $data['result'][3]);
         }
      }

      foreach ($res_commands as $c) {
         $cmd = $c['command'];
         $val = $c['value'];
         if ($val === 'on') {
            $val = 1;
         } else if ($val === 'off') {
            if ($cmd !== 'led_b' && $cmd !== 'state_text') {
               $val = 0;
            }
         }
         $this->processCommand($device['ID'], $cmd, $val);
      }

   }

   /**
   * runInBackground
   *
   * Запуск обработки сообщений от устройств в фоновом процессе.
   *
   * @access public
   */

   function runInBackground($url) {
      try {
         $ch = curl_init();
         curl_setopt($ch, CURLOPT_URL, $url);
         curl_setopt($ch, CURLOPT_NOSIGNAL, 1);
         curl_setopt($ch, CURLOPT_TIMEOUT_MS, 50);
         curl_exec($ch);
         curl_close($ch);
      }
      catch (Exception $e) {
         DebMes('Exception in RunInBackground(): ' . $url . '. ' . get_class($e) . ', ' . $e->getMessage(), 'xiaomimiio');
      }
   }

   /**
   * DeleteLinkedProperties
   *
   * Удаление слинкованных свойств.
   *
   * @access public
   */

   function DeleteLinkedProperties($id)
   {
      $properties = SQLSelect("SELECT * FROM miio_commands WHERE DEVICE_ID='{$id}' AND LINKED_OBJECT != '' AND LINKED_PROPERTY != ''");

      if (!empty($properties)) {
         foreach ($properties as $prop) {
            removeLinkedProperty($prop['LINKED_OBJECT'], $prop['LINKED_PROPERTY'], $this->name);
         }
      }
   }

   /**
   * DeleteCycleProperties
   *
   * Удаление служебных свойств контроля состояния цикла у объекта ThisComputer.
   *
   * @access public
   */

   function DeleteCycleProperties()
   {
      $cycle_name = 'cycle_' . $this->name;
      $cycle_props = array("{$cycle_name}Run", "{$cycle_name}Control", "{$cycle_name}Disabled", "{$cycle_name}AutoRestart");

      $object = getObject('ThisComputer');

      foreach ($cycle_props as $property) {
         $property_id = $object->getPropertyByName($property, $object->class_id, $object->id);
         if ($property_id) {
            $value_id = getValueIdByName($object->object_title, $property);
            if ($value_id) {
               SQLExec("DELETE FROM phistory WHERE VALUE_ID={$value_id}");
               SQLExec("DELETE FROM pvalues WHERE ID={$value_id}");
            }
            if ($object->class_id != 0) {
               SQLExec("DELETE FROM properties WHERE ID={$property_id}");
            }
         }
      }

      SQLExec("DELETE FROM cached_values WHERE KEYWORD LIKE '%{$cycle_name}%'");
      SQLExec("DELETE FROM cached_ws WHERE PROPERTY LIKE '%{$cycle_name}%'");
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

      echo '<br>' . date('H:i:s') . " Uninstall module {$this->name}.<br>";

      // Остановим цикл модуля.
      echo date('H:i:s') . " Stopping cycle cycle_{$this->name}.php.<br>";
      setGlobal("cycle_{$this->name}Control", 'stop');
      // Нужна пауза, чтобы главный цикл обработал запрос.
      $i = 0;
      while ($i < 6) {
         echo '.';
         $i++; 
         sleep(1);
      }

      // Удалим слинкованные свойства объектов у метрик каждого ТВ.
      echo '<br>' . date('H:i:s') . ' Delete linked properties.<br>';
      $devices = SQLSelect("SELECT * FROM miio_devices");
      if (!empty($devices)) {
         foreach ($devices as $device) {
            $this->DeleteLinkedProperties($device['ID']);
         }
      }

      // Удаляем таблицы модуля из БД.
      echo date('H:i:s') . ' Delete DB tables.<br>';
      SQLExec('DROP TABLE IF EXISTS miio_devices');
      SQLExec('DROP TABLE IF EXISTS miio_commands');
      SQLExec('DROP TABLE IF EXISTS miio_queue');

      // Удаляем служебные свойства контроля состояния цикла у объекта ThisComputer.
      echo date('H:i:s') . ' Delete cycles properties.<br>';
      $this->DeleteCycleProperties();

      // Удаляем модуль с помощью "родительской" функции ядра.
      echo date('H:i:s') . ' Delete files and remove frome system.<br>';
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
