<?php

if (!function_exists('session')) {
    /**
     * callback: getId createNamespace get getAll set  destroy
     * session  [session 管理函数]
     * @param string $name
     * @param string $value
     * @copyright Copyright (c)
     * @author Wongzx <842687571@qq.com>
     */
    function session($name = '', $value = '', $sessionName = 'USERSESSION')
    {
        static $sessionMap = [];
        $namespaceClass = [
            'sessionInstance' => 'duncan3dc\\Sessions\\SessionInstance',
            'session' => 'duncan3dc\\Sessions\\Session',
            'cookie' => 'duncan3dc\\Sessions\\Cookie',
        ];
        $sessionNames = 'session';
        if (!isset($sessionMap[$sessionNames])) {
            $sessionMap[$sessionNames] = new  $namespaceClass['sessionInstance']($sessionName);
        }

        if (!is_callable($name)) {
            if (!empty($name) && !empty($value)) {
                return $sessionMap[$sessionNames]->set($name, $value);
            } else if (!empty($name)) {
                return $sessionMap[$sessionNames]->get($name);
            } else {
                return $sessionMap[$sessionNames];
            }
        } else {
            $name($sessionMap[$sessionNames]);
        }

    }
}

if (!function_exists('db')) {
    /**
     * db  [数据库操作]
     * @copyright Copyright (c)
     * @author Wongzx <842687571@qq.com>
     * @return mixed
     */
    function db()
    {
        $config = \Lib\App::getContainer();
        static $_model = [];
        $guid = 'model';
        if (!isset($_model[$guid]))
            $_model[$guid] = new \Lib\Database($config['config']['medoo']);
        return $_model[$guid]->db;
    }
}

if (!function_exists('output')) {

    /**
     * 比较标准的接口输出函数
     * @param string $message 消息
     * @param integer $code 接口错误码，很关键的参数
     * @param array $data 附加数据
     * $param string  $location 重定向
     * @return array
     */
    function output(array $data = [], $code = 200, $message = '', $location = '')
    {
        if (empty($message))
            $message = '消息';

        foreach ($data AS $item => $value) {
            if (is_null($value))
                $data[$item] = '';
        }

        $map = [
            'code' => $code,
            'message' => $message,
            'session_id' => session()->getId(),
            'location' => $location,
            'data' => []
        ];
        $map['data'] = array_merge($map['data'], $data);
        $map = json_encode($map);
        return $map;

    }

}
