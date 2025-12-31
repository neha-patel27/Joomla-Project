<?php
namespace Joomla\Component\Crudsample\Administrator\Model;

use Joomla\CMS\MVC\Model\ListModel;

class ItemsModel extends ListModel
{
    protected function getListQuery()
    {
        $db = $this->getDatabase();
        return $db->getQuery(true)
            ->select('*')
            ->from('#__crudsample');
    }
}
