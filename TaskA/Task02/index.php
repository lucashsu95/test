<?php
$path = 'plane.jpg';
$img = imagecreatefromjpeg($path);
$w = imagesx($img);
$h = imagesy($img);
for ($i = 0; $i < 20000; $i++) {
    $x = rand(0, $w);
    $y = rand(0, $h);
    $color = imagecolorallocate($img, rand(0, 255), rand(0, 255), rand(0, 255));
    imagesetpixel($img, $x, $y, $color);
}
imagejpeg($img,'result.jpg');
