<?php

namespace Lib;

use Doctrine\DBAL\Configuration;

class Database
{
    private static $dbInfo;

    public function __construct()
    {
        self::getDbInfo();
    }

    /**
     *[initialization 初始化数据库]
     * @author  Wongzx <[842687571@qq.com]>
     * @copyright Copyright (c)
     * @return    [type]        [description]¬
     */
    public function initialization()
    {
        $config = new \Doctrine\DBAL\Configuration();
        $connectionParams = [
            'dbname' => self::$dbInfo['name'],
            'user' => self::$dbInfo['user'],
            'password' => self::$dbInfo['pwd'],
            'host' => self::$dbInfo['host'],
            'driver' => self::$dbInfo['driver'],
            'port' => self::$dbInfo['port'],
            'charset' => self::$dbInfo['charset'],
        ];
        $conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams, $config);
        return $conn;
    }


    private static function getDbInfo()
    {
        self::$dbInfo = Configs::getConfigFile('db');
    }
}