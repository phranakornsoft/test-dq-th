<?php
	// include composer autoload
	require "vendor/autoload.php";
	require_once('vendor/linecorp/line-bot-sdk/line-bot-sdk-tiny/LINEBotTiny.php');
	// require "bot_settings.php";
	
	///////////// ส่วนของการเรียกใช้งาน class ผ่าน namespace
	use LINE\LINEBot;
	use LINE\LINEBot\HTTPClient;
	use LINE\LINEBot\HTTPClient\CurlHTTPClient;
	//use LINE\LINEBot\Event;
	//use LINE\LINEBot\Event\BaseEvent;
	//use LINE\LINEBot\Event\MessageEvent;
	use LINE\LINEBot\MessageBuilder;
	use LINE\LINEBot\MessageBuilder\TextMessageBuilder;
	use LINE\LINEBot\MessageBuilder\StickerMessageBuilder;
	use LINE\LINEBot\MessageBuilder\ImageMessageBuilder;
	use LINE\LINEBot\MessageBuilder\LocationMessageBuilder;
	use LINE\LINEBot\MessageBuilder\AudioMessageBuilder;
	use LINE\LINEBot\MessageBuilder\VideoMessageBuilder;
	use LINE\LINEBot\ImagemapActionBuilder;
	use LINE\LINEBot\ImagemapActionBuilder\AreaBuilder;
	use LINE\LINEBot\ImagemapActionBuilder\ImagemapMessageActionBuilder ;
	use LINE\LINEBot\ImagemapActionBuilder\ImagemapUriActionBuilder;
	use LINE\LINEBot\MessageBuilder\Imagemap\BaseSizeBuilder;
	use LINE\LINEBot\MessageBuilder\ImagemapMessageBuilder;
	use LINE\LINEBot\MessageBuilder\MultiMessageBuilder;
	use LINE\LINEBot\TemplateActionBuilder;
	use LINE\LINEBot\TemplateActionBuilder\DatetimePickerTemplateActionBuilder;
	use LINE\LINEBot\TemplateActionBuilder\MessageTemplateActionBuilder;
	use LINE\LINEBot\TemplateActionBuilder\PostbackTemplateActionBuilder;
	use LINE\LINEBot\TemplateActionBuilder\UriTemplateActionBuilder;
	use LINE\LINEBot\MessageBuilder\TemplateBuilder;
	use LINE\LINEBot\MessageBuilder\TemplateMessageBuilder;
	use LINE\LINEBot\MessageBuilder\TemplateBuilder\ButtonTemplateBuilder;
	use LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselTemplateBuilder;
	use LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselColumnTemplateBuilder;
	use LINE\LINEBot\MessageBuilder\TemplateBuilder\ConfirmTemplateBuilder;
	use LINE\LINEBot\MessageBuilder\TemplateBuilder\ImageCarouselTemplateBuilder;
	use LINE\LINEBot\MessageBuilder\TemplateBuilder\ImageCarouselColumnTemplateBuilder;

	$httpClient = new CurlHTTPClient('ggO5i0vjS5wZGH9Lk5DuXy23fVC3M6jIfo12fasF0O7zzPMeKv4mwyen+y8wK4SH76+eRXK3rLJFFQLUevXr0fPFq+h3qAE6b6tnZmt/dxwsK6iH7N7WKQsq5C2Xd3pwmqAAliqiWrBF5fh7wMZuDwdB04t89/1O/w1cDnyilFU=');
	$bot = new LINEBot($httpClient, array('channelSecret' => '9bcd4924ed3df67281e6ba22b9a7a5c7'));

	 
	// คำสั่งรอรับการส่งค่ามาของ LINE Messaging API
	// $content = file_get_contents('php://input');
	//  
	// // แปลงข้อความรูปแบบ JSON  ให้อยู่ในโครงสร้างตัวแปร array
	// $events = json_decode($content, true);
	// if(!is_null($events)){
	// }

	// $response = $bot->replyMessage($replyToken,$replyData);
	// if ($response->isSucceeded()) {
	//     echo 'Succeeded!';
	//     return;
	// }
	 
	// Failed
	// echo $response->getHTTPStatus() . ' ' . $response->getRawBody();


	echo "OK";

?>