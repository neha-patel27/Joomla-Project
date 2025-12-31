<?php
defined('_JEXEC') or die;

class ModCurrencyConverterHelper
{
    public static function apiRequest($url , $timeout = 10)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            error_log('cURL error: ' . curl_error($ch));
            curl_close($ch);
            return false;
        }

        curl_close($ch);
        return $response;
    }

    public static function getRates()
    {
        $url = "https://api.frankfurter.app/latest";

        $response = self::apiRequest($url);
        $data = json_decode($response, true);

        $rates = $data['rates'] ?? [];
        $rates['EUR'] = 1;

        ksort($rates);

        return $rates;
    }
}
