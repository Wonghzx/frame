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

        $namespaceClass = [
            'sessionInstance' => 'duncan3dc\\Sessions\\SessionInstance',
            'session' => 'duncan3dc\\Sessions\\Session',
            'cookie' => 'duncan3dc\\Sessions\\Cookie',
        ];

        $collector = new  $namespaceClass['sessionInstance']($sessionName);
        if (!is_callable($name)) {
            if (!empty($name) && !empty($value)) {
                return $collector->set($name, $value);
            } else if (!empty($name)) {
                return $collector->get($name);
            }
        } else {
            $name($collector);
        }

    }
}
