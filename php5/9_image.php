<?php

$path = './2.png';
$path1 = './14.jpg';
//= GD图形处理
$img = imagecreatetruecolor(100, 100); #创建画布
#分配颜色
$bg1 = imagecolorallocate($img, 128, 128, 128);
$bg2 = imagecolorallocate($img, 128, 64, 192);
$bg3 = imagecolorallocate($img, 192, 64, 128);

//#填充背景
//imagefilledrectangle($img, 0, 0, 100, 100, $bg2); #画一矩形并填充
//imagefilledellipse($image, $cx, $cy, $width, $height, $color);#画一椭圆并填充
//imagerectangle($img, 10, 50, 50, 10, $bg2); #画一个矩形，不填充
//imagettftext($img, 12, 10, 50, 50, $bg3, 'arial.ttf', 'abc'); #填写文字
//imagealphablending($img, true);#是否是真彩色
//imageantialias($img, true); #是否使用抗锯齿（antialias）功能
//imageline($img, 10, 20, 30, 50, $bg1); #画线
imagecreatefrompng($path);
$exif_arr = exif_read_data($path1); #获取相机拍摄的信息
var_dump($exif_arr);
die;
header('Content-type: image/jpeg');
imagejpeg($img);