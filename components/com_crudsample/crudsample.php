<?php
defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Controller\BaseController;


$controller = BaseController::getInstance(
    'Crudsample',
    [
        'base_path' => JPATH_COMPONENT
    ]
);

$controller->execute(Factory::getApplication()->input->get('task', 'display'));
$controller->redirect();
