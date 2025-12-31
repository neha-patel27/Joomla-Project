<?php
defined('_JEXEC') or die;

use Joomla\CMS\Installer\InstallerAdapter\ComponentInstallerAdapter;
use Joomla\CMS\Factory;

class Com_CrudsampleInstallerScript
{
    /**
     * Method to install the component
     *
     * @param ComponentInstallerAdapter $parent
     *
     * @return void
     */
    public function install($parent)
    {
        $this->createTables();
    }

    /**
     * Method to update the component
     *
     * @param ComponentInstallerAdapter $parent
     *
     * @return void
     */
    public function update($parent)
    {
        $this->createTables();
    }

    /**
     * Method to create necessary database tables
     *
     * @return void
     */
    private function createTables()
    {
        $db = Factory::getDbo();

        $query = "CREATE TABLE IF NOT EXISTS `#__crudsample` (
            `id` INT(11) NOT NULL AUTO_INCREMENT,
            `title` VARCHAR(255) NOT NULL,
            `created` DATETIME DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        $db->setQuery($query);
        $db->execute();
    }
}
