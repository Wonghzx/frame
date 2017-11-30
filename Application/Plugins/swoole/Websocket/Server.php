<?php

namespace Plugins\swoole\Websocket;

/**
 * Class swoole_http_server
 *
 *
 *
 *  内置 Websocket 服务器
 */
class Server extends \Plugins\swoole\Server
{


    /**
     * push  [向某个WebSocket客户端连接推送数据]
     * @param $fd
     * @param $data
     * @param bool $binary_data
     * @param bool $finish
     * @copyright Copyright (c)
     * @author Wongzx <842687571@qq.com>
     */
    public function push($fd, $data, $binary_data = false, $finish = true)
    {
    }

    /**
     * pack  [description]
     * @param $data
     * @param $opcode
     * @param bool $finish
     * @param bool $mask
     * @copyright Copyright (c)
     * @author Wongzx <842687571@qq.com>
     */
    static public function pack($data, $opcode = WEBSOCKET_OPCODE_TEXT, $finish = true, $mask = false)
    {

    }

}