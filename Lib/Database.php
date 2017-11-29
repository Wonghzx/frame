<?php

namespace Lib;

use Doctrine\DBAL\Configuration;
use Medoo\Medoo;

class Database
{
    private $parameters;

    private static $services = [];

    public $db;

    public function __construct(array $parameters)
    {
        $this->parameters = $parameters;
        $this->db = $this->getService();
    }


    /**
     *[initialization 初始化数据库]
     * @author  Wongzx <[842687571@qq.com]>
     * @copyright Copyright (c)
     * @return    [type]        [description]¬
     */
    private function createDatabase()
    {
//        $config = new Configuration();
//        $conn = \Doctrine\DBAL\DriverManager::getConnection($this->parameters, $config);
//        return $conn;

        // Initialize
        $database = new Medoo($this->parameters);
        return $database;
    }

    private function getService($name = 'Database')
    {
        if (!isset(self::$services[$name])) {
            // getService('Database') 调用 createDatabase() 方法
            $method = 'create' . $name;
            self::$services[$name] = $this->$method();
        }
        return self::$services[$name];
    }

    /**
     * query  [description]
     * @param $sql
     * @copyright Copyright (c)
     * @author Wongzx <842687571@qq.com>
     * @return array
     */
    public function createQueryBuilder()
    {
        if (empty($sql)) {
            return [];
        } else {
            $queryBuilder = $this->db->createQueryBuilder();
            return $queryBuilder;
        }
    }

}