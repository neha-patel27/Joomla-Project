<?php
namespace Joomla\Component\Crudsample\Administrator\Table;

use Joomla\CMS\Table\Table;

defined('_JEXEC') or die;

class CrudTable extends Table
{
    public function __construct(&$db = null)
    {
        parent::__construct('#__crudsample', 'id', $db);
    }
}
