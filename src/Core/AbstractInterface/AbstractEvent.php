<?php

namespace Core\AbstractInterface;
/**
 * 抽象列接口
 * Class AbstractEvent
 */
abstract class AbstractEvent
{
    protected static $instance;

    static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new static();
        }
        return self::$instance;
    }

    /**
     * frameInitialize  [框架初始化接口]
     * @copyright Copyright (c)
     * @author Wongzx <842687571@qq.com>
     * @return mixed
     */
    abstract function frameInitialize();


    /**
     * frameInitialized  [框架初始化]
     * @copyright Copyright (c)
     * @author Wongzx <842687571@qq.com>
     * @return mixed
     */
    abstract function frameInitialized();
}