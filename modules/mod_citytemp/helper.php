<?php
defined('_JEXEC') or die;


require_once __DIR__ . '/curl.php';


class ModCityTempHelper
{
    public static function getWeather($city)
    {
        if (!$city) {
         return null;
        }


        $url = "https://wttr.in/" . urlencode($city) . "?format=j1";


        $response = ModCityTempCurl::get($url);


        if (!$response) {
            return null;
        }


        $data = json_decode($response, true);


        if (!isset($data['current_condition'][0])) {
            return null;
        }


        return [
            'city' => $city,
            'temperature' => $data['current_condition'][0]['temp_C'],
            'description' => $data['current_condition'][0]['weatherDesc'][0]['value']
        ];
    }
}