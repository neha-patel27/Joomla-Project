<?php
namespace Joomla\Component\Crudsample\Administrator\Controller;

use Joomla\CMS\Factory;
use Joomla\CMS\Session\Session;
use Joomla\CMS\MVC\Controller\BaseController;

class ImportController extends BaseController
{
    public function csv()
    {
        Session::checkToken() or jexit('Invalid Token');
        $file = $_FILES['csv']['tmp_name'];
        $db = Factory::getDbo();

        if (($handle = fopen($file, 'r')) !== false) {
            fgetcsv($handle);
            while (($data = fgetcsv($handle)) !== false) {
                $query = $db->getQuery(true)
                    ->insert('#__crudsample')
                    ->columns(['title', 'created'])
                    ->values(
                        $db->quote($data[1]) . ', NOW()'
                    );
                $db->setQuery($query)->execute();
            }
            fclose($handle);
        }

        $this->setRedirect('index.php?option=com_crudsample');
    }
}
