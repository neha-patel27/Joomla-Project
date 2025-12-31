<?php
namespace Joomla\Component\Crudsample\Site\Model;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\ListModel;

class ItemsModel extends ListModel
{
    echo "inside ItemsModel";
    protected function getListQuery()
    {
        $db = $this->getDatabase();

        return $db->getQuery(true)
            ->select('*')
            ->from($db->quoteName('#__crudsample'));
    }
}
