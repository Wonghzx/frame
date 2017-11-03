<?php

namespace Application\Http;

use Lib\View;

class BaseController
{

    /**
     *[makeFile 加载视图]
     * @author  Wongzx <[842687571@qq.com]>
     * @param $path
     * @param array $params
     * @copyright Copyright (c)
     * @return    [type]        [description]
     */
    protected  function makeFile($path, array $params)
    {
        $make = new View();
        $make->make($path)->with($params);
    }
}