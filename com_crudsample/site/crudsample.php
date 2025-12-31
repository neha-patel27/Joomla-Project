<?php
defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Controller\BaseController;


echo JPATH_COMPONENT . "<br>";
var_dump(file_exists(JPATH_COMPONENT . '/src/Controller/DisplayController.php'));

$controller = BaseController::getInstance(
    'Crudsample',
    [
        'base_path' => JPATH_COMPONENT
    ]
);
echo "inside crudsample.php";
$controller->execute(Factory::getApplication()->input->get('task', 'display'));
$controller->redirect();
