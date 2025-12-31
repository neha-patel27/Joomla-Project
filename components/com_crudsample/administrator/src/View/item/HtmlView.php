<?php
namespace Joomla\Component\Crudsample\Administrator\View\Item;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;

class HtmlView extends BaseHtmlView
{
    protected $item;

    public function display($tpl = null)
    {
        $this->item = $this->get('Item');
        parent::display($tpl);
    }
}

