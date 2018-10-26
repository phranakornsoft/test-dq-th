<?php

require_once 'vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;

$logger = new Logger('LineBot');
$logger->pushHandler(new StreamHandler('php://stderr', Logger::DEBUG));

$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($_ENV["ggO5i0vjS5wZGH9Lk5DuXy23fVC3M6jIfo12fasF0O7zzPMeKv4mwyen+y8wK4SH76+eRXK3rLJFFQLUevXr0fPFq+h3qAE6b6tnZmt/dxwsK6iH7N7WKQsq5C2Xd3pwmqAAliqiWrBF5fh7wMZuDwdB04t89/1O/w1cDnyilFU="]);
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $_ENV["9bcd4924ed3df67281e6ba22b9a7a5c7"]]);

$signature = $_SERVER['HTTP_' . \LINE\LINEBot\Constant\HTTPHeader::LINE_SIGNATURE];
try {
	$events = $bot->parseEventRequest(file_get_contents('php://input'), $signature);
} catch(\LINE\LINEBot\Exception\InvalidSignatureException $e) {
	error_log('parseEventRequest failed. InvalidSignatureException => '.var_export($e, true));
} catch(\LINE\LINEBot\Exception\UnknownEventTypeException $e) {
	error_log('parseEventRequest failed. UnknownEventTypeException => '.var_export($e, true));
} catch(\LINE\LINEBot\Exception\UnknownMessageTypeException $e) {
	error_log('parseEventRequest failed. UnknownMessageTypeException => '.var_export($e, true));
} catch(\LINE\LINEBot\Exception\InvalidEventRequestException $e) {
	error_log('parseEventRequest failed. InvalidEventRequestException => '.var_export($e, true));
}

foreach ($events as $event) {

	// Postback Event
	if (($event instanceof \LINE\LINEBot\Event\PostbackEvent)) {
		$logger->info('Postback message has come');
		continue;
	}
	// Location Event
	if  ($event instanceof LINE\LINEBot\Event\MessageEvent\LocationMessage) {
		$logger->info("location -> ".$event->getLatitude().",".$event->getLongitude());
		continue;
	}

	// Message Event = TextMessage
	if (($event instanceof \LINE\LINEBot\Event\MessageEvent\TextMessage)) {
		$messageText=strtolower(trim($event->getText()));
		switch ($messageText) {
		case "text" : 
			$outputText = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder("text message");
			break;
		case "location" :
			$outputText = new \LINE\LINEBot\MessageBuilder\LocationMessageBuilder("Eiffel Tower", "Champ de Mars, 5 Avenue Anatole France, 75007 Paris, France", 48.858328, 2.294750);
			break;
		case "button" :
			$actions = array (
				// general message action
				New \LINE\LINEBot\TemplateActionBuilder\MessageTemplateActionBuilder("button 1", "text 1"),
				// URL type action
				New \LINE\LINEBot\TemplateActionBuilder\UriTemplateActionBuilder("Google", "http://www.google.com"),
				// The following two are interactive actions
				New \LINE\LINEBot\TemplateActionBuilder\PostbackTemplateActionBuilder("next page", "page=3"),
				New \LINE\LINEBot\TemplateActionBuilder\PostbackTemplateActionBuilder("Previous", "page=1")
			);
			$img_url = "https://cdn.shopify.com/s/files/1/0379/7669/products/sampleset2_1024x1024.JPG?v=1458740363";
			$button = new \LINE\LINEBot\MessageBuilder\TemplateBuilder\ButtonTemplateBuilder("button text", "description", $img_url, $actions);
			$outputText = new \LINE\LINEBot\MessageBuilder\TemplateMessageBuilder("this message to use the phone to look to the Oh", $button);
			break;
		case "carousel" :
			$columns = array();
			$img_url = "https://cdn.shopify.com/s/files/1/0379/7669/products/sampleset2_1024x1024.JPG?v=1458740363";
			for($i=0;$i<5;$i++) {
				$actions = array(
					new \LINE\LINEBot\TemplateActionBuilder\PostbackTemplateActionBuilder("Add to Card","action=carousel&button=".$i),
					new \LINE\LINEBot\TemplateActionBuilder\UriTemplateActionBuilder("View","http://www.google.com")
				);
				$column = new \LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselColumnTemplateBuilder("Title", "description", $img_url , $actions);
				$columns[] = $column;
			}
			$carousel = new \LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselTemplateBuilder($columns);
			$outputText = new \LINE\LINEBot\MessageBuilder\TemplateMessageBuilder("Carousel Demo", $carousel);
			break;	
		case "image" :
			$img_url = "https://cdn.shopify.com/s/files/1/0379/7669/products/sampleset2_1024x1024.JPG?v=1458740363";
			$outputText = new LINE\LINEBot\MessageBuilder\ImageMessageBuilder($img_url, $img_url);
			break;	
		case "confirm" :
			$actions = array (
				New \LINE\LINEBot\TemplateActionBuilder\PostbackTemplateActionBuilder("yes", "ans=y"),
				New \LINE\LINEBot\TemplateActionBuilder\PostbackTemplateActionBuilder("no", "ans=N")
			);
			$button = new \LINE\LINEBot\MessageBuilder\TemplateBuilder\ConfirmTemplateBuilder("problem", $actions);
			$outputText = new \LINE\LINEBot\MessageBuilder\TemplateMessageBuilder("this message to use the phone to look to the Oh", $button);
			break;
		default :
			$outputText = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder("demo command: text, location, button, confirm to test message template");	
			break;
		}
		$response = $bot->replyMessage($event->getReplyToken(), $outputText);
	}

}  

echo "OK";