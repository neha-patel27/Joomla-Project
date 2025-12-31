<?php
namespace Joomla\Component\Crudsample\Site\Controller;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\CMS\Session\Session;

class ImportController extends BaseController
{
    public function upload()
    {
        Session::checkToken() or jexit('Invalid Token');
echo "inside ImportController upload method";
        $file = $_FILES['csv_file']['tmp_name'];
        $db   = Factory::getDbo();

        if (($handle = fopen($file, 'r')) !== false)
        {
            fgetcsv($handle);

            while (($data = fgetcsv($handle)) !== false)
            {
                $query = $db->getQuery(true)
                    ->insert('#__crudsample')
                    ->columns(['title'])
                    ->values($db->quote($data[1]));

                $db->setQuery($query)->execute();
            }
            fclose($handle);
        }

        $this->setRedirect('index.php?option=com_crudsample', 'CSV Imported Successfully');
    }
}
