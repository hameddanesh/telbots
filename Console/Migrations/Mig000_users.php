<?php

namespace Telbots\Console\Migrations;

use Telbots\Core\Model;

class Mig000_users
{
    public function __construct($database, Model $model)
    {
        $model->init($database, "CREATE TABLE IF NOT EXISTS `tb.users` ("
            . "  `chatId` int(11) NOT NULL,"
            . "  `telUsername` varchar(255) DEFAULT NULL,"
            . "  `telFullname` varchar(255) DEFAULT NULL,"
            . "  `panelUsername` varchar(255) DEFAULT NULL,"
            . "  `panelFullname` varchar(255) DEFAULT NULL,"
            . "  `panelPassword` varchar(127) DEFAULT NULL,"
            . "  `currentMenu` varchar(255) NOT NULL DEFAULT 'home',"
            . "  `creator` int(11) NOT NULL DEFAULT 0,"
            . "  `referral` int(11) NOT NULL DEFAULT 0,"
            . "  `status` tinyint(4) NOT NULL DEFAULT 0,"
            . "  `accessLevel` int(11) NOT NULL DEFAULT 1,"
            . "  `message` text DEFAULT NULL,"
            . "  PRIMARY KEY (`chatId`),"
            . "  KEY `tb_users_FK` (`creator`),"
            . "  KEY `tb_users_FK_1` (`referral`),"
            . "  CONSTRAINT `tb_users_FK` FOREIGN KEY (`creator`) REFERENCES `tb.users` (`chatId`) ON DELETE CASCADE ON UPDATE CASCADE,"
            . "  CONSTRAINT `tb_users_FK_1` FOREIGN KEY (`referral`) REFERENCES `tb.users` (`chatId`) ON DELETE CASCADE ON UPDATE CASCADE"
            . ") ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;");
        $model->stmt->execute();

        $model->init($database, "INSERT IGNORE INTO `tb.users` VALUES (0,'system','system','system','system',NULL,'home',0,0,0,0,NULL);");
        $model->stmt->execute();
    }
}
