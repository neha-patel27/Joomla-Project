<?php
namespace Joomla\Component\Crudsample\Site\View\Item;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;

class HtmlView extends BaseHtmlView
{
    protected $form;
    protected $item;
echo "inside Item HtmlView display method"; 
    public function display($tpl = null)
    {
        // Get form from model
        $this->form = $this->get('Form');

        // Get item data (for edit)
        $this->item = $this->get('Item');

        // Error handling
        if (count($errors = $this->get('Errors')))
        {
            throw new \Exception(implode("\n", $errors), 500);
        }

        parent::display($tpl);
    }
}
