<?php

// Отображаем содержимое данного файла как картинку PNG
header('Content-Type: image/png');

// Подключаем сессию
session_start();

// Получаем секретный ключ

$secret = $_SESSION['captch'];

// Создаем полотно

$captch = imageCreateTrueColor(100, 40);

// Настройки каптчи
$quality = 5; // можно указать значение в промежутке от 0 до 9, 0 - максимальное качество
$lines = 5; // количество линий
$pixel = 50; // количество точек на изображении

// Инструменты
$width = imagesx($captch);
$height = imagesy($captch);
$fill = imageColorAllocate($captch, 30, 40, 45);
$tcolor = imageColorAllocate($captch, 255, 255, 255);
$fcolor = imageColorAllocate($captch, 125, 125, 125);

// Заливка фона
imageFill($captch, 0, 0, $fill);

imagettftext($captch, 20, rand(0,10), 18, $height - 15,  $tcolor, "20325.otf",$secret );//otf та кышкентай шрифт жок сол себепты ол кышкентац арып корсетпейды

for($l=0; $l <= $lines; $l++){
	imageLine($captch, rand(0, $width), rand(0, $height), rand(0, $width), rand(0, $height), $fcolor);
}
for($p=0; $p <= $pixel; $p++){
	imagesetpixel($captch,  rand(0, $width), rand(0, $height), $fcolor);
}
// Отображение изображения
imagePng($captch, NULL, $quality);



?>