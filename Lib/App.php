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
     * @copyright Copyright (c)
     * @author Wongzx <842687571@qq.com>
     */
    public static function getConfig()
    {
        return self::$container['config'];
    }
}