<?php // callback.php

require "vendor/autoload.php";
require_once('vendor/linecorp/line-bot-sdk/line-bot-sdk-tiny/LINEBotTiny.php');

$access_token = 'ggO5i0vjS5wZGH9Lk5DuXy23fVC3M6jIfo12fasF0O7zzPMeKv4mwyen+y8wK4SH76+eRXK3rLJFFQLUevXr0fPFq+h3qAE6b6tnZmt/dxwsK6iH7N7WKQsq5C2Xd3pwmqAAliqiWrBF5fh7wMZuDwdB04t89/1O/w1cDnyilFU=';

$content = file_get_contents('php://input');
$arrayJson = json_decode($content, true);

$arrayHeader = array();
$arrayHeader[] = "Content-Type: application/json";
$arrayHeader[] = "Authorization: Bearer {$access_token}";

//รับข้อความจากผู้ใช้
$message = $arrayJson['events'][0]['message']['text'];
#ตัวอย่าง Message Type "Text"
if($message == "สวัสดี"){
    $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
    $arrayPostData['messages'][0]['type'] = "text";
    $arrayPostData['messages'][0]['text'] = "สวัสดีจ้าาา";
    replyMsg($arrayHeader,$arrayPostData);
}
#ตัวอย่าง Message Type "Sticker"
else if($message == "ฝันดี"){
    $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
    $arrayPostData['messages'][0]['type'] = "sticker";
    $arrayPostData['messages'][0]['packageId'] = "2";
    $arrayPostData['messages'][0]['stickerId'] = "46";
    replyMsg($arrayHeader,$arrayPostData);
}
#ตัวอย่าง Message Type "Image"
else if($message == "รูปน้องแมว"){
    $image_url = "https://i.pinimg.com/originals/cc/22/d1/cc22d10d9096e70fe3dbe3be2630182b.jpg";
    $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
    $arrayPostData['messages'][0]['type'] = "image";
    $arrayPostData['messages'][0]['originalContentUrl'] = $image_url;
    $arrayPostData['messages'][0]['previewImageUrl'] = $image_url;
    replyMsg($arrayHeader,$arrayPostData);
}
#ตัวอย่าง Message Type "Location"
else if($message == "พิกัดสยามพารากอน"){
    $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
    $arrayPostData['messages'][0]['type'] = "location";
    $arrayPostData['messages'][0]['title'] = "สยามพารากอน";
    $arrayPostData['messages'][0]['address'] =   "13.7465354,100.532752";
    $arrayPostData['messages'][0]['latitude'] = "13.7465354";
    $arrayPostData['messages'][0]['longitude'] = "100.532752";
    replyMsg($arrayHeader,$arrayPostData);
}
#ตัวอย่าง Message Type "Text + Sticker ใน 1 ครั้ง"
else if($message == "ลาก่อน"){
    $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
    $arrayPostData['messages'][0]['type'] = "text";
    $arrayPostData['messages'][0]['text'] = "อย่าทิ้งกันไป";
    $arrayPostData['messages'][1]['type'] = "sticker";
    $arrayPostData['messages'][1]['packageId'] = "1";
    $arrayPostData['messages'][1]['stickerId'] = "131";
    replyMsg($arrayHeader,$arrayPostData);
}
#Test Card
else if($message == "เมนูแนะนำ"){
    $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
    $arrayPostData['messages'][0]['type'] = "carousel";
    $arrayPostData['messages'][0]['thumbnailImageUrl'] = "https://res.cloudinary.com/ginja-co-ltd/image/upload/s--bOVLNxnY--/c_fill,h_300,q_jpegmini,w_485/v1/brands/6/inventory/products/18592-coconut-with-sticky-rice-blizz-p7inqy";
    $arrayPostData['messages'][0]['title'] = "บลิซซาร์ด® มะพร้าวน้ำหอมกับเนื้อมะพร้าวคั่ว x2";
    $arrayPostData['messages'][0]['text'] = "บลิซซาร์ด® มะพร้าวน้ำหอมกับเนื้อมะพร้าวคั่ว ขนาด XL 2 แก้ว และน้ำแข็งแห้ง";
    replyMsg($arrayHeader,$arrayPostData);
}

function replyMsg($arrayHeader,$arrayPostData){
	$strUrl = "https://api.line.me/v2/bot/message/reply";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$strUrl);
	curl_setopt($ch, CURLOPT_HEADER, false);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $arrayHeader);
	curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($arrayPostData));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	$result = curl_exec($ch);
	curl_close ($ch);
}
exit;

echo 'OK';