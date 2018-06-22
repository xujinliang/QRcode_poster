<?php
require_once('./phpqrcode.php');
require_once('./promotion.php');
$code_url = 'http://www.sanguosha.com';
$file = './cache/'.time().'.png';
if(!file_exists($file)){
	$url = urldecode($code_url);
	QRcode::png($url, $file, 'H',5,2);
}
$data = array();
$data['bigImgPath'] = "./timg.jpg";
$data['qCodePath'] = $file;
$data['filename'] = time().".jpg";
$data['left'] = "100";
$data['top'] = "500";
$data['percent'] = "2";
createPromotion($data);
@unlink($file);
?>