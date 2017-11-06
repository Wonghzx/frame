<?php

namespace Application\Http;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends BaseController
{
    public function index()
    {
        self::makeFile('/index',['1' => '1']);
    }


}