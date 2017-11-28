<?php

/**
 * /vendor/autoload.php是Composer工具生成的
 * shell: composer update
 */
require __DIR__ . '/../vendor/autoload.php';

define('ROOT_PATH', __DIR__);
define('APP_PATH', __DIR__ . "/../");
define('DEBUGS', true);//开启错误提示

if (DEBUGS) {
    $whoops = new \Whoops\Run;
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
    $whoops->register();
    ini_set("display_errors","On");
} else {
    ini_set("display_errors", "Off");
}

include_once APP_PATH . 'Application/Common/Function.php';

$app = new \Lib\App();
$app->run();