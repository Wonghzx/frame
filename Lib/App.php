<?php

namespace Lib;

class App
{

    use Handler;

    /**
     *[run void]
     * @author  Wongzx <[842687571@qq.com]>
     * @copyright Copyright (c)
     * @return    [type]        [description]
     */
    public function run()
    {
        $this->initRoute();
    }
}