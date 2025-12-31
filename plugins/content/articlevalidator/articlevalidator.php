<?php
defined('_JEXEC') or die;

use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\CMS\Factory;

class PlgContentArticlevalidator extends CMSPlugin
{
    protected $app;

    public function onContentBeforeSave($context, $article, $isNew)
    {
        if ($context !== 'com_content.article') {
            return true;
        }

        if (strlen($article->title) < 5) {
            $this->app->enqueueMessage('Title must be at least 5 characters.', 'warning');
            return false;
        }

        Factory::getApplication()
            ->triggerEvent('onMyCustomEvent', ['Neha Patel', 24]);
            
        return true;
    }

    public function onContentAfterSave($context, $article, $isNew)
    {
        if ($context !== 'com_content.article') {
            return;
        }

        $db = Factory::getDbo();

        $log = (object) [
            'article_id' => $article->id,
            'title'      => $article->title,
            'status'     => $isNew ? 'CREATED' : 'UPDATED',
            'created'    => Factory::getDate()->toSql()
        ];

        $db->insertObject('#__article_validation_logs', $log);
    }
}
