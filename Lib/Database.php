<?php

namespace Lib;

use Doctrine\DBAL\Configuration;
use Nette\Database\Connection;
class Database
{
    private static $dbInfo;

    /**
     *[initialization 初始化数据库]
     * @author  Wongzx <[842687571@qq.com]>
     * @copyright Copyright (c)
     * @return    [type]        [description]¬
     */
//    public function initialization()
//    {
//        $config = new Configuration();
//        $connectionParams = [
//            'dbname' => App::getConfig('db_name'),
//            'user' => App::getConfig('db_user'),
//            'password' => App::getConfig('db_pwd'),
//            'host' => App::getConfig('db_host'),
//            'driver' => App::getConfig('db_driver'),
//            'port' => App::getConfig('db_port'),
//            'charset' => App::getConfig('db_charset'),
//        ];
//        $conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams, $config);
//        return $conn;
//    }

    private $parameters;

    private $services = [];


    function createDatabase()
    {
        return new Connection(
            $this->parameters[App::getConfig('db_dbms')],
            $this->parameters[App::getConfig('db_user')],
            $this->parameters[App::getConfig('db_pwd')]
        );
    }

    function createArticleFactory()
    {
        return new ArticleFactory($this->getService('Database'));
    }

    function getService($name)
    {
        if (!isset($this->services[$name])) {
            // getService('Database') will call createDatabase()
            $method = 'create' . $name;
            $this->services[$name] = $this->$method();
        }
        return $this->services[$name];
    }
}