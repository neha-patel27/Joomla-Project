<?php
namespace Joomla\Component\Crudsample\Site\Controller;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\CMS\Session\Session;

class ImportController extends BaseController
{
    public function upload()
{
    \Joomla\CMS\Session\Session::checkToken() or jexit('Invalid Token');

    if (!isset($_FILES['csv_file']['tmp_name']) || empty($_FILES['csv_file']['tmp_name'])) {
        $this->setRedirect('index.php?option=com_crudsample&view=items', 'No file uploaded', 'error');
        return;
    }

    $file = $_FILES['csv_file']['tmp_name'];
    $db   = \Joomla\CMS\Factory::getDbo();

    if (($handle = fopen($file, 'r')) !== false)
    {
        fgetcsv($handle); // Skip header

        while (($data = fgetcsv($handle)) !== false)
        {
            $query = $db->getQuery(true)
                ->insert($db->quoteName('#__crudsample'))
                ->columns([$db->quoteName('title'), $db->quoteName('created')])
                ->values($db->quote($data[1]) . ', NOW()');

            try {
                $db->setQuery($query)->execute();
            } catch (\Exception $e) {
                echo "Row failed: " . implode(', ', $data) . " | Error: " . $e->getMessage();
            }
        }
        fclose($handle);
    }

    $this->setRedirect(
        \Joomla\CMS\Router\Route::_('index.php?option=com_crudsample&view=items', false),
        'CSV Imported Successfully'
    );
}

}
