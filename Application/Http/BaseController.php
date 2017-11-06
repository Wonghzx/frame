<?php

namespace Application\Http;

use Lib\Database;
use Lib\View;

class BaseController extends Database
{

    public function __construct()
    {
        parent::__construct();

        //初始化
        $this->_initialize();
    }


    public function _initialize()
    {
        $sessionId = $_POST['session_id'];
        if (!empty($sessionId)) {
            session_id($sessionId);
        }
        session_start();
        session('');
    }

    /**
     *[display void]
     * @author  Wongzx <[842687571@qq.com]>
     * @param $path
     * @param array $params
     * @copyright Copyright (c)
     * @return    [type]        [description]
     */
    protected function display($path, array $params)
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