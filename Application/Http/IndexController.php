<?php

namespace Application\Http;

class IndexController extends BaseController
{

    private $uid;

    public function __construct()
    {
        parent::__construct();
        $session = session('userInfo');
        if (empty($session)) {
            header('Location: /Login/login');
            exit();
        }

        $this->uid = $session['id'];

    }

    public function index()
    {
        dump(output(['asd'=>'中文']));
        die;
        $group = $this->database->get('groups', ['id', 'users'], ['id' => 1]);

        $userInfo = $this->database->select('user', ['id', 'user_name', 'user_pwd', 'user_nickname', 'user_photo']);

        $users = explode(',', $group['users']);

        $isGroup = array_search($this->uid, $users);
        if ($isGroup === false) {
            throw new \Exception('账号未登录，请前往登录！');
        }
        unset($users[$isGroup]);
        $users = implode(',', $users);
        $res = [
            'group' => $group,
            'userId' => $this->uid,
            'tid' => $users,
            'groups' => $group['id'],
            'user' => $userInfo,
            'userInfo' => session('userInfo'),
        ];
        $this->display('index', $res);
    }


    public function checkChatInformation()
    {

    }

}