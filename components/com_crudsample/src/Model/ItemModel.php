<?php
namespace Joomla\Component\Crudsample\Site\Model;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\FormModel;
use Joomla\CMS\Factory;

class ItemModel extends FormModel
{
    // Load form data (handles Add/Edit)
    protected function loadFormData()
    {
        $data = Factory::getApplication()->getUserState(
            'com_crudsample.edit.item.data', []
        );

        if (empty($data))
        {
            $data = $this->getItem();
        }

        return $data;
    }

    // Get form
    public function getForm($data = [], $loadData = true)
    {
        return $this->loadForm(
            'com_crudsample.item',
            'item',
            ['control' => 'jform', 'load_data' => $loadData]
        );
    }

    // Get table
    public function getTable($type = 'Item', $prefix = 'Table', $config = [])
    {
        return parent::getTable($type, $prefix, $config);
    }

    // Get item
    public function getItem($pk = null)
    {
        $table = $this->getTable();

        if ($pk === null)
        {
            $input = Factory::getApplication()->input;
            $pk = $input->getInt('id', 0);
        }

        if ($pk)
        {
            $table->load($pk);
        }
        else
        {
            $table->id = 0; // new item
        }

        return $table;
    }

    // Save Add/Edit
    public function save($data)
    {
        $table = $this->getTable();

        if (!$table->bind($data)) {
            return false;
        }

        if (!$table->store()) {
            return false;
        }

        return true;
    }

    // Delete
    public function delete($id)
    {
        $table = $this->getTable();
        return $table->delete($id);
    }
}
