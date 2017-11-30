<?php

namespace Lib;


trait Model
{

    public static function systemConstant()
    {
        // 定义当前请求的系统常量
        define('NOW_TIME', $_SERVER['REQUEST_TIME']);
        define('REQUEST_METHOD', $_SERVER['REQUEST_METHOD']);
        define('IS_GET', REQUEST_METHOD == 'GET' ? true : false);
        define('IS_POST', REQUEST_METHOD == 'POST' ? true : false);
        define('IS_PUT', REQUEST_METHOD == 'PUT' ? true : false);
        define('IS_DELETE', REQUEST_METHOD == 'DELETE' ? true : false);
        define('IS_AJAX', isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"]) == "xmlhttprequest" ? true : false);


        /**
         * new swoole_server 构造函数参数
         */
        define('SWOOLE_BASE', 1); //使用Base模式，业务代码在Reactor中直接执行
        define('SWOOLE_THREAD', 2); //使用线程模式，业务代码在Worker线程中执行
        define('SWOOLE_PROCESS', 3); //使用进程模式，业务代码在Worker进程中执行
        define('SWOOLE_PACKET', 0x10);



        /**
         * new swoole_client 构造函数参数
         */
        define('SWOOLE_SOCK_TCP', 1); //创建tcp socket
        define('SWOOLE_SOCK_TCP6', 3); //创建tcp ipv6 socket
        define('SWOOLE_SOCK_UDP', 2); //创建udp socket
        define('SWOOLE_SOCK_UDP6', 4); //创建udp ipv6 socket
        define('SWOOLE_SOCK_UNIX_DGRAM', 5); //创建udp socket
        define('SWOOLE_SOCK_UNIX_STREAM', 6); //创建udp ipv6 socket



        /**
         * new swoole_lock构造函数参数
         */
        define('SWOOLE_FILELOCK', 2); //创建文件锁
        define('SWOOLE_MUTEX', 3); //创建互斥锁
        define('SWOOLE_RWLOCK', 1); //创建读写锁
        define('SWOOLE_SPINLOCK', 5); //创建自旋锁
        define('SWOOLE_SEM', 4); //创建信号量

        define('SWOOLE_EVENT_WRITE', 1);
        define('SWOOLE_EVENT_READ', 2);

        define('SWOOLE_SSLv3_METHOD', 1);
        define('SWOOLE_SSLv3_SERVER_METHOD', 1);
        define('SWOOLE_SSLv3_CLIENT_METHOD', 1);
        define('SWOOLE_SSLv23_METHOD', 1);
        define('SWOOLE_SSLv23_SERVER_METHOD', 1);
        define('SWOOLE_SSLv23_CLIENT_METHOD', 1);
        define('SWOOLE_TLSv1_METHOD', 1);
        define('SWOOLE_TLSv1_SERVER_METHOD', 1);
        define('SWOOLE_TLSv1_CLIENT_METHOD', 1);
        define('SWOOLE_TLSv1_1_METHOD', 1);
        define('SWOOLE_TLSv1_1_SERVER_METHOD', 1);
        define('SWOOLE_TLSv1_1_CLIENT_METHOD', 1);
        define('SWOOLE_TLSv1_2_METHOD', 1);
        define('SWOOLE_TLSv1_2_SERVER_METHOD', 1);
        define('SWOOLE_TLSv1_2_CLIENT_METHOD', 1);
        define('SWOOLE_DTLSv1_METHOD', 1);
        define('SWOOLE_DTLSv1_SERVER_METHOD', 1);
        define('SWOOLE_DTLSv1_CLIENT_METHOD', 1);

        define('WEBSOCKET_OPCODE_TEXT', 0x1);
        define('WEBSOCKET_OPCODE_BINARY', 0x2);

        define('WEBSOCKET_STATUS_CONNECTION', 1);
        define('WEBSOCKET_STATUS_HANDSHAKE', 2);
        define('WEBSOCKET_STATUS_FRAME', 3);
        define('WEBSOCKET_STATUS_ACTIVE', 3);

    }

}