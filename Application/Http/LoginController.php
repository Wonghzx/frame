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
            $sql = " SELECT id,user_name,user_pwd FROM user WHERE user_name = '{$username}' AND user_pwd = '{$password}' ";
            $userInfo = $this->DB()->query($sql)->fetch();
            if (!empty($userInfo)) {
                $_SESSION['userInfo'] = $userInfo;
                header('Location: /Index/index');
            }
        }
        $this->display('login', ['abc' => '123']);

    }

    public function signOut()
    {
        session_destroy();
        header('Location: /Index/index');
    }


}