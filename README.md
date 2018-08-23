# Xiaomi miIO

Модуль предназначен для интеграции **MajorDoMo** с Wi-Fi устройствами из экосистемы **Xiaomi Mihome**, взаимодействующих по протоколу **miIO**.

**miIO** - проприетарный сетевой протокол Xiaomi с шифрованием, по которому взаимодействуют wifi-устройства из экосистемы Xiaomi и приложение Mihome на смартфоне. В качестве транспорта используется UDP и порт 54321. Содержимое пакетов шифруется. Ключи шифрования формируются на основе уникальных токенов. Для контроля корректности принимаемых пакетов используется контрольная сумма на основе алгоритма MD5.

Использование этого протокола позволяет управлять теми устройствами, которые не имеют открытого API (режима разработчика). Например, пылесосы, лампы, светильники, увлажнители и очистители воздуха, розетки и многие другие. Также позволяет расширить имеющиеся возможности открытого API у xiaomi-шлюза, в частности переводить его в режим сопряжения, привязывать и отвязывать zigbee-устройства, управлять радио и др.

В основе модуля лежит библиотека **[php-miio](https://github.com/skysilver-lab/php-miio)**.

Обсуждение модуля на **[Форуме](https://majordomo.smartliving.ru/forum/viewtopic.php?f=5&t=4863)**.

Модуль в **[Connect](https://connect.smartliving.ru/tasks/51.html)**.

![miio](https://kb.smartliving.ru/wp-content/uploads/2018/07/module_miio.gif)

### Поддерживаемые устройства
> По состоянию на июль 2018 года.

1. Шлюз ZigBee ***Mi Smart Home Gateway 2***
2. Шлюз ZigBee ***Aqara AC Companion Gateway***
3. Розетка ***Mi Smart Socket Plug 2***
4. Розетка ***Mi Smart Socket Plug with USB***
5. Розетка ***Mi Smart Socket Plug with 2 USB***
6. Пылесос ***Mi Vacuum Cleaner***
7. Пылесос ***Mi Roborock S50/S51***
8. Настольная лампа ***Philips EyeCare Smart Desk Lamp 2***
9. Лампочка белая Е27 ***Philips Light Bulb***
10. Лампочка белая Е27 ***Yeelight White Bulb***
11. Лампочка цветная Е27 ***Yeelight Color Bulb***
12. Лампочки ***Philips Rui Chi Candle Light Bulb
13. Настольная лампа ***Mi LED Desk Lamp***
14. Потолочный светильник ***Yeelight Ceiling Light***
15. Потолочный светильник ***Philips EyeCare Smart Ceiling Lamp***
16. Светодиодная лента ***Yeelight LED Lightstrip***
17. Удлинитель (6 розеток) ***Mi Smart Power Strip 6 Plugs***
18. Увлажнитель воздуха ***Mi Air Humidifier***
19. Увлажнитель воздуха ***Mi Air Humidifier 2***
20. Очиститель воздуха ***Mi Air Purifier 2S***
21. IR-контроллер ***Mi IR Remote 360***
22. WiFi-колонка ***Mi Internet Speaker***
23. Ночник ***Yeelight Bedside Lamp***
24. Светильник (спот) ***Philips Zhirui Downlight***

![devices](https://connect.smartliving.ru/cms/data_images/152_image.png)
### Документация по модулю
* [Общие сведения](https://kb.smartliving.ru/xiaomimiio_help/)
* [Установка, обновление, удаление модуля](https://kb.smartliving.ru/xiaomimiio-ustanovka-obnovlenie/)
* [Интерфейс модуля](https://kb.smartliving.ru/xiaomimiio-gui/)
* [Настройка модуля](https://kb.smartliving.ru/xiaomimiio-settings/)
* [Протокол miIO](https://kb.smartliving.ru/xiaomimiio-protocol/)
* [Токены устройств](https://kb.smartliving.ru/xiaomimiio-tokens/)
