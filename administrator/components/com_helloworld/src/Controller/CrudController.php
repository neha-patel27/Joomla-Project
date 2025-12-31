<?php
namespace Joomla\Component\Crudsample\Administrator\Controller;

use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\CMS\Factory;

defined('_JEXEC') or die;

class CrudController extends BaseController
{
    public function save()
    {
        $data = Factory::getApplication()->input->get('jform', [], 'ARRAY');
        $model = $this->getModel('Crud');

        if ($model->save($data)) {
            $this->setMessage('Saved successfully');
        } else {
            $this->setMessage('Save failed', 'error');
        }

        $this->setRedirect('index.php?option=com_crudsample');
    }

    public function delete()
    {
        $id = Factory::getApplication()->input->getInt('id');
        $model = $this->getModel('Crud');

        if ($model->delete($id)) {
            $this->setMessage('Deleted successfully');
        } else {
            $this->setMessage('Delete failed', 'error');
        }

        $this->setRedirect('index.php?option=com_crudsample');
    }

    public function export()
    {
        $model = $this->getModel('Crud');
        $rows = $model->getItems();

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="export.csv"');

        $output = fopen('php://output', 'w');
        fputcsv($output, array_keys((array)$rows[0]));

        foreach ($rows as $row) {
            fputcsv($output, (array)$row);
        }
        fclose($output);
        exit;
    }

    public function import()
    {
        $file = Factory::getApplication()->input->files->get('csv_file');

        if ($file['error'] === 0) {
            $model = $this->getModel('Crud');
            $model->importCsv($file['tmp_name']);
            $this->setMessage('Import successful');
        } else {
            $this->setMessage('Import failed', 'error');
        }

        $this->setRedirect('index.php?option=com_crudsample');
    }
}
