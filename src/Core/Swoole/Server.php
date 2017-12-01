<?php

namespace Core\Swoole;

use Swoole\Config;

class Server
{
    protected static $instance;

    protected $swooleServer;

    /*
     * 获取一个服务实例
     * @return Server
     */
    static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new static();
        }
        return self::$instance;
    }

    public function __construct()
    {
        /**
         * 判断实例化  swoole服务 HttpServer &  Server &  WebSocket
         */
        $conf = \Core\Swoole\Config::getInstance();
        if ($conf->getServerType() == \Core\Swoole\Config::SERVER_TYPE_SERVER) {
            $this->swooleServer = new \swooleServer($conf->getListenIp(), $conf->getListenPort(), $conf->getRunMode(), $conf->getSocketType());
        } else if ($conf->getServerType() == \Core\Swoole\Config::SERVER_TYPE_WEB) {
            $this->swooleServer = new \swooleHttpServer($conf->getListenIp(), $conf->getListenPort(), $conf->getRunMode());
        } else if ($conf->getServerType() == \Core\Swoole\Config::SERVER_TYPE_WEB_SOCKET) {
            $this->swooleServer = new \swooleWebSocket();
        } else {
            die('server type error');
        }
        dump($conf->getServerType());
    }
}