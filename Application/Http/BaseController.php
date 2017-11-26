<?php

namespace Application\Http;

use Lib\App;

class BaseController
{
    protected $container;

    protected $database;

    public function __construct()
    {
        $this->container = App::getContainer();
        $this->_initialize();
    }


    private function _initialize()
    {

//        session_start();
        $isMobile = isMobile();
        if ($isMobile) {
            $this->container['config']['default']['default_module'] = 'Mobile';
        }

    }

    /**
     *[display void]
     * @author  Wongzx <[842687571@qq.com]>
     * @param $path
     * @param array $params
     * @copyright Copyright (c)
     * @return    [type]        [description]
     */
    protected function display($path, array $params = [])
    {
        $this->container['view']->make($path)->with($params);
    }

    /**
     *[DB \Doctrine\DBAL\Connection]
     * @author  Wongzx <[842687571@qq.com]>
     * @copyright Copyright (c)
     * @return    [type]        [description]
     */
    protected function db()
    {
        return $this->container['dataBase'];
    }


    /**
     *[session session会话]
     * @author  Wongzx <[842687571@qq.com]>
     * @copyright Copyright (c)
     * @return    [type]        [description]
     */
    protected function session()
    {
        return $this->container['session'];
    }


}