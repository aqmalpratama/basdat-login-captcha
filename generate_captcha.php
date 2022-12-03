<?php
session_start();
$captcha = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);
$_SESSION['captcha'] = $captcha;

$pic = imagecreate(80, 30);
$box_color = imagecolorallocate($pic, 162, 155, 254);
$text_color = imagecolorallocate($pic, 255, 255, 255);
imagefilledrectangle($pic, 0, 0, 50, 20, $box_color);
imagestring($pic, 10, 5, 5, $captcha, $text_color);
imagejpeg($pic);
