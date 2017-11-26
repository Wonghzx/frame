<?php

namespace Application\Http;

class IndexController extends BaseController
{

    private $uid;

    public function __construct()
    {
        parent::__construct();
        $session = new SessionInstance("my-app");
        Session::name('my-apsp');
//        dump(Session::getAll());die;
        $sessions = $session->get('userInfo');
//        dump($session->getFlash('id'));die;
        if (empty($sessions)) {
            header('Location: /Login/login');
            exit();
        }

//        $this->uid = $_SESSION['userInfo']['id'];
    }

    public function index()
    {
        $sql = " SELECT * FROM groups WHERE id = 1";
        $group = $this->db()->query($sql)->fetch();

        $sql = " SELECT * FROM user  ";
        $userInfo = $this->db()->query($sql)->fetchAll();


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
            'userInfo' => $_SESSION['userInfo'],
        ];
        $this->display('index', $res);
    }


    public function checkChatInformation()
    {

    }

}