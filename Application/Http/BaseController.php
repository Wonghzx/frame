<?php

namespace Application\Http;

use Lib\App;
use Lib\Configs;
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

//        session_start();
//        $isMobile = $this->isMobile();
//        if ($isMobile) {
           $a =  App::getContainer();
           $a['config'] = function ($c) {
               $a = new $c['config'];
               dump($a);
//                return new $c['default_application']($c['wbc']);
            };
//        }
        dump($a['config']);
        die;
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
//        return Database::initialization();
    }


    /**
     *[isMobile 判断是否 移动端 OR PC]
     * @author  Wongzx <[842687571@qq.com]>
     * @copyright Copyright (c)
     * @return    [type]        [description]
     */
    private function isMobile()
    {
        $agent = strtolower($_SERVER['HTTP_USER_AGENT']);
        $is_pc = (strpos($agent, 'windows nt')) ? true : false;
        $is_mac = (strpos($agent, 'mac os')) ? true : false;
        $is_iphone = (strpos($agent, 'iphone')) ? true : false;
        $is_android = (strpos($agent, 'android')) ? true : false;
        $is_ipad = (strpos($agent, 'ipad')) ? true : false;

        if ($is_pc) {
            return false;
        }

        if ($is_mac) {
            return true;
        }

        if ($is_iphone) {
            return true;
        }

        if ($is_android) {
            return true;
        }

        if ($is_ipad) {
            return true;
        }
    }
}