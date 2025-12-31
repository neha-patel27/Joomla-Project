<?php
defined('_JEXEC') or die;

use Joomla\CMS\Factory;

require_once __DIR__ . '/helper.php';

$input = Factory::getApplication()->input;
$id    = $input->getInt('id');

// normal load (GET request)
$item = null;
if ($input->getMethod() === 'GET') {
    $db = Factory::getDbo();
    $query = $db->getQuery(true)
        ->select('*')
        ->from('#__crudsample')
        ->where('id = ' . (int) $id);
    $db->setQuery($query);
    $item = $db->loadObject();
}

// layout load
require JModuleHelper::getLayoutPath('mod_crudsampleedit');
