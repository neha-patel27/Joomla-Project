<?php
namespace Joomla\Component\Crudsample\Site\View\Items;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;

class HtmlView extends BaseHtmlView
{
    protected $items;
echo "inside Items HtmlView display method";
    public function display($tpl = null)
    {
        $this->items = $this->get('Items');
        parent::display($tpl);
    }
}
