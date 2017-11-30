<?php
/**
* miIO 
* @package project
* @author Wizard <sergejey@gmail.com>
* @copyright http://majordomo.smartliving.ru/ (c)
* @version 0.1 (wizard, 13:11:31 [Nov 25, 2017])
*/

Define('MIIO_YEELIGHT_WHITE_BULB_PROPS', 'power,bright');
Define('MIIO_PHILIPS_LIGHT_BULB_PROPS', 'power,bright,cct,snm,dv');
Define('MIIO_PHILIPS_EYECARE_LAMP_2_PROPS', 'power,bright,notifystatus,ambstatus,ambvalue,eyecare,scene_num,bls,dvalue');

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
	
	function saveParams($data=0) {
		$p=array();
		if (IsSet($this->id)) {
			$p["id"]=$this->id;
		}
		if (IsSet($this->view_mode)) {
			$p["view_mode"]=$this->view_mode;
		}
		if (IsSet($this->edit_mode)) {
			$p["edit_mode"]=$this->edit_mode;
		}
		if (IsSet($this->data_source)) {
			$p["data_source"]=$this->data_source;
		}
		if (IsSet($this->tab)) {
			$p["tab"]=$this->tab;
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
			$this->id=$id;
		}
		if (isset($mode)) {
			$this->mode=$mode;
		}
		if (isset($view_mode)) {
			$this->view_mode=$view_mode;
		}
		if (isset($edit_mode)) {
			$this->edit_mode=$edit_mode;
		}
		if (isset($data_source)) {
			$this->data_source=$data_source;
		}
		if (isset($tab)) {
			$this->tab=$tab;
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
		$out=array();
		if ($this->action=='admin') {
			$this->admin($out);
		} else {
			$this->usual($out);
		}
		
		if (IsSet($this->owner->action)) {
			$out['PARENT_ACTION']=$this->owner->action;
		}
  
		if (IsSet($this->owner->name)) {
			$out['PARENT_NAME']=$this->owner->name;
		}
  
		$out['VIEW_MODE']=$this->view_mode;
		$out['EDIT_MODE']=$this->edit_mode;
		$out['MODE']=$this->mode;
		$out['ACTION']=$this->action;
		$out['DATA_SOURCE']=$this->data_source;
		$out['TAB']=$this->tab;
		$this->data=$out;
		$p=new parser(DIR_TEMPLATES.$this->name."/".$this->name.".html", $this->data, $this);
		$this->result=$p->result;
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
		$out['API_LOG_DEBMES'] = $this->config['API_LOG_DEBMES'];
		$out['API_LOG_MIIO'] = $this->config['API_LOG_MIIO'];
	
		if ($this->view_mode == 'update_settings') {
			global $api_ip;
			$this->config['API_IP'] = $api_ip;

			global $api_log_debmes;
			$this->config['API_LOG_DEBMES'] = (int)$api_log_debmes;
		
			global $api_log_miio;
			$this->config['API_LOG_MIIO'] = (int)$api_log_miio;

			$this->saveConfig();
			
			// После изменения настроек модуля перезапускаем цикл
			setGlobal('cycle_xiaomimiioControl', 'restart');

			$this->redirect("?");
		}
	
		if (isset($this->data_source) && !$_GET['data_source'] && !$_POST['data_source']) {
			$out['SET_DATASOURCE']=1;
		}
 
		if ($this->data_source=='miio_devices' || $this->data_source=='') {
			if ($this->view_mode=='' || $this->view_mode=='search_miio_devices') {
				$this->search_miio_devices($out);
			}

			if ($this->view_mode == 'discover') {
				$this->discover();
				sleep(12);
				$this->redirect('?');
			}

			if ($this->view_mode=='edit_miio_devices') {
				$this->edit_miio_devices($out, $this->id);
			}
			if ($this->view_mode=='delete_miio_devices') {
				$this->delete_miio_devices($this->id);
				$this->redirect("?data_source=miio_devices");
			}
		}
	}

	/**
	* addToQueue
	*
	* ...
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
	* ...
	*
	* @access public
	*/

	function discover($ip = '') {
	
		$this->addToQueue(0, 'discover_all');
	
	}

	/**
	* requestInfo
	*
	* ...
	*
	* @access public
	*/
	
	function requestInfo($device_id) {
	
		$this->addToQueue($device_id, 'miIO.info');
	
	}


	function requestStatus($device_id) {
		
		$device_rec = SQLSelectOne("SELECT * FROM miio_devices WHERE ID=" . (int)$device_id);
		
		//DebMes($device_rec['DEVICE_TYPE'], 'xiaomimiio');
		//DebMes('[requestStatus] DEVICE_TYPE='.$device_rec['DEVICE_TYPE'], 'xiaomimiio');
		
		if ($device_rec['DEVICE_TYPE'] == 'philips.light.bulb') {
			$props=explode(',', MIIO_PHILIPS_LIGHT_BULB_PROPS);
			$total = count($props);
			for ($i = 0; $i < $total; $i++) {
				$props[$i] = '"' . $props[$i] . '"';
			}
			$this->addToQueue($device_id, 'get_prop', '['.implode(',',$props).']');
		} elseif ($device_rec['DEVICE_TYPE'] == 'philips.light.sread1') {
			$props = explode(',', MIIO_PHILIPS_EYECARE_LAMP_2_PROPS);
			$total = count($props);
			for ($i = 0; $i < $total; $i++) {
				$props[$i] = '"' . $props[$i] . '"';
			}
			$this->addToQueue($device_id, 'get_prop', '['.implode(',',$props).']');
		} elseif ($device_rec['DEVICE_TYPE'] == 'yeelink.light.mono1') {
			$props = explode(',', MIIO_YEELIGHT_WHITE_BULB_PROPS);
			$total = count($props);
			for ($i = 0; $i < $total; $i++) {
				$props[$i] = '"' . $props[$i] . '"';
			}
			$this->addToQueue($device_id, 'get_prop', '[' . implode(',', $props) . ']');
		} else if ($device_rec['DEVICE_TYPE'] == 'rockrobo.vacuum.v1') {
			$this->addToQueue($device_id, 'get_status');
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
			} else if ($op == 'discover_all') {
				//global $device_id;
				//global $message;
				//global $command;
				//$this->processMessage($message, $command, $device_id);
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
  require(DIR_MODULES.$this->name.'/miio_devices_search.inc.php');
 }
/**
* miio_devices edit/add
*
* @access public
*/
 function edit_miio_devices(&$out, $id) {
  require(DIR_MODULES.$this->name.'/miio_devices_edit.inc.php');
 }
/**
* miio_devices delete record
*
* @access public
*/
 function delete_miio_devices($id) {
  $rec=SQLSelectOne("SELECT * FROM miio_devices WHERE ID='$id'");
  // some action for related tables
  SQLExec("DELETE FROM miio_commands WHERE DEVICE_ID='".$rec['ID']."'");
  SQLExec("DELETE FROM miio_devices WHERE ID='".$rec['ID']."'");
 }
	
	/**
	* propertySetHandle
	*
	* ...
	*
	* @access private
	*/
	
	function propertySetHandle($object, $property, $value) {
	
		$this->getConfig();
		$table = 'miio_commands';
	
		$properties = SQLSelect("SELECT miio_commands.*, miio_devices.DEVICE_TYPE FROM miio_commands LEFT JOIN miio_devices ON miio_devices.ID=miio_commands.DEVICE_ID WHERE miio_commands.LINKED_OBJECT LIKE '".DBSafe($object)."' AND miio_commands.LINKED_PROPERTY LIKE '".DBSafe($property)."'");
	
		$total = count($properties);
   
		if ($total) {
			for($i = 0; $i < $total; $i++) {
				if ($properties[$i]['TITLE'] == 'command') { // any custom command without params
					$this->addToQueue($properties[$i]['DEVICE_ID'], $value, '[]');
				} elseif ($properties[$i]['TITLE'] == 'power') { // power command
					if ($value) {
						$this->addToQueue($properties[$i]['DEVICE_ID'], 'set_power', '["on"]');
					} else {
						$this->addToQueue($properties[$i]['DEVICE_ID'], 'set_power', '["off"]');
					}
				} elseif ($properties[$i]['TITLE'] == 'bright') { // bright command
					$value = (int)$value;
					if ($value < 1) $value = 1;
					if ($value > 100) $value = 100;
					$this->addToQueue($properties[$i]['DEVICE_ID'], 'set_bright', "[$value]");
				}
				SQLExec("UPDATE miio_commands SET VALUE='".DBSafe($value)."' WHERE ID=".$properties[$i]['ID']);
			}
		}
	}

	
	
	function processCommand($device_id, $command, $value, $params = 0) {
		
		//DebMes("processCommand($device_id, $command, $value, $params)", 'xiaomimiio');
		
  $cmd_rec=SQLSelectOne("SELECT * FROM miio_commands WHERE DEVICE_ID=".(int)$device_id." AND TITLE LIKE '".DBSafe($command)."'");
  if (!$cmd_rec['ID']) {
   $cmd_rec=array();
   $cmd_rec['TITLE']=$command;
   $cmd_rec['DEVICE_ID']=$device_id;
   $cmd_rec['ID']=SQLInsert('miio_commands',$cmd_rec);
  }

  $old_value=$cmd_rec['VALUE'];

  $cmd_rec['VALUE']=$value;
  $cmd_rec['UPDATED']=date('Y-m-d H:i:s');
  SQLUpdate('miio_commands',$cmd_rec);

  if ($cmd_rec['LINKED_OBJECT'] && $cmd_rec['LINKED_PROPERTY']) {
   setGlobal($cmd_rec['LINKED_OBJECT'] . '.' . $cmd_rec['LINKED_PROPERTY'], $value, array($this->name => '0'));
  }
		if ($cmd_rec['LINKED_OBJECT'] && $cmd_rec['LINKED_METHOD']) {
			if (!is_array($params)) {
				$params = array();
			}
			$params['VALUE'] = $value;
			callMethodSafe($cmd_rec['LINKED_OBJECT'] . '.' . $cmd_rec['LINKED_METHOD'], $params);
		}

	}
	
	/**
	* processMessage
	*
	* ...
	*
	* @access private
	*/

	function processMessage($message, $command, $device_id) {

		$this->getConfig();
		
		if ($this->config['API_LOG_DEBMES']) {
			DebMes("Incoming message from $device_id ($command): $message", 'xiaomimiio');
		}
		
		$res_commands = array();

		if ($device_id) {
			$device = SQLSelectOne("SELECT * FROM miio_devices WHERE ID=" . (int)$device_id);
		}

		$data = json_decode($message, true);

		if ($command == 'discover_all') {
			if (is_array($data['devices'])) {
				foreach($data['devices'] as $dev) {
					$dev = json_decode($dev, true);
					$device_type_code = $dev['devicetype'];
					$device_serial = $dev['serial'];
					$token = $dev['token'];
							
					if (preg_match('/^0+$/', $token)) {
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
			
			$res_commands[] = array('command' => 'message', 'value' => $message);
			$res_commands[] = array('command' => 'online', 'value' => 1);

			// PROCESSING REPLY MESSAGE
			if ($device['DEVICE_TYPE'] == 'lumi.gateway.v3') {
				//to-do
			} elseif ($device['DEVICE_TYPE'] == 'yeelink.light.mono1' && $command == 'get_prop' && is_array($data['result'])) {
				$props = explode(',', MIIO_YEELIGHT_WHITE_BULB_PROPS);
				$i = 0;
				foreach($props as $key) {
					$value = $data['result'][$i];
					$res_commands[] = array('command' => $key, 'value' => $value);
					$i++;
				}
			} elseif ($device['DEVICE_TYPE'] == 'philips.light.bulb' && $command == 'get_prop' && is_array($data['result'])) {
				$props = explode(',', MIIO_PHILIPS_LIGHT_BULB_PROPS);
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
			} elseif ($device['DEVICE_TYPE'] == 'rockrobo.vacuum.v1' && $command == 'get_status' && is_array($data['result'])) {
				foreach($data['result'] as $key=>$value) {
					//$res_commands[] = array($key=>$value);
					$res_commands[] = array('command' => $key, 'value' => $value);
					// добавить в массив параметры статус_текст и еррор_текст
				}
			}
		}
		
		//DebMes(implode($res_commands), 'xiaomimiio');
		//$dt = serialize($res_commands). PHP_EOL;
		//file_put_contents('miio_debug', $dt, FILE_APPEND | LOCK_EX);
		//$value = '';
		foreach ($res_commands as $c) {
            $cmd = $c['command'];
            $val = $c['value'];
			if ($cmd == 'power') {
				if ($val == 'on') $val = 1;
				 else if ($val == 'off') $val = 0;
			}
			//DebMes("cmd=$cmd value=$val", 'xiaomimiio');
			$this->processCommand($device['ID'], $cmd, $val);
        }
		
		//foreach($res_commands as $cmd => $value) {
			//if ($value == 'on') $value = 1;
			//if ($value == 'off') $value = 0;
			//DebMes("cmd=$cmd value=$value", 'xiaomimiio');
			//$this->processCommand($device['ID'], $cmd, $value);
		//}

	}
	
	/**
	* Install
	*
	* Module installation routine
	*
	* @access private
	*/
 
	function install($data = '') {
		
		//setGlobal('cycle_schedappControl', 'restart');
		//setGlobal('cycle_schedappAutoRestart', '1');
		//$this->name
		
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
		
		//перед удалением таблиц нужно остановить цикл, если он запущен, чтобы не было ошибок SQL
		
		SQLExec('DROP TABLE IF EXISTS miio_devices');
		SQLExec('DROP TABLE IF EXISTS miio_commands');
		SQLExec('DROP TABLE IF EXISTS miio_queue');
  
		if (file_exists(ROOT.'scripts/cycle_xiaomimiio.php')) {
			unlink(ROOT.'scripts/cycle_xiaomimiio.php');
		}
		
		//также нужно удалить сведения о цикле из Xray и свойства из объекта ThisComputer
		//ThisComputer.cycle_xiaomimiioRun
		//ThisComputer.cycle_xiaomimiioControl
		//ThisComputer.cycle_xiaomihomeDisabled
		//ThisComputer.cycle_xiaomimiioAutoRestart
		
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
			miio_devices: MODEL varchar(255) NOT NULL DEFAULT ''
			miio_devices: HW_VER varchar(255) NOT NULL DEFAULT ''
			miio_devices: SERIAL varchar(255) NOT NULL DEFAULT '' 
			miio_devices: UPDATE_PERIOD int(10) NOT NULL DEFAULT '0'
			miio_devices: NEXT_UPDATE datetime 
 
			miio_commands: ID int(10) unsigned NOT NULL auto_increment
			miio_commands: TITLE varchar(100) NOT NULL DEFAULT ''
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
