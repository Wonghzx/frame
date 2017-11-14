<?php

namespace Lib;

use Doctrine\DBAL\Configuration;


class Database
{
    private static $dbInfo;

    private $parameters;

    private $services = [];

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
        $config = new Configuration();
        $conn = \Doctrine\DBAL\DriverManager::getConnection($this->parameters, $config);
        return $conn;
    }

    private function getService($name = 'Database')
    {
        if (!isset($this->services[$name])) {
            // getService('Database') 调用 createDatabase() 方法
            $method = 'create' . $name;
            $this->services[$name] = $this->$method();
        }
        return $this->services[$name];
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