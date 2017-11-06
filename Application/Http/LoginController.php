<?php

namespace Application\Http;

use Application\Server\Swoole;

class LoginController extends BaseController
{

    public function index()
    {
        $sql = " SELECT * FROM user";
        $list = $this->DB()->query($sql)->fetchAll();
        
        $this->display('index', ['aa' => 'ssx']);
    }

    public function User()
    {

        echo 'User/index';
    }

}