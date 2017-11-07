<?php

namespace Application\Http;


class IndexController extends BaseController
{

    private $uid;

    public function __construct()
    {
        parent::__construct();
        $session = isset($_SESSION['userInfo']);
        if ($session == false) {
            header('Location: /Login/login');
            exit();
        }
        $this->uid = $_SESSION['userInfo']['id'];
    }

    public function index()
    {
        $sql = " SELECT * FROM groups WHERE id = 1";
        $group = $this->DB()->query($sql)->fetch();

        $users = explode(',', $group['users']);

        $isGroup = array_search($this->uid, $users);
        if ($isGroup === false) {
            return;
        }
        unset($users[$isGroup]);
        $users = implode(',', $users);
        $res = [
            'group' => $group,
            'userId' => $this->uid,
            'tid' => $users,
            'groups' => $group['id']
        ];

        $this->display('index', $res);
    }

    public function User()
    {

        echo 'User/index';
    }

}