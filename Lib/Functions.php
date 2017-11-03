<?php

namespace Lib;

class Functions
{

    /**
     *[getClassName 获取URl访问控制器]
     * @author  Wongzx <[842687571@qq.com]>
     * @copyright Copyright (c)
     * @return    [type]        [description]
     */
    public static function getClassName()
    {
        if (isset($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] != '/') {
            $path = $_SERVER['REQUEST_URI'];
            $pathArr = explode('/', trim($path, '/'));
            if (false !== $pos = strpos($pathArr[0], '?')) {
                $pathArr = substr($pathArr[0], 0, $pos);
            }
            return $pathArr;
        } else {
            return 'Index';
        }
    }
}