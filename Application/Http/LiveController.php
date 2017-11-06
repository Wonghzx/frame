<?php

namespace Application\Http;

class LiveController extends BaseController
{
    public function index()
    {
        $this->display('index', ['aa' => 'ssx']);
    }
}