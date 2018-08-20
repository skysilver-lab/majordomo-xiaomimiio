<?php
/**
 * English language file for Xiaomi miIO module
 *
 * @package Xiaomi miIO 
 * @author <skysilver.da@gmail.com>
 * @copyright 2017-2018 Agaphonov Dmitri aka skysilver <skysilver.da@gmail.com> (c)
 * @version 1.6b
 *
 **/

$dictionary = array(

'XIMI_APP_ABOUT' => 'About',
'XIMI_APP_HELP' => 'Help',
'XIMI_APP_CLOSE' => 'Close',
'XIMI_APP_IN_DEVELOPMENT' => 'The section is under development.',
'XIMI_APP_MODULE' => 'The integration of Wi-Fi devices from Xiaomi Mihome ecosystem by miIO-protocol.',
'XIMI_APP_PROJ' => 'The project on the',
'XIMI_APP_DOCS' => 'Documentation in the',
'XIMI_APP_INKB' => 'Knowledge Base',
'XIMI_APP_DISCUS' => 'Discussion of the module on the',
'XIMI_APP_DISCUS2' => 'forume',
'XIMI_APP_DONATE' => 'Support the development of the module:',
'XIMI_APP_DONATE2' => 'Internal account in ',
'XIMI_APP_Author' => 'Author',
'XIMI_APP_THANKS' => 'Thanks',
'XIMI_APP_NAME' => 'Xiaomi miIO',
'XIMI_APP_CYCLE_STATE' => 'Cycle status',
'XIMI_APP_CYCLE_START' => 'Cycle running',
'XIMI_APP_CYCLE_STOP' => 'Cycle stopped',
'XIMI_APP_IP' => 'MajorDoMo server IP ',
'XIMI_APP_IP_TOOLTIP' => 'It is necessary to specify for correct operation on a server with two or more network interfaces.',
'XIMI_APP_PERIOD' => 'Discovery timeout ',
'XIMI_APP_PERIOD_TOOLTIP' => 'The period (in seconds) of searching for devices on the network using a broadcast request. The mechanism is designed to search for new devices, determine the availability (online / offline) of current and update their IP-addresses.',
'XIMI_APP_DEBUG' => 'Debug ',
'XIMI_APP_DEBUG_TOOLTIP' => 'Writing the exchange of messages between the server and devices in a separate log file YYYY-mm-dd_xiaomimiio.log. The changes require that you restart the cycle.',
'XIMI_APP_DEBUG_TOOLTIP2' => 'Writing debug messages of the miIO-lib library to the log file of the log_YYYY-mm-dd-cycle_xiaomimiio.php.txt cycle. The changes require that you restart the cycle.',
'XIMI_APP_DEBUG_TOOLTIP3' => 'Write the debug messages of the cycle to the log file log_YYYY-mm-dd-cycle_xiaomimiio.php.txt. The changes require that you restart the cycle.',
'XIMI_APP_RADIO' => 'Radio',
'XIMI_APP_TOKEN' => 'Token',
'XIMI_APP_TEACH' => 'Start learning',
'XIMI_APP_TEACH1' => 'Learning IR code',
'XIMI_APP_TEACH2' => 'IR-code learning',
'XIMI_APP_TEACH_TEXT' => 'To read the IR code from the remote control, press the <b>Start</b> button, point the remote control towards <b>Mi IR Remote 360</b> and press the button whose code you want to know several times. Upon successful completion of the procedure, the code read will be displayed in the log.',
'XIMI_APP_START' => 'Start',
'XIMI_APP_TRAINING' => 'Learning mode activated',
'XIMI_APP_ERROR' => 'The problem with getting data from the device',
'XIMI_APP_TRAINING_END' => 'Learning sessions completed',
'XIMI_APP_SUCCESSFULLY' => 'IR-code is received successfully!',
'XIMI_APP_SNAP' => 'Add child device',
'XIMI_APP_ONLINE' => 'Device is available',
'XIMI_APP_OFFLINE' => 'Device not available',
'XIMI_APP_UNBIND' => 'Delete child device',
'XIMI_APP_LINKING' => 'Switch gateway to pairing mode',
'XIMI_APP_LINKING2' => 'Gateway in pairing mode',
'XIMI_APP_UNLINKING' => 'Do you really want to delete the child device ',
'XIMI_APP_UNLINKING2' => ' from the gateway?',
'XIMI_APP_DELETE' => 'Child device deleted',
'XIMI_APP_COMPLETE' => 'Pairing session completed',
'XIMI_APP_TESTING' => 'Testing API-commands',
'XIMI_APP_OPTIONS' => 'Parameters',
'XIMI_APP_GET' => 'Get information miIO.info',
'XIMI_APP_REQUIRED' => 'A device token is required',
'XIMI_APP_CURRENT' => 'Get current status',
'XIMI_APP_ZIGBEE_NOTICE' => 'This module allows you to only pairing, unpairing and view the list of zigbee-connected devices to the gateway. Full work with zigbee-devices is performed in the <b>Xiaomi Home</b> module. Install it from the MajorDoMo add-ons Market.',
'XIMI_APP_ATTENTION' => 'Attention',
'XIMI_APP_LAN_MODE' => 'Developer mode',
'XIMI_APP_ACTIVE' => 'Active',
'XIMI_APP_NOTACTIVE' => 'Not active',
'XIMI_APP_LAN_MODE_ON' => 'Developer mode successfully enabled',
'XIMI_APP_LAN_MODE_OFF' => 'Developer mode successfully disabled',
'XIMI_APP_LAN_MODE_ON_ASK' => 'Are you sure you want to enable developer mode on the gateway?',
'XIMI_APP_LAN_MODE_OFF_ASK' => 'Are you sure you want to disable the developer mode on the gateway?',
'XIMI_APP_ACTIVATE_LAN_MODE' => 'Activate developer mode',
'XIMI_APP_DEACTIVATE_LAN_MODE' => 'Deactivate developer mode',
'XIMI_APP_KEY' => 'Key',
'XIMI_APP_ON' => 'Enable',
'XIMI_APP_OFF' => 'Disable'
);

foreach ($dictionary as $k=>$v)
{
   if (!defined('LANG_' . $k))
   {
      define('LANG_' . $k, $v);
   }
}

?>
