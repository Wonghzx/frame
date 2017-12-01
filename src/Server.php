#!/usr/bin/env php
<?php
/**
 * Created by PhpStorm.
 * User: Wongzx
 * Date: 2017/12/1/001
 * Time: 14:35
 */

////////////////////////////////////////////////////////////////////
//                          _ooOoo_                               //
//                         o8888888o                              //
//                         88" . "88                              //
//                         (| ^_^ |)                              //
//                         O\  =  /O                              //
//                      ____/`---'\____                           //
//                    .'  \\|     |//  `.                         //
//                   /  \\|||  :  |||//  \                        //
//                  /  _||||| -:- |||||-  \                       //
//                  |   | \\\  -  /// |   |                       //
//                  | \_|  ''\---/''  |   |                       //
//                  \  .-\__  `-`  ___/-. /                       //
//                ___`. .'  /--.--\  `. . ___                     //
//            \  \ `-.   \_ __\ /__ _/   .-` /  /                 //
//      ========`-.____`-.___\_____/___.-`____.-'========         //
//                           `=---='                              //
//      ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^        //
//         佛祖保佑            永无BUG       永不修改                 //
////////////////////////////////////////////////////////////////////


require_once 'Core/Core.php';
$server = \Core\Core::getInstance()->frameWorkInitialize();
/**
 * commandParser  [命令分析器]
 * @copyright Copyright (c)
 * @author Wongzx <842687571@qq.com>
 */
function commandParser()
{
    global $argv;
    $command = '';
    $options = [];

    if ($argv[1])
        $command = $argv[1];

    foreach ($argv AS $item => $value) {
        if (substr($value, 0, 2) === '--') {
            $temp = trim($value, "--");
            $temp = explode("-", $temp);
            $key = array_shift($temp);
            $options[$key] = array_shift($temp) ?: '';
        }
        return [
            "command" => $command,
            "options" => $options
        ];
    }
}


/**
 * commandHandler  [命令处理程序]
 * @copyright Copyright (c)
 * @author Wongzx <842687571@qq.com>
 */
function commandHandler()
{
    $command = commandParser();
    switch ($command['command']) {
        case 'start':  //开启
            startServer($command['options']);
            break;
        case 'reload'; //重启

            break;
        case 'stop';   //暂停

            break;
    }
}


/**
 * startServer  [开启程序]
 * @param $options
 * @copyright Copyright (c)
 * @author Wongzx <842687571@qq.com>
 */
function startServer($options)
{
    require __DIR__ . '/../vendor/autoload.php';
    $log = <<<LOG
         ██▓     █    ██     ▄▄▄▄    ██▓▄▄▄█████▓ ▄████▄   ██░ ██ 
▓██▒     ██  ▓██▒   ▓█████▄ ▓██▒▓  ██▒ ▓▒▒██▀ ▀█  ▓██░ ██▒
▒██░    ▓██  ▒██░   ▒██▒ ▄██▒██▒▒ ▓██░ ▒░▒▓█    ▄ ▒██▀▀██░
▒██░    ▓▓█  ░██░   ▒██░█▀  ░██░░ ▓██▓ ░ ▒▓▓▄ ▄██▒░▓█ ░██ 
░██████▒▒▒█████▓    ░▓█  ▀█▓░██░  ▒██▒ ░ ▒ ▓███▀ ░░▓█▒░██▓
░ ▒░▓  ░░▒▓▒ ▒ ▒    ░▒▓███▀▒░▓    ▒ ░░   ░ ░▒ ▒  ░ ▒ ░░▒░▒
░ ░ ▒  ░░░▒░ ░ ░    ▒░▒   ░  ▒ ░    ░      ░  ▒    ▒ ░▒░ ░
  ░ ░    ░░░ ░ ░     ░    ░  ▒ ░  ░      ░         ░  ░░ ░
    ░  ░   ░         ░       ░           ░ ░       ░  ░  ░
                          ░              ░                
LOG;
    echo $log . "\n";
    opCacheClear();
    global $server;
    $conf = \Conf\Config::getInstance();


    //ip
    if (isset($options['ip'])) {
        $conf->setConf("SERVER.LISTEN", $options['ip']);
    }
    echo 'listen address       ' . $conf->getConf('SERVER.LISTEN') . "\n";

    //port
    if (!empty($options['p'])) {
        $conf->setConf("SERVER.PORT", $options['p']);
    }
    echo 'listen port          ' . $conf->getConf('SERVER.PORT') . "\n";

    //pid
    if (!empty($options['pid'])) {
        $pidFile = $options['pid'];
        \Conf\Config::getInstance()->setConf("SERVER.CONFIG.pid_file", $pidFile);
    }

    //线程数
    if (isset($options['workerNum'])) {
        $conf->setConf("SERVER.CONFIG.worker_num", $options['workerNum']);
    }
    echo 'worker num           ' . $conf->getConf('SERVER.CONFIG.worker_num') . "\n";

    //任务线程数
    if (isset($options['taskWorkerNum'])) {
        $conf->setConf("SERVER.CONFIG.task_worker_num", $options['taskWorkerNum']);
    }
    echo 'task worker num      ' . $conf->getConf('SERVER.CONFIG.task_worker_num') . "\n";

    //用户
    if (isset($options['user'])) {
        $conf->setConf("SERVER.CONFIG.user", $options['user']);
    }
    echo 'user             ' . $conf->getConf('SERVER.CONFIG.user') . "\n";

    //群组
    if (isset($options['group'])) {
        $conf->setConf("SERVER.CONFIG.group", $options['group']);
    }
    echo 'user group            ' . $conf->getConf('SERVER.CONFIG.group') . "\n";

    $label = 'false';
    if (isset($options['d'])) {
        $conf->setConf("SERVER.CONFIG.daemonize", true);
        $label = 'true';
    } else {
        \Conf\Config::getInstance()->setConf("SERVER.CONFIG.pid_file", null);
    }
    echo "daemonize            {$label} \n";


    $label = 'false';
    if ($conf->getConf('DEBUG.ENABLE')) {
        $label = 'true';
    }
    echo 'debug enable         ' . $label . "\n";

    $label = 'false';
    if ($conf->getConf('DEBUG.LOG')) {
        $label = 'true';
    }
    echo 'debug log error      ' . $label . "\n";


    $label = 'false';
    if ($conf->getConf('DEBUG.DISPLAY_ERROR')) {
        $label = 'true';
    }

    echo 'debug display error  '.$label."\n";
    echo 'swoole version       '.phpversion('swoole')."\n";
//    echo 'easyswoole version   '.\Core\Component\Di::getInstance()->get(Core\Component\SysConst::VERSION)."\n";
    $server->run();

}


/**
 * opCacheClear  [apc_clear_cache — 清除APC缓存 & opcache_reset — 重置字节码缓存的内容]
 * @copyright Copyright (c)
 * @author Wongzx <842687571@qq.com>
 */
function opCacheClear()
{
    if (function_exists('apc_clear_cache')) {
        apc_clear_cache();
    }
    if (function_exists('opcache_reset')) {
        opcache_reset();
    }
}


commandHandler();