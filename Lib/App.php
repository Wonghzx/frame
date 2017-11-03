<?php

namespace Lib;

class App
{

    use Handler;

    public function run()
    {
        $this->initRoute();
    }
}