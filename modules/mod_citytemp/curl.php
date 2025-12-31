<?php
defined('_JEXEC') or die;


class ModCityTempCurl
{
public static function get($url)
{
$ch = curl_init();


curl_setopt_array($ch, [
CURLOPT_URL => $url,
CURLOPT_RETURNTRANSFER => true,
CURLOPT_TIMEOUT => 10,
CURLOPT_SSL_VERIFYPEER => false
]);


$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);


curl_close($ch);


if ($httpCode !== 200 || !$response) {
return null;
}


return $response;
}
}