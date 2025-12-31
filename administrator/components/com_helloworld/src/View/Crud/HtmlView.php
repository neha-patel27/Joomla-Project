<?php
namespace Joomla\Component\Crudsample\Administrator\View\Crud;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Factory;

defined('_JEXEC') or die;

class HtmlView extends BaseHtmlView
{
    protected $items;

    public function display($tpl = null)
    {
        $model = $this->getModel();
        $this->items = $model->getItems();
        parent::display($tpl);
    }
}
