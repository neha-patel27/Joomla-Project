<?php
namespace Joomla\Component\Spouttest\Site\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\BaseController;
use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;

class ExportController extends BaseController
{
    public function excel()
    {
        // Prevent Joomla output
        while (ob_get_level()) {
            ob_end_clean();
        }

        // Excel writer
        $writer = WriterFactory::create(Type::XLSX);
        $writer->openToBrowser('joomla_spout_test.xlsx');

        // Header
        $writer->addRow(['ID', 'Name', 'Email']);

        // Fake data (testing)
        for ($i = 1; $i <= 50000; $i++) {
            $writer->addRow([
                $i,
                'User ' . $i,
                'user' . $i . '@test.com'
            ]);
        }

        $writer->close();
        exit;
    }
}
