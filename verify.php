<?php
$access_token = 'DnSrl9Jx9teqxIr1AgarhmcdvORQuWAOtV7aw7GXXbYMm0ED6D2rTcB9bL066Lb976+eRXK3rLJFFQLUevXr0fPFq+h3qAE6b6tnZmt/dxxFYkbtmskgha/SZbQiCgkgUXvt/KW1v9TSFoJFZhi+7AdB04t89/1O/w1cDnyilFU=';


$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;