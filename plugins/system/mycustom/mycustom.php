<?php
defined('_JEXEC') or die;

use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\CMS\Factory;

class PlgSystemMycustom extends CMSPlugin
{
    public function onMyCustomEvent($name, $age)
    {
        Factory::getApplication()
            ->enqueueMessage(
                "Plugin Triggered Successfully! Name: $name | Age: $age",
                'success'
            );
    }
}
