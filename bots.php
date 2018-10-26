<?php
require "vendor/autoload.php";
require_once('vendor/linecorp/line-bot-sdk/line-bot-sdk-tiny/LINEBotTiny.php');


$logger = new Logger('LineBot');
$logger->pushHandler(new StreamHandler('php://stderr', Logger::DEBUG));

$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($_ENV["ggO5i0vjS5wZGH9Lk5DuXy23fVC3M6jIfo12fasF0O7zzPMeKv4mwyen+y8wK4SH76+eRXK3rLJFFQLUevXr0fPFq+h3qAE6b6tnZmt/dxwsK6iH7N7WKQsq5C2Xd3pwmqAAliqiWrBF5fh7wMZuDwdB04t89/1O/w1cDnyilFU="]);
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $_ENV["9bcd4924ed3df67281e6ba22b9a7a5c7"]]);

// $signature = $_SERVER['HTTP_' . \LINE\LINEBot\Constant\HTTPHeader::LINE_SIGNATURE];
// try {
// 	$events = $bot->parseEventRequest(file_get_contents('php://input'), $signature);
// } catch(\LINE\LINEBot\Exception\InvalidSignatureException $e) {
// 	error_log('parseEventRequest failed. InvalidSignatureException => '.var_export($e, true));
// } catch(\LINE\LINEBot\Exception\UnknownEventTypeException $e) {
// 	error_log('parseEventRequest failed. UnknownEventTypeException => '.var_export($e, true));
// } catch(\LINE\LINEBot\Exception\UnknownMessageTypeException $e) {
// 	error_log('parseEventRequest failed. UnknownMessageTypeException => '.var_export($e, true));
// } catch(\LINE\LINEBot\Exception\InvalidEventRequestException $e) {
// 	error_log('parseEventRequest failed. InvalidEventRequestException => '.var_export($e, true));
// }



echo "OK";