<?php

namespace Application\Http;

use Application\Server\Swoole;

class IndexController extends BaseController
{

    public function index()
    {
        echo 123;
//        $this->display('index', ['aa' => 'ssx']);
    }

    public function User()
    {

        echo 'User/index';
    }
}