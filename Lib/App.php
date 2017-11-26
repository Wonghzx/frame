<?php

namespace Lib;

use Pimple\Container;
use Noodlehaus\Config;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use duncan3dc\Sessions\SessionInstance;
use duncan3dc\Sessions\Session;
use duncan3dc\Sessions\Cookie;

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
        self::$container = new Container();

        //载入我们的config文件
        $config = Config::load(APP_PATH . "Application/Configs");

        //注入到容器，下次可以直接使用
        self::$container['config'] = $config;

        //数据库
        $db = new Database([
            'dbname' => $config['doctrine']['dbal']['db_name'],
            'user' => $config['doctrine']['dbal']['db_user'],
            'password' => $config['doctrine']['dbal']['db_pwd'],
            'host' => $config['doctrine']['dbal']['db_host'],
            'driver' => $config['doctrine']['dbal']['db_driver'],
            'port' => $config['doctrine']['dbal']['db_port'],
            'charset' => $config['doctrine']['dbal']['db_charset'],
        ]);
        self::$container['dataBase'] = $db->db;


        //初始化视图
        $view = new View();
        self::$container['view'] = $view;

        //设置session会话
        self::$container['session'] = $this->createSession();

        //日志服务代码如下，我们使用config作为闭包的参数传进去
//        $container['logger'] = function () use ($config) {
//        };
        $logger = new Logger($config->get('app_name'));
        $logger->pushHandler(new StreamHandler(APP_PATH . $config->get('log_file'), Logger::WARNING));

        self::$container['logger'] = $logger;
    }


    /**
     *[createSession void]
     * @author  Wongzx <[842687571@qq.com]>
     * @copyright Copyright (c)
     * @return    [type]        [description]
     */
    private function createSession()
    {
        $sessionInstance = new SessionInstance('APPSESSION');
        return $sessionInstance;
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