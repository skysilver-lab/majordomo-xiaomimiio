<?php
/**
 * Russian language file for Xiaomi miIO module
 *
 * @package Xiaomi miIO 
 * @author <skysilver.da@gmail.com>
 * @copyright 2017-2018 Agaphonov Dmitri aka skysilver <skysilver.da@gmail.com> (c)
 * @localization Alex Sokolov aka Gelezako <admin@gelezako.com> http://blog.gelezako.com
 * @version 1.6b
 *
 **/

$dictionary = array(

'XIMI_APP_ABOUT' => 'О модуле',
'XIMI_APP_HELP' => 'Справка',
'XIMI_APP_CLOSE' => 'Закрыть',
'XIMI_APP_IN_DEVELOPMENT' => 'Раздел находится в разработке.',
'XIMI_APP_MODULE' => 'Модуль поддержки Wi-Fi устройств из экосистемы Xiaomi Mihome, взаимодействующих по протоколу miIO.',
'XIMI_APP_PROJ' => 'Проект в',
'XIMI_APP_DOCS' => 'Документация в',
'XIMI_APP_INKB' => 'Базе знаний',
'XIMI_APP_DISCUS' => 'Обсуждение модуля на',
'XIMI_APP_DISCUS2' => 'форуме',
'XIMI_APP_DONATE' => 'Поддержать разработку и развитие модуля:',
'XIMI_APP_DONATE2' => 'Внутренний счет в ',
'XIMI_APP_Author' => 'Автор',
'XIMI_APP_THANKS' => 'Благодарности',
'XIMI_APP_NAME' => 'Xiaomi miIO',
'XIMI_APP_CYCLE_STATE' => 'Статус цикла',
'XIMI_APP_CYCLE_START' => 'Цикл запущен',
'XIMI_APP_CYCLE_STOP' => 'Цикл остановлен',
'XIMI_APP_IP' => 'IP сервера MajorDoMo ',
'XIMI_APP_IP_TOOLTIP' => 'Необходимо указать для корректной работы на сервере с двумя и более сетевыми интерфейсами.',
'XIMI_APP_PERIOD' => 'Период автопоиска ',
'XIMI_APP_PERIOD_TOOLTIP' => 'Период (в секундах) поиска устройств в сети с помощью широковещательного запроса. Механизм предназначен для поиска новых устройств, определения доступности (онлайн/оффлайн) текущих и обновления их IP-адресов.',
'XIMI_APP_DEBUG' => 'Отладка ',
'XIMI_APP_DEBUG_TOOLTIP' => 'Запись обмена сообщениями между сервером и устройствами в отдельный лог-файл YYYY-mm-dd_xiaomimiio.log. Для вступления изменений в силу требуется перезапустить цикл.',
'XIMI_APP_DEBUG_TOOLTIP2' => 'Запись отладочных сообщений библиотеки miIO-Lib в лог-файл цикла log_YYYY-mm-dd-cycle_xiaomimiio.php.txt. Для вступления изменений в силу требуется перезапустить цикл.',
'XIMI_APP_DEBUG_TOOLTIP3' => 'Запись отладочных сообщений цикла в лог-файл log_YYYY-mm-dd-cycle_xiaomimiio.php.txt. Для вступления изменений в силу требуется перезапустить цикл.',
'XIMI_APP_RADIO' => 'Радио',
'XIMI_APP_TOKEN' => 'Токен',
'XIMI_APP_TEACH' => 'Обучить',
'XIMI_APP_TEACH1' => 'Обучить IR-коду',
'XIMI_APP_TEACH2' => 'Обучение IR-командам',
'XIMI_APP_TEACH_TEXT' => 'Чтобы считать IR-код с пульта дистанционного управления, нажмите кнопку <b>Старт</b>, направьте пульт в сторону <b>Mi IR Remote 360</b> и нажмите несколько раз кнопку, код которой требуется узнать. При успешном завершении процедуры прочитанный код отобразится в логе.',
'XIMI_APP_TEACH_TEXT_AQARA' => 'Чтобы считать IR-код с пульта дистанционного управления, нажмите кнопку <b>Старт</b>, направьте пульт в сторону <b>Aqara AC Companion</b> и нажмите несколько раз кнопку, код которой требуется узнать. При успешном завершении процедуры прочитанный код отобразится в логе.',
'XIMI_APP_START' => 'Старт',
'XIMI_APP_TRAINING' => 'Режим обучения активирован',
'XIMI_APP_ERROR' => 'Проблема с получением данных от устройства',
'XIMI_APP_TRAINING_END' => 'Сеанс обучения завершен',
'XIMI_APP_SUCCESSFULLY' => 'IR-код получен успешно!',
'XIMI_APP_SNAP' => 'Привязать',
'XIMI_APP_ONLINE' => 'Устройство в сети',
'XIMI_APP_OFFLINE' => 'Устройство не доступно',
'XIMI_APP_UNBIND' => 'Отвязать устройство от шлюза',
'XIMI_APP_LINKING' => 'Перевод шлюза в режим сопряжения',
'XIMI_APP_LINKING2' => 'Шлюз в режиме сопряжения',
'XIMI_APP_UNLINKING' => 'Вы действительно хотите отвязать устройство ',
'XIMI_APP_UNLINKING2' => ' от шлюза?',
'XIMI_APP_DELETE' => 'Устройство удалено',
'XIMI_APP_COMPLETE' => 'Сеанс сопряжения завершен',
'XIMI_APP_TESTING' => 'Тестирование API-команд',
'XIMI_APP_OPTIONS' => 'Параметры',
'XIMI_APP_GET' => 'Получить сведения miIO.info',
'XIMI_APP_REQUIRED' => 'Требуется токен устройства',
'XIMI_APP_CURRENT' => 'Получить актуальное состояние',
'XIMI_APP_ZIGBEE_NOTICE' => 'Данный модуль позволяет только привязать, отвязать и просмотреть список привязанных к шлюзу zigbee-устройств. Работа с zigbee-устройствами в полном объеме осуществляется в модуле <b>Xiaomi Home</b>. Установите его из маркета дополнений MajorDoMo.',
'XIMI_APP_ATTENTION' => 'Внимание',
'XIMI_APP_LAN_MODE' => 'Режим разработчика',
'XIMI_APP_ACTIVE' => 'Активен',
'XIMI_APP_NOTACTIVE' => 'Не активен',
'XIMI_APP_LAN_MODE_ON' => 'Режим разработчика успешно включен',
'XIMI_APP_LAN_MODE_OFF' => 'Режим разработчика успешно выключен',
'XIMI_APP_LAN_MODE_ON_ASK' => 'Вы действительно хотите включить режим разработчика на шлюзе?',
'XIMI_APP_LAN_MODE_OFF_ASK' => 'Вы действительно хотите выключить режим разработчика на шлюзе?',
'XIMI_APP_ACTIVATE_LAN_MODE' => 'Активировать режим разработчика',
'XIMI_APP_DEACTIVATE_LAN_MODE' => 'Деактивировать режим разработчика',
'XIMI_APP_KEY' => 'Ключ',
'XIMI_APP_ON' => 'Включить',
'XIMI_APP_OFF' => 'Выключить'
);

foreach ($dictionary as $k=>$v)
{
   if (!defined('LANG_' . $k))
   {
      define('LANG_' . $k, $v);
   }
}

?>
