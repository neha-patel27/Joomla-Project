<?php
namespace Joomla\Component\Crudsample\Site\Controller;

defined('_JEXEC') or die;

require_once JPATH_COMPONENT . '/helpers/spout/autoload.php';

use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\CMS\Factory;
use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;

class ExportController extends BaseController
{
    public function csv()
    {
        set_time_limit(60);
        ignore_user_abort(false);
        ini_set('memory_limit', '512M');
        
        $writer = WriterFactory::create(Type::XLSX);
        $writer->openToBrowser("report_" . date('Y-m-d') . ".xlsx");
        $totalRows    = 100000;   
        $rowsPerSheet = 5000;    
        $sheetCount   = ceil($totalRows / $rowsPerSheet);
        $currentRow   = 1;

        for ($sheet = 1; $sheet <= $sheetCount; $sheet++) {

            if ($sheet > 1) {
                $writer->addNewSheetAndMakeItCurrent();
            }

            $writer->addRow(['ID','Name','Email','Mobile']);

            for ($i=1; $i <= $rowsPerSheet && $currentRow <= $totalRows; $i++) {

                if (connection_aborted()) {
                    $writer->close();
                    exit;
                }

                $writer->addRow([
                    $currentRow,
                    'User '.$currentRow,
                    'user'.$currentRow.'@example.com',
                    '9'.rand(100000000,999999999)
                ]);

                $currentRow++;
            }
        }
        $writer->close();
        exit;
    }
}
