<?php
defined('_JEXEC') or die;

use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\CMS\Factory;

class PlgUserUserlog extends CMSPlugin
{
    public function onUserLogin($user, $options = [])
    {
        $this->log($user, 'login');
    }

    public function onUserLogout($user, $options = [])
    {
        $this->log($user, 'logout');
    }

    private function log($user, $action)
    {
        $db = Factory::getDbo();

        $columns = ['user_id', 'username', 'action', 'created_at'];
        $values = [
            (int) ($user['id'] ?? 0),
            $db->quote($user['username'] ?? ''),
            $db->quote($action),
            $db->quote(date('Y-m-d H:i:s'))
        ];

        $query = $db->getQuery(true)
            ->insert($db->quoteName('#__login_logs'))
            ->columns($db->quoteName($columns))
            ->values(implode(',', $values));

        $db->setQuery($query);
        $db->execute();
    }
}
