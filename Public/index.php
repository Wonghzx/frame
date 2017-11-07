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
} else {
    ini_set("display_errors", "Off");
}

$app = new \Lib\App();
$app->run();