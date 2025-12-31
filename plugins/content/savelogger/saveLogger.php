<?php
defined('_JEXEC') or die;

use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\CMS\Factory;

class PlgContentSaveLogger extends CMSPlugin
{
    public function __construct(&$subject, $config)
    {
        parent::__construct($subject, $config);
    }

    public function onContentBeforeSave($context, $article, $isNew)
    {
        $article->before_save_data = json_encode([
            'title' => $article->title ?? '',
            'content' => $article->introtext ?? ''
        ]);

        if (!empty($article->title)) {
            $article->title = strtoupper($article->title);
        }

        $this->logSaveEvent($article, $isNew, 'before_save');

        return true;
    }

    public function onContentAfterSave($context, $article, $isNew)
    {
        $actionType = $isNew ? 'created' : 'updated';

        $article->after_save_data = json_encode([
            'title' => $article->title ?? '',
            'content' => $article->introtext ?? ''
        ]);
        $this->logSaveEvent($article, $isNew, 'after_save');
    }

    private function logSaveEvent($item, $isNew, $action)
    {
        $db = Factory::getDbo();
        $tableName = $db->quoteName('#__save_logs');

        $createQuery = "
            CREATE TABLE IF NOT EXISTS $tableName (
                 id INT(11) NOT NULL AUTO_INCREMENT,
                title VARCHAR(255) NOT NULL,
                record_id INT(11) NOT NULL,
                action VARCHAR(50) NOT NULL,
                user_id INT(11) DEFAULT 0,
                ip_address VARCHAR(50) DEFAULT NULL,
                user_agent VARCHAR(255) DEFAULT NULL,
                before_save_data TEXT,
                after_save_data TEXT,
                created_at DATETIME NOT NULL,
                PRIMARY KEY (id)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
        ";

        $db->setQuery($createQuery)->execute();

        $user = Factory::getUser();
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'] ?? 'UNKNOWN';
        $ip = explode(',', $ip)[0];
        $ip = trim($ip);
        $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? 'UNKNOWN';

        $log = new stdClass();
        $log->title           = $item->title ?? 'N/A';
        $log->record_id       = $item->id ?? 0;
        $log->action          = $action;
        $log->user_id         = $user->id ?? 0;
        $log->ip_address      = $ip;
        $log->user_agent      = $userAgent;
        $log->before_save_data= $item->before_save_data ?? null;
        $log->after_save_data = $item->after_save_data ?? null;
        $log->created_at      = date('Y-m-d H:i:s');

        $db->insertObject('#__save_logs', $log);
    }

}
