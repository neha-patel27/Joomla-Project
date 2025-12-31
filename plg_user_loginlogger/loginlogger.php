<?php
defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Plugin\CMSPlugin;

class PlgUserlogger extends CMSPlugin
{
   
    public function onUserLogin($user, $options = [])
    {
        dd($user);
        $this->storeLog($user['id'], $user['username'], 'login');
    }
   
    public function onUserLogout($user, $options = [])
    {
        $this->storeLog($user['id'], $user['username'], 'logout');
    }

    private function storeLog($userId, $username, $action)
    {
        $db = Factory::getDbo();

        $query = $db->getQuery(true)
            ->insert($db->quoteName('#__login_logs'))
            ->columns([
                $db->quoteName('user_id'),
                $db->quoteName('username'),
                $db->quoteName('action')
            ])
            ->values(
                (int) $userId . ', ' .
                $db->quote($username) . ', ' .
                $db->quote($action)
            );

        $db->setQuery($query);
        $db->execute();
    }
}
