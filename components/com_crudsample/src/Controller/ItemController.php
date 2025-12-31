<?php
namespace Joomla\Component\Crudsample\Site\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\FormController;
use Joomla\CMS\Factory;
use Joomla\CMS\Router\Route;

class ItemController extends FormController
{
    protected $view_list = 'items';

    // Allow Add/Edit
    protected function allowAdd($data = [])
    {
        return true;
    }

    protected function allowEdit($data = [], $key = 'id')
    {
        return true;
    }

    // Cancel
    public function cancel($key = null)
    {
        $this->setRedirect(Route::_('index.php?option=com_crudsample&view=items', false));
        return true;
    }

    // Add
    public function add()
    {
        // Clear previous edit data
        Factory::getApplication()->setUserState('com_crudsample.edit.item.data', null);

        // Redirect to form view without id
        $this->setRedirect(Route::_('index.php?option=com_crudsample&view=item', false));
    }

    // Delete
    public function delete()
    {
        $id = $this->input->getInt('id');

        if ($id)
        {
            $model = $this->getModel();
            if ($model->delete($id))
            {
                $this->setMessage('Item deleted successfully');
            }
            else
            {
                $this->setMessage('Failed to delete item', 'error');
            }
        }

        $this->setRedirect(Route::_('index.php?option=com_crudsample&view=items', false));
    }

    // Save Add/Edit
    public function save($key = null, $urlVar = null)
    {
        $app  = Factory::getApplication();
        $data = $app->input->get('jform', [], 'array');

        $model = $this->getModel();

        if ($model->save($data))
        {
            $this->setMessage('Item saved successfully');
        }
        else
        {
            $this->setMessage('Failed to save item', 'error');
        }

        $this->setRedirect(Route::_('index.php?option=com_crudsample&view=items', false));
    }
}
