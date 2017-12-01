<?php

namespace Lib;

trait Handler
{
    /**
     *[initRoute 初始化路由]
     * @author  Wongzx <[842687571@qq.com]>
     * @copyright Copyright (c)
     * @return    [type]        [description]
     */
    public function initRoute()
    {
        $routes = require APP_PATH . "Application/Routes/Routes.php";
        $getUri = self::getUri();
        $routes = $this->searchArray($routes, $getUri);
        $dispatcher = \FastRoute\simpleDispatcher(function (\FastRoute\RouteCollector $r) use ($routes, $getUri) {
            $r->addRoute(['GET', 'POST'], '/', 'Application\Http\Index@index');
            $count = count(explode('/', trim($getUri, '/'))); //判断Url 是否 /Index 默认访问
            if ($count == 1) {
                foreach ($routes AS $route) {
                    $counts = strlen($route['controller']);
                    if ($counts == 1) {
                        $route['controller'] = $route['controller'] == '/' ? '/Index' : $route['controller'];
                        $r->addRoute($route[0], $route['controller'], 'Application\Http\Index@index');
                    } else {
                        $r->addRoute($route[0], $route['controller'], 'Application\Http' . str_replace("/", '\\', $route['controller']) . '@index');
                    }
                }
            } else {
                foreach ($routes AS $route) {
                    $route['controller'] = $route['controller'] == '/' ? '/Index' : $route['controller'];
                    $r->addGroup($route['controller'], function (\FastRoute\RouteCollector $r) use ($route) {
                        foreach ($route['action'] AS $item) {
                            $action = substr(strrchr($item, "@"), 1);
                            $r->addRoute($route[0], "/{$action}", $item);
                        }
                    });
                }
            }
        });
        // 获取方法和URI
        $httpMethod = $_SERVER['REQUEST_METHOD'];
        $uri = self::getUri();

        // 条查询字符串 (?foo=bar) 和解码 URI
        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }

        $uri = rawurldecode($uri);
        $routeInfo = $dispatcher->dispatch($httpMethod, $uri);
        switch ($routeInfo[0]) {
            case \FastRoute\Dispatcher::NOT_FOUND:
//                include APP_PATH.'/Public/404.html';
//                echo "404 Not Found ";
                break;
            case \FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
                $allowedMethods = $routeInfo[1];
//                echo "405 Method Not Allowed";
                break;
            case \FastRoute\Dispatcher::FOUND:
                $handler = $routeInfo[1];
                $vars = $routeInfo[2];
                $this->callHandler($handler, $vars);
                break;
        }
    }

    /**
     *[callHandler 调用控制器]
     * @author  Wongzx <[842687571@qq.com]>
     * @param $handler
     * @param $vars
     * @param string $request
     * @param string $response
     * @copyright Copyright (c)
     * @return    [type]        [description]
     */

    private function callHandler($handler, $vars, $request = '', $response = '')
    {
        if (is_string($handler) && (strpos($handler, '@'))) {
            list($class, $method) = explode('@', $handler);
            $class = ucfirst($class) . "Controller";
            return (new $class())->$method($vars);
        }
        return call_user_func($handler, $vars);
    }

    /**
     *[getUri 获取链接]
     * @author  Wongzx <[842687571@qq.com]>
     * @copyright Copyright (c)
     * @return    [type]        [description]
     */

    private static function getUri()
    {
        return $_SERVER['REQUEST_URI'];
    }

    /**
     *[searchArray array]
     * @author  Wongzx <[842687571@qq.com]>
     * @param array $params
     * @param $haystack
     * @copyright Copyright (c)
     * @return    [type]        [description]
     */
    private function searchArray(array $params, $haystack)
    {
        if (false !== $pos = strpos($haystack, '?')) {
            $haystack = substr($haystack, 0, $pos);
        }
        $dat = explode('/', $haystack);
        if (count($dat) >= 3) {
            $haystack = '/' . $dat[1];
        }
        if ($haystack == '/Index') {
            $haystack = '/';
        }
        $data = [];
        foreach ($params AS $item => $value) {
            if ($value['controller'] === $haystack) {
                $data[] = $value;
            }
        }
        return $data;
    }
}