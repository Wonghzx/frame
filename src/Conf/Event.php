<?php

namespace Conf;

class Event extends \Core\AbstractInterface\AbstractEvent
{

    /**
     * frameInitialize  [框架初始化接口]
     * @copyright Copyright (c)
     * @author Wongzx <842687571@qq.com>
     * @return mixed
     */
    function frameInitialize()
    {
        // TODO: Implement frameInitialize() method.
        date_default_timezone_set('Asia/Shanghai');
    }

    /**
     * frameInitialized  [框架初始化]
     * @copyright Copyright (c)
     * @author Wongzx <842687571@qq.com>
     * @return mixed
     */
    function frameInitialized()
    {
        // TODO: Implement frameInitialized() method.
    }
}