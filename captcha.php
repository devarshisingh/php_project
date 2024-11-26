<?php
session_start();
$image = imagecreatetruecolor(200, 50);
$background = imagecolorallocate($image, 255, 255, 255);
$textColor = imagecolorallocate($image, 0, 0, 0);
$lineColor = imagecolorallocate($image, 64, 64, 64);
imagefilledrectangle($image, 0, 0, 200, 50, $background);
$captchaCode = substr(md5(rand()), 0, 6);
$_SESSION['captcha'] = $captchaCode;
for ($i = 0; $i < 5; $i++) {
    imageline($image, rand() % 200, rand() % 50, rand() % 200, rand() % 50, $lineColor);
}
imagestring($image, 5, 50, 15, $captchaCode, $textColor);
header('Content-Type: image/png');
imagepng($image);
imagedestroy($image);
?>
