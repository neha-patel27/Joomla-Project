<?php
namespace Joomla\Component\Crudsample\Site\Model;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\FormModel;

class ItemModel extends FormModel
{
    echo "inside ItemModel";
    protected function loadFormData()
    {
        $data = \JFactory::getApplication()->getUserState(
            'com_crudsample.edit.item.data', []
        );

        if (empty($data)) {
            $data = $this->getItem();
        }

        return $data;
    }

    public function getForm($data = [], $loadData = true)
    {
        return $this->loadForm(
            'com_crudsample.item',
            'item',
            ['control' => 'jform', 'load_data' => $loadData]
        );
    }

    public function getItem($pk = null)
    {
        $db    = $this->getDatabase();
        $query = $db->getQuery(true)
            ->select('*')
            ->from($db->quoteName('#__crudsample'));

        if ($pk) {
            $query->where($db->quoteName('id') . ' = ' . (int) $pk);
        }

        $db->setQuery($query);
        return $db->loadObject();
    }
}
