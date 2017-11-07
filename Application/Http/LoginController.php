<?php

namespace Application\Http;

use Application\Server\Swoole;

class LoginController extends BaseController
{

    public function login()
    {
        $sql = " SELECT * FROM user";
        $list = $this->DB()->query($sql)->fetchAll();
        
        $this->display('login');
    }

    public function User()
    {

        echo 'User/index';
    }

}