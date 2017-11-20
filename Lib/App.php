<?php

namespace Lib;

use Pimple\Container;
use Noodlehaus\Config;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class App
{
    use Handler;

    protected static $container;

    /**
     *[run Run]
     * @author  Wongzx <[842687571@qq.com]>
     * @copyright Copyright (c)
     * @return    [type]        [description]
     */
    public function run()
    {

        $a = new Cache();
        $a->createCache(['host' => '192.168.128.130','port' => 11211],'apcu');
//        if ($a->checking('id')) {
//            echo '123';
//        } else {
//        }
        $s = $a->set('id', ['id' => 1]);
        dump($s);
        $x = $a->get('id');
        dump($x);
        die;
        $this->initContainer();
        $this->initRoute();
    }

    /**
     * initContainer  [初始化容器]
     * @copyright Copyright (c)
     * @author Wongzx <842687571@qq.com>
     */
    public function initContainer()
    {
        //实例化容器对象
        $container = new Container();

        //载入我们的config文件
        $config = Config::load(APP_PATH . "Application/Configs");

        //注入到容器，下次可以直接使用
        $container['config'] = $config;

        //数据库
//        $db = new Database([
//            'dbname' => $config['doctrine']['dbal']['db_name'],
//            'user' => $config['doctrine']['dbal']['db_user'],
//            'password' => $config['doctrine']['dbal']['db_pwd'],
//            'host' => $config['doctrine']['dbal']['db_host'],
//            'driver' => $config['doctrine']['dbal']['db_driver'],
//            'port' => $config['doctrine']['dbal']['db_port'],
//            'charset' => $config['doctrine']['dbal']['db_charset'],
//        ]);
//        $container['dataBase'] = $db->db;

        //初始化视图
        $view = new View();
        $container['view'] = $view;

        //日志服务代码如下，我们使用config作为闭包的参数传进去
//        $container['logger'] = function () use ($config) {
//        };
        $logger = new Logger($config->get('app_name'));
        $logger->pushHandler(new StreamHandler(APP_PATH . $config->get('log_file'), Logger::WARNING));
        $container['logger'] = $logger;

        self::$container = $container;

    }

    /**
     * getContainer  [得到容器加载应用]
     * @copyright Copyright (c)
     * @author Wongzx <842687571@qq.com>
     * @return mixed
     */
    public static function getContainer()
    {
        return self::$container;
    }

    /**
     * getLogger  [description]
     * @copyright Copyright (c)
     * @author Wongzx <842687571@qq.com>
     */
    public static function getLogger()
    {
        return self::$container['logger'];
    }

    /**
     * getConfig  [description]
     * @author Wongzx <842687571@qq.com>
     * @param $configName
     * @param string $default
     * @copyright Copyright (c)
     * @return mixed
     */
    public static function getConfig($configName, $default = 'default')
    {
        return self::$container['config'][$default][$configName];
    }

    /**
     *[getDatabase mixed]
     * @author  Wongzx <[842687571@qq.com]>
     * @copyright Copyright (c)
     * @return    [type]        [description]
     */
    public function getDatabase()
    {
        return self::$container['dataBase'];
    }

}