<?php
/**
 * Ukraine language file for Xiaomi miIO  module
 *
 * @package Xiaomi miIO 
 * @author <skysilver.da@gmail.com>
 * @copyright 2017-2018 Agaphonov Dmitri aka skysilver <skysilver.da@gmail.com> (c)
 * @localization Alex Sokolov aka Gelezako <admin@gelezako.com> http://blog.gelezako.com
 * @version 1.1.5b
 *
 **/

$dictionary = array(

'XIMI_SCRIPT_NAME'=>'Назва сценарію',
'XIMI_APP_ABOUT' => 'Про модуль',
'XIMI_APP_CLOSE' => 'Закрити',
'XIMI_APP_MODULE' => 'Модуль підтримки Wi-Fi пристроїв з екосистеми Xiaomi Mihome, взаємодіючих по протоколу miIO.',
'XIMI_APP_PROJ' => 'Проект у',
'XIMI_APP_DISCUS' => 'Обговорення модуля на ',
'XIMI_APP_DISCUS2' => 'форумі',
'XIMI_APP_DONATE' => 'Підтримати розробку і розвиток модуля:',
'XIMI_APP_DONATE2' => 'Внутрішній рахунок у',
'XIMI_APP_Author' => 'Автор',
'XIMI_APP_THANKS' => 'Подяки',
'XIMI_APP_NAME' => 'Xiaomi miIO',
'XIMI_APP_CYCLE_START' => 'Цикл увімкнено',
'XIMI_APP_CYCLE_STOP' => 'Ццикл зупинений',
'XIMI_APP_IP' => 'IP сервера MajorDoMo ',
'XIMI_APP_IP_TOOLTIP' => 'Необхідно вказати для коректної роботи на сервері з двома і більше мережевими інтерфейсами.',
'XIMI_APP_PERIOD' => 'Період автопошуку ',
'XIMI_APP_PERIOD_TOOLTIP' => 'Період (в секундах) пошуку пристроїв в мережі за допомогою широкомовного запиту. Механізм призначений для пошуку нових пристроїв, визначення доступності (онлайн / оффлайн) поточних і поновлення їх IP-адрес.',
'XIMI_APP_DEBUG' => 'Відлагодження ',
'XIMI_APP_DEBUG_TOOLTIP' => 'Запис обміну повідомленнями між сервером і пристроями в окремий лог-файл YYYY-mm-dd_xiaomimiio.log. Для вступу змін в силу потрібно перезапустити цикл.',
'XIMI_APP_DEBUG_TOOLTIP2' => 'Запис відлагодженних повідомлень бібліотеки miIO-Lib в лог-файл циклу log_YYYY-mm-dd-cycle_xiaomimiio.php.txt. Для вступу змін у силу потрібно перезапустити цикл.',
'XIMI_APP_DEBUG_TOOLTIP3' => 'Запис відлагодженних повідомлень циклу у лог-файл log_YYYY-mm-dd-cycle_xiaomimiio.php.txt. Для вступу змін у силу потрібно перезапустити цикл.',
'XIMI_APP_RADIO' => 'Радіо',
'XIMI_APP_TOKEN' => 'Токен',
'XIMI_APP_TEACH' => 'Навчити коду',
'XIMI_APP_TEACH2' => 'Навчання IR-командам',
'XIMI_APP_TEACH_TEXT' => 'Щоб отримати IR-код з пульта дистанційного керування, натисніть кнопку "Старт", направте пульт в сторону Mi IR Remote 360 і натисніть кілька разів кнопку, код якої потрібно дізнатися. При успішному завершенні процедури отриманий код відобразиться на сторінці.',
'XIMI_APP_START' => 'Старт',
'XIMI_APP_TRAINING' => 'Режим навчання активований',
'XIMI_APP_ERROR' => 'Проблема з отриманням даних від пристрою',
'XIMI_APP_TRAINING_END' => 'Сеанс навчання завершено',
'XIMI_APP_SUCCESSFULLY' => 'IR-код отримано успішно!',
'XIMI_APP_SNAP' => "Прив'язати",
'XIMI_APP_ONLINE' => 'Пристрій в мережі',
'XIMI_APP_OFFLINE' => 'Пристрій не доступний',
'XIMI_APP_UNBIND' => "Відв'язати пристрій від шлюзу",
'XIMI_APP_LINKING' => 'Перемикання шлюзу у режим сполучення',
'XIMI_APP_LINKING2' => 'Шлюз в режимі сполучення',
'XIMI_APP_UNLINKING' => "Ви дійсно хочете відв'язати пристрій ",
'XIMI_APP_UNLINKING2' => ' від шлюза?',
'XIMI_APP_DELETE' => 'Пристрій видалено',
'XIMI_APP_COMPLETE' => 'Сеанс сполучення завершено',
'XIMI_APP_TESTING' => 'Тестування API-команд',
'XIMI_APP_OPTIONS' => 'Параметри',
'XIMI_APP_GET' => 'Отримати відомості miIO.info',
'XIMI_APP_REQUIRED' => 'Потрібен токен пристрою',
'XIMI_APP_CURRENT' => 'Отримати актуальний стан',

);

foreach ($dictionary as $k=>$v)
{
   if (!defined('LANG_' . $k))
   {
      define('LANG_' . $k, $v);
   }
}

?>
