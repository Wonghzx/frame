<?php

namespace Application\Http;

use Application\Server\Swoole;

class LoginController extends BaseController
{

    public function login()
    {
        $isPOST = $_SERVER['REQUEST_METHOD'];
        if ($isPOST == 'POST') {
            $username = isset($_POST['username']) ? $_POST['username'] : '';
            $password = isset($_POST['password']) ? $_POST['password'] : '';

            $queryBuilder = $this->DB()->createQueryBuilder();
            $a = url_encrypt('123');
            dump($a);die;
            $queryBuilder
                ->select('id','user_name','user_pwd')
                ->from('user')
                ->where('user_name');
        }
        $this->display('login');

    }

    public function User()
    {

        echo 'User/index';
    }

}