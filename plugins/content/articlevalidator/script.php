<?php
defined('_JEXEC') or die;

use Joomla\CMS\Factory;

class PlgContentArticlevalidatorInstallerScript
{
    public function install($parent)
    {
        $this->createTable();
    }

    public function update($parent)
    {
        $this->createTable();
    }

    private function createTable()
    {
        $db = Factory::getDbo();

        $query = "
            CREATE TABLE IF NOT EXISTS `#__article_validation_logs` (
                `id` INT AUTO_INCREMENT PRIMARY KEY,
                `article_id` INT NOT NULL,
                `title` VARCHAR(255),
                `status` VARCHAR(20),
                `created` DATETIME
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
        ";

        $db->setQuery($query);
        $db->execute();
    }
}
