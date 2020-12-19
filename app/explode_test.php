<?php

$contentToParse = "Местоположение: Стамбул, Турция.
Дата отправления: 02.06.2020.
Откуда: Киев.
Дата прибытия:09.06.2020.
Откуда: Анкара.
Проезд: включен.
Номер: люкс-комната с балконом.
Питание: все включено.
Туристы: 2 взрослых.
Стоимость поездки: 20 000 гривен.
[[ images | https://i.ibb.co/sCNR19D/Rectangle-1-12.png ]]
[[ images | https://i.ibb.co/VB6Djfb/Rectangle-1-13.png ]]
[[ images | https://i.ibb.co/ZhVpw6H/Rectangle-1-14.png ]]
[[ images | https://i.ibb.co/HTpk7J7/Rectangle-1-15.png ]]
[[ images | https://i.ibb.co/1MbGqBM/Rectangle-1-16.png ]]
[[ images | https://i.ibb.co/L1jSNtd/Rectangle-1-17.png ]]";
$array = explode('[[', $contentToParse);
print_r($array);
