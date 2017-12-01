<?php

namespace Lib;

use Latte\Engine;

class View
{

    const VIEW_BASE_PATH = APP_PATH . 'Application/View/';

    const CACHE_BASE_PATH = APP_PATH . 'Runtime/Cache';

    private static $data = [];

    private static $view;


    /**
     *[make void]
     * @author  Wongzx <[842687571@qq.com]>
     * @copyright Copyright (c)
     * @return    [type]        [description]
     */
    public function make($viewName = '')
    {

        if (!$viewName) {
            throw new \Exception('视图名称不能为空！');
        } else {
            self::$view = $viewName;
        }
        return $this;
    }


    /**
     *[with 写入视图参数]
     * @author  Wongzx <[842687571@qq.com]>
     * @copyright Copyright (c)
     * @return    [type]        [description]
     */
    public function with(array $params)
    {
        self::$data = $params;
        return $this;
    }

    /**
     *[getViewName 获取视图名称]
     * @author  Wongzx <[842687571@qq.com]>
     * @copyright Copyright (c)
     * @return    [type]        [description]
     */
    private static function getViewName($viewName)
    {
        $filePath = str_replace('.', '/', $viewName);
        $fileName = App::getConfig('default_module') . '/' . Functions::getClassName() . '/' . $filePath . '.html';
        if (file_exists(self::VIEW_BASE_PATH . $fileName)) {
            return $fileName;
        } else {
//            throw new \Exception('404');
            include APP_PATH.'/Public/404.html';
        }
    }

    function __destruct()
    {
        $latte = new Engine();
        $latte->setTempDirectory(self::CACHE_BASE_PATH);
        $viewFilePath = self::getViewName(self::$view);
        $latte->render(self::VIEW_BASE_PATH . $viewFilePath, self::$data);
    }
}
