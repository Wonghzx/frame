<?php

namespace Application\Http;


class LoginController extends BaseController
{

    public function login()
    {

        if (IS_POST) {
            $username = isset($_POST['username']) ? $_POST['username'] : '';
            $password = isset($_POST['password']) ? $_POST['password'] : '';
            $password = url_encrypt($password, 'password');

            if ($this->database->has('user', [
                'AND' => [
                    'OR' => [
                        'user_name' => $username,
                    ],
                    'user_pwd' => $password
                ],
            ])) {
                $userInfo = $this->database->get('user', ['id', 'user_name', 'user_pwd', 'user_photo'], [
                    'user_name' => $username, 'user_pwd' => $password
                ]);

                if (!empty($userInfo)) {
                    session('userInfo', $userInfo);
                    header('Location: /Index/index');
                }
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