<?php

namespace Application\Http;

use Lib\App;
use Lib\View;

class BaseController
{

    protected $container;

    protected $database;

    public function __construct()
    {
        $this->container = App::getContainer();
        dump($this->container['config']);die;
        $this->_initialize();
    }


    private function _initialize()
    {

//        session_start();
        $isMobile = isMobile();
        if ($isMobile) {
            $this->container['config']['default_module'] = 'Mobile';
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
        $make = new View();
        $make->make($path)->with($params);
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


}