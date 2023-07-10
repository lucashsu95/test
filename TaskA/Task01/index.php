<?php
$path = 'images';
$path2 = 'image-modified';
if(!is_dir($path)){
    mkdir($path);
}
if(!is_dir($path2)){
    mkdir($path2);
}

$imgs = scandir($path);
foreach($imgs as $img){
    if($img !== '.' && $img !== '..'){
        $image = imagecreatefromstring(file_get_contents("$path/$img"));
        imagefilter($image,IMG_FILTER_GRAYSCALE);
        $image = imagescale($image,320);
        imagejpeg($image,"$path2/$img");
    }
}
