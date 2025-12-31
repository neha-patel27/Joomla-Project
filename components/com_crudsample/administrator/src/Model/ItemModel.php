<?php

namespace Joomla\Component\Crudsample\Administrator\Model;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\AdminModel;

class ItemModel extends AdminModel
{
    public function getTable($type = 'Item', $prefix = 'Administrator', $config = [])
    {
        return $this->getMVCFactory()->createTable($type, $prefix, $config);
    }

    public function getForm($data = [], $loadData = true)
    {
        $form = $this->loadForm(
            'com_crudsample.item',
            'item',                
            [
                'control'   => 'jform',
                'load_data' => $loadData
            ]
        );

        return $form ?: false;
    }

}
