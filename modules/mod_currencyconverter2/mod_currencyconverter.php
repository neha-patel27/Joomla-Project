<?php
defined('_JEXEC') or die;

use Joomla\CMS\Helper\ModuleHelper;

require_once __DIR__ . '/helper.php';

$rates = ModCurrencyConverterHelper::getRates();

$defaultAmount = $params->get('default_amount', 1);
$defaultFrom   = strtoupper($params->get('default_from', 'USD'));
$defaultTo     = strtoupper($params->get('default_to', 'INR'));

require ModuleHelper::getLayoutPath('mod_currencyconverter', 'default');
