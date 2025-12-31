<?php
namespace Joomla\Component\Crudsample\Administrator\Table;

use Joomla\CMS\Table\Table;

class ItemTable extends Table
{
    public function __construct($db)
    {
        parent::__construct('#__crudsample', 'id', $db);
    }
}

