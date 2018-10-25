<?php

require "vendor/autoload.php";

$access_token = 'DnSrl9Jx9teqxIr1AgarhmcdvORQuWAOtV7aw7GXXbYMm0ED6D2rTcB9bL066Lb976+eRXK3rLJFFQLUevXr0fPFq+h3qAE6b6tnZmt/dxxFYkbtmskgha/SZbQiCgkgUXvt/KW1v9TSFoJFZhi+7AdB04t89/1O/w1cDnyilFU=';

$channelSecret = '7e1c3a3c9f8a3b50461ad20aadf0eaa1';

$pushID = 'U1535d7220a474dc556b89e4a7d4708e3';

$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($access_token);
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $channelSecret]);

$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('hello world');
$response = $bot->pushMessage($pushID, $textMessageBuilder);

echo $response->getHTTPStatus() . ' ' . $response->getRawBody();