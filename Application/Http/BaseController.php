<?php

namespace Application\Http;

use Lib\App;
use Lib\Configs;
use Lib\Database;
use Lib\View;

class BaseController extends Database
{

    protected $container;

    public function __construct()
    {
        $this->container = App::getContainer();
        $this->_initialize();
    }


    public function _initialize()
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
    protected function DB()
    {
        return Database::initialization();
    }



}