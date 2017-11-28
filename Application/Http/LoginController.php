<?php

namespace Application\Http;


class LoginController extends BaseController
{

    public function login()
    {
        $isPOST = $_SERVER['REQUEST_METHOD'];
        if ($isPOST == 'POST') {
            $username = isset($_POST['username']) ? $_POST['username'] : '';
            $password = isset($_POST['password']) ? $_POST['password'] : '';

            $password = url_encrypt($password, 'password');
            $sql = " SELECT id,user_name,user_pwd,user_photo FROM user WHERE user_name = '{$username}' AND user_pwd = '{$password}' ";
            $userInfo = $this->DB()->query($sql)->fetch();
            if (!empty($userInfo)) {
                session('userInfo', $userInfo);
//                $_SESSION['userInfo'] = $userInfo;
                header('Location: /Index/index');
            }
        }
        $this->display('login');

    }

    public function signOut()
    {

        session(function ($s) {
            $s->destroy();
            header('Location: /Index/index');
        });
    }


}