<?php
defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Controller\BaseController;

// Register Spout autoloader
require_once __DIR__ . '/spout/Autoloader/autoload.php';

// Run controller
$controller = BaseController::getInstance('Spouttest');
$controller->execute(Factory::getApplication()->input->get('task'));
$controller->redirect();
