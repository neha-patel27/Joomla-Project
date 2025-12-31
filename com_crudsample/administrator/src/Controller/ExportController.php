<?php
namespace Joomla\Component\Crudsample\Administrator\Controller;

use Joomla\CMS\Factory;
use Joomla\CMS\Session\Session;
use Joomla\CMS\MVC\Controller\BaseController;

class ExportController extends BaseController
{
    public function csv()
    {
        $db = Factory::getDbo();
        $query = $db->getQuery(true)
            ->select('*')
            ->from('#__crudsample');
        $db->setQuery($query);
        $rows = $db->loadAssocList();

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="crudsample.csv"');

        $out = fopen('php://output', 'w');
        if (!empty($rows)) {
            fputcsv($out, array_keys($rows[0]));
            foreach ($rows as $row) {
                fputcsv($out, $row);
            }
        }
        fclose($out);
        exit;
    }
}
