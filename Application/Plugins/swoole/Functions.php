<?php
/**
 * Swoole 开发结构
 *
 * Swoole 结构，便于开发过程中查看文档，以及屏蔽IDE undefined 提示，便于快速查看函数用法。
 *
 * 本文件使用方式
 *
 * 普通IDE：
 * 开发Swoole项目同时，在IDE中打开/导入本文件即可。
 * 如果IDE自带 Include Path 功能(如：PhpStorm)，设置该文件路径即可。
 *
 * PhpStorm 另一种方法:
 * WinRAR打开 <Phpstorm_Dir>/plugins/php/lib/php.jar 文件
 * 复制 swoole.php 到路径：com\jetbrains\php\lang\psi\stubs\data\
 * 保存文件，重启Phpstorm.
 *
 * PS:替换前请备份php.jar 若发生错误便于恢复 :)
 *
 *
 */


/**
 * swoole_server_set  [swoole_server_set函数用于设置swoole_server运行时的各项参数]
 * @param $serv
 * @param array $arguments
 * @copyright Copyright (c)
 * @author Wongzx <842687571@qq.com>
 */
function swooleServerSet($serv, array $arguments)
{

}


/**
 * swoole_server_create  [创建一个swoole server资源对象]
 * @param $host   参数用来指定监听的ip地址，如127.0.0.1，或者外网地址，或者0.0.0.0监听全部地址
 * @param $port   监听的端口，如9501，监听小于1024端口需要root权限，如果此端口被占用server-start时会失败
 * @param int $mode 运行的模式，swoole提供了3种运行模式，默认为多进程模式
 * @param int $sock_type 指定socket的类型，支持TCP/UDP、TCP6/UDP64种
 * @copyright Copyright (c)
 * @author Wongzx <842687571@qq.com>
 */
function swooleServerCreate($host, $port, $mode = SWOOLE_PROCESS, $sock_type = SWOOLE_SOCK_TCP)
{

}


/**
 * swoole_server_addlisten  [增加监听的端口]
 *
 * 您可以混合使用UDP/TCP，同时监听内网和外网端口
 * 业务代码中可以通过调用swoole_connection_info来获取某个连接来自于哪个端口
 *
 * @param $serv
 * @param string $host
 * @param int $port
 * @copyright Copyright (c)
 * @author Wongzx <842687571@qq.com>
 */
function swooleServerAddListen($serv, $host = '127.0.0.1', $port = 9502)
{

}


/**
 * swooleServerAddTimer  [设置定时器]
 *
 * 第二个参数是定时器的间隔时间，单位为毫秒。
 * swoole定时器的最小颗粒是1毫秒，支持多个定时器。
 * 此函数可以用于worker进程中。或者通过swoole_server_set设置timer_interval来调整定时器最小间隔。
 *
 * 增加定时器后需要为Server设置onTimer回调函数，否则会造成严重错误。
 * 多个定时器都会回调此函数。
 * 在这个函数内需要自行switch，根据interval的值来判断是来自于哪个定时器。
 *
 * @param $serv
 * @param $interval
 * @copyright Copyright (c)
 * @author Wongzx <842687571@qq.com>
 */
function swooleServerAddTimer($serv, $interval)
{

}


/**
 * swooleServerHandler  [设置Server的事件回调函数]
 *
 * 第一个参数是swoole的资源对象
 * 第二个参数是回调的名称, 大小写不敏感，具体内容参考回调函数列表
 * 第三个函数是回调的PHP函数，可以是字符串，数组，匿名函数。
 *
 * 设置成功后返回true。如果$event_name填写错误将返回false。
 *
 * onConnect/onClose/onReceive 这3个回调函数必须设置，其他事件回调函数可选。
 * 如果设定了timer定时器，onTimer事件回调函数也必须设置
 *
 * @param $serv
 * @param $event_name
 * @param $event_callback_function
 * @copyright Copyright (c)
 * @author Wongzx <842687571@qq.com>
 */
function swooleServerHandler($serv, $event_name, $event_callback_function)
{

}


/**
 * swooleServerStart  [启动server，监听所有TCP/UDP端口]
 *
 *
 * 启动成功后会创建worker_num+2个进程。主进程+Manager进程+n*Worker进程。
 * 启动失败扩展内会抛出致命错误，请检查php error_log的相关信息。errno={number}是标准的Linux Errno，可参考相关文档。
 * 如果开启了log_file设置，信息会打印到指定的Log文件中。
 *
 * 如果想要在开机启动时，自动运行你的Server，可以在/etc/rc.local文件中加入:
 *
 * /usr/bin/php /data/webroot/www.swoole.com/server.php
 *
 * 常见的错误有及拍错方法：
 *
 * 1、bind端口失败,原因是其他进程已占用了此端口
 * 2、未设置必选回调函数，启动失败
 * 3、php有代码致命错误，请检查php的错误信息
 * 4、执行ulimit -c unlimited，打开core dump，查看是否有段错误
 * 5、关闭daemonize，关闭log，使错误信息可以打印到屏幕
 *
 * @param $serv
 * @copyright Copyright (c)
 * @author Wongzx <842687571@qq.com>
 */
function swooleServerStart($serv)
{

}


/**
 * swooleClientSelect  [IO事件循环]
 *
 * swoole_client的并行处理中用了select来做IO事件循环。为什么要用select呢？
 * 因为client一般不会有太多连接，而且大部分socket会很快接收到响应数据。
 * 在少量连接的情况下select比epoll性能更好，另外select更简单。
 *
 * $read,$write,$error分别是可读/可写/错误的文件描述符。
 * 这3个参数必须是数组变量的引用。数组的元素必须为swoole_client对象。
 * $timeout参数是select的超时时间，单位为秒，接受浮点数。
 *
 * 调用成功后，会返回事件的数量，并修改$read/$write/$error数组。
 * 使用foreach遍历数组，然后执行$item->recv/$item->send来收发数据。
 * 或者调用$item->close()或unset($item)来关闭socket。
 *
 * @param array $read 可读
 * @param array $write 可写
 * @param array $error 错误
 * @param $timeout
 * @copyright Copyright (c)
 * @author Wongzx <842687571@qq.com>
 */
function swooleClientSelect(array &$read, array &$write, array &$error, $timeout)
{
}


class swooleServer extends \Plugins\swoole\Server
{

}