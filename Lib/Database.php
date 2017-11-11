<?php

namespace Lib;

use Doctrine\DBAL\Configuration;

class Database
{
    private static $dbInfo;

    /**
     *[initialization 初始化数据库]
     * @author  Wongzx <[842687571@qq.com]>
     * @copyright Copyright (c)
     * @return    [type]        [description]¬
     */
    public function initialization()
    {
        $config = new Configuration();
        $connectionParams = [
            'dbname' => App::getConfig()['name'],
            'user' => App::getConfig()['user'],
            'password' => App::getConfig()['pwd'],
            'host' => App::getConfig()['host'],
            'driver' => App::getConfig()['driver'],
            'port' => App::getConfig()['port'],
            'charset' => App::getConfig()['charset'],
        ];
        $conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams, $config);
        return $conn;
    }


    private static function getDbInfo()
    {
        self::$dbInfo = Configs::getConfigFile('db');
    }
}