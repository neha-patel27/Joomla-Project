<?php
namespace Joomla\Component\Crudsample\Site\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Controller\BaseController;

class DisplayController extends BaseController
{
    public function display($cachable = false, $urlparams = [])
    {
        echo "inside DisplayController display method";
        $viewName   = $this->input->getCmd('view', 'items');
        $viewFormat = Factory::getDocument()->getType();

        $view = $this->getView($viewName, $viewFormat);
        $view->document = Factory::getDocument();
        $view->display();
    }
}
