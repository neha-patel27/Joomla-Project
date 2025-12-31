<?php
defined('_JEXEC') or die;

use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\CMS\Factory;
use Joomla\CMS\Log\Log;
use Joomla\Database\Exception\DatabaseException;

class PlgUserLogtracker extends CMSPlugin
{
    protected $app;

    public function onUserLogin($user, $options = array())
    {
        $this->logUserAction($user, 'login');
        return true;
    }

    public function onUserLogout($user, $options = array())
    {
        $this->logUserAction($user, 'logout');
        return true;
    }

    private function logUserAction($user, $action)
    {
        $db  = Factory::getDbo();
        $app = Factory::getApplication();

        $userid   = (int) ($user['id'] ?? 0);
        $username = $user['username'] ?? 'Unknown';
        $time     = Factory::getDate()->toSql();

        $ipAddress =
            $app->input->server->getString('HTTP_X_FORWARDED_FOR')
            ?: $app->input->server->getString('HTTP_CLIENT_IP')
            ?: $app->input->server->getString('REMOTE_ADDR')
            ?: 'UNKNOWN';

        $ipAddress = explode(',', $ipAddress)[0];
        $ipAddress = trim($ipAddress);

        if ($ipAddress === '::1') {
            $ipAddress = '127.0.0.1';
        }
        $browser = $app->input->server->get('HTTP_USER_AGENT', 'UNKNOWN');

        $createTableSql = "
            CREATE TABLE IF NOT EXISTS `#__user_logtracker` (
                `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                `user_id` INT(11) NOT NULL,
                `username` VARCHAR(255) NOT NULL,
                `ip_address` VARCHAR(45) NOT NULL,
                `browser` VARCHAR(255) NOT NULL,
                `action` VARCHAR(50) NOT NULL,
                `created_at` DATETIME NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
        ";

        $db->setQuery($createTableSql);
        $db->execute();

        $log = new stdClass();
        $log->user_id    = $userid;
        $log->username   = $username;
        $log->ip_address = $ipAddress;
        $log->browser    = $browser;
        $log->action     = $action;
        $log->created_at = $time;

        try {
            $db->insertObject('#__user_logtracker', $log);
        } catch (Exception $e) {
            \Joomla\CMS\Log\Log::add(
                'User log insert failed: ' . $e->getMessage(),
                \Joomla\CMS\Log\Log::ERROR,
                'plg_user_logtracker'
            );
        }
    }

}
