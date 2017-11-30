<?php

namespace Plugins\swoole;

/**
 * Class Server
 * @package Plugins\swoole
 */
class Server
{

    /**
     * on  [注册事件回调函数，与swoole_server->on相同。swoole_http_server->on的不同之处是：]
     * swoole_http_server->on不接受onConnect/onReceive回调设置
     * swoole_http_server->on 额外接受1种新的事件类型onRequest
     *
     * 在收到一个完整的Http请求后，会回调此函数。回调函数共有2个参数：
     *
     * $request，Http请求信息对象，包含了header/get/post/cookie等相关信息
     * $response，Http响应对象，支持cookie/header/status等Http操作
     *
     *
     * $response/$request 对象传递给其他函数时，不要加&引用符号
     *
     * @param $event
     * @param $callback
     * @copyright Copyright (c)
     * @author Wongzx <842687571@qq.com>
     */
    public function on($event, $callback)
    {

    }


    /**
     * set  [设置运行时参数]
     *
     * swoole_server->set函数用于设置swoole_server运行时的各项参数。服务器启动后通过$serv->setting来访问set函数设置的参数数组
     *
     * @param array $setting
     * @copyright Copyright (c)
     * @author Wongzx <842687571@qq.com>
     */
    public function set(array $setting)
    {

    }


    /**
     * start  [启动server，监听所有TCP/UDP端口]
     * 启动成功后会创建worker_num+2个进程。主进程+Manager进程+worker_num个Worker进程
     * @copyright Copyright (c)
     * @author Wongzx <842687571@qq.com>
     */
    public function start()
    {

    }


    /**
     * send  [向客户端发送数据]
     *
     ** TCP服务器
     *
     *  操作具有原子性，多个进程同时调用send向同一个连接发送数据，不会发生数据混杂
     *  如果要发送超过2M的数据，可以将数据写入临时文件，然后通过sendfile接口进行发送
     *
     * swoole-1.6以上版本不需要$from_id
     *
     * UDP服务器
     *
     * send操作会直接在worker进程内发送数据包，不会再经过主进程转发
     * 使用fd保存客户端IP，from_id保存from_fd和port
     * 如果在onReceive后立即向客户端发送数据，可以不传$from_id
     * 如果向其他UDP客户端发送数据，必须要传入from_id
     * 在外网服务中发送超过64K的数据会分成多个传输单元进行发送，如果其中一个单元丢包，会导致整个包被丢弃。所以外网服务，建议发送1.5K以下的数据包
     *
     * @param $fd  是TCP客户端连接的标识符，在Server程序中是唯一的
     * @param $data 传输数据
     * @param int $from_id
     * @copyright Copyright (c)
     * @author Wongzx <842687571@qq.com>
     */
    public function send($fd, $data, $from_id = 0)
    {

    }


    /**
     * sendto  [向任意的客户端IP:PORT发送UDP数据包。]
     * @param $ip 为IPv4字符串，如192.168.1.102。如果IP不合法会返回错误
     * @param $port 为 1-65535的网络端口号，如果端口错误发送会失败
     * @param $data 要发送的数据内容，可以是文本或者二进制内容
     * @param bool $ipv6
     * @copyright Copyright (c)
     * @author Wongzx <842687571@qq.com>
     */
    public function sendto($ip, $port, $data, $ipv6 = false)
    {

    }


    /**
     * close  [关闭客户端连接]
     *
     * 操作成功返回true，失败返回false.
     *
     * Server主动close连接，也一样会触发onClose事件。不要在close之后写清理逻辑。应当放置到onClose回调中处理。
     *
     * @param $fd
     * @param int $from_id
     * @copyright Copyright (c)
     * @author Wongzx <842687571@qq.com>
     */
    public function close($fd, $from_id = 0)
    {
    }


}