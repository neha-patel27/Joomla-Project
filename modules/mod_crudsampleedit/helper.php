<?php
defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Table\Table;

class ModCrudsampleEditHelper
{
     public static function getFormAjax()
    {
        $input = \Joomla\CMS\Factory::getApplication()->input;
        $id = $input->getInt('id');

        if (!$id) {
            return 'Invalid ID';
        }

        ob_start();
        include __DIR__ . '/tmpl/form.php';
        return ob_get_clean();
    }


    public static function getItem($id)
    {
        $db = Factory::getDbo();
        $query = $db->getQuery(true)
            ->select('*')
            ->from('#__crudsample')
            ->where('id = ' . (int) $id);

        $db->setQuery($query);
        return $db->loadObject();
    }

    public static function saveItem($id, $title)
    {
        $table = Table::getInstance('Crudsample', 'Table', ['dbo' => Factory::getDbo()]);
        $table->load($id);
        $table->title = $title;

        return $table->store();
    }
}
