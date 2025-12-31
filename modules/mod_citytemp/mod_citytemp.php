<?php
defined('_JEXEC') or die;

require_once __DIR__ . '/helper.php';

$app   = JFactory::getApplication();
$input = $app->input;

$city = $input->getString('city', $params->get('city'));

$data = ModCityTempHelper::getWeather($city);

require JModuleHelper::getLayoutPath('mod_citytemp');
