<?php
namespace Joomla\Component\Crudsample\Site\View\Item;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;

class HtmlView extends BaseHtmlView
{
    protected $form;
    protected $item;

    public function display($tpl = null)
    {
        $model = $this->getModel();

        $this->form = $model->getForm();
        if (empty($this->form)) {
            throw new \Exception('Form not loaded', 500);
        }

        $this->item = $model->getItem();

        parent::display($tpl);
    }
}
