<?php
$im = imagecreatetruecolor(32,32);
$textcolor = imagecolorallocate($im,255,255,255);
imagestring($im,5,11,7,$_GET['num'],$textcolor);

if ($_GET['num'] == 'x') {
    $im = imagerotate($im, 45,0);
}

imagejpeg($im);
imagedestroy($im);
?>