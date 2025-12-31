<?php
namespace Joomla\Component\Crudsample\Site\Controller;

use Joomla\CMS\MVC\Controller\FormController;

class ItemController extends FormController
{
    echo "inside ItemController";

    protected $view_list = 'items';

    public function display($cachable = false, $urlparams = [])
    {
        parent::display($cachable, $urlparams);
    }
}
