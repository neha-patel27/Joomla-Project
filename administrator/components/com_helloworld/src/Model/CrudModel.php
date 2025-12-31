<?php
namespace Joomla\Component\Crudsample\Administrator\Model;

use Joomla\CMS\MVC\Model\BaseDatabaseModel;
use Joomla\CMS\Factory;
use Joomla\CMS\Table\Table;

defined('_JEXEC') or die;

class CrudModel extends BaseDatabaseModel
{
    protected $table = '#__crudsample';

    public function getItems()
    {
        $db = Factory::getDbo();
        $query = $db->getQuery(true)
            ->select('*')
            ->from($db->quoteName($this->table));
        $db->setQuery($query);
        return $db->loadObjectList();
    }

    public function save($data)
    {
        $table = Table::getInstance('CrudTable', 'CrudSample\\Component\\CrudSample\\Administrator\\Table');
        $table->bind($data);
        return $table->store();
    }

    public function delete($id)
    {
        $table = Table::getInstance('CrudTable', 'CrudSample\\Component\\CrudSample\\Administrator\\Table');
        return $table->delete($id);
    }

    public function importCsv($filePath)
    {
        $handle = fopen($filePath, 'r');
        $header = fgetcsv($handle);
        while (($row = fgetcsv($handle)) !== false) {
            $data = array_combine($header, $row);
            $this->save($data);
        }
        fclose($handle);
    }
}
