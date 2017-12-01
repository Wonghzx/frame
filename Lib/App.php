<?php



//============================当你妹的程序员啊======================
//		                               .. .vr
//		                             qBMBBBMBMY
//		                            8BBBBBOBMBMv
//		                          iMBMM5vOY:BMBBv
//		          .r,             OBM;   .: rBBBBBY
//		          vUL             7BB   .;7. LBMMBBM.
//		         .@Wwz.           :uvir .i:.iLMOMOBM..
//		          vv::r;             iY. ...rv,@arqiao.
//		           Li. i:             v:.::::7vOBBMBL..
//		           ,i7: vSUi,         :M7.:.,:u08OP. .
//		             .N2k5u1ju7,..     BMGiiL7   ,i,i.
//		              :rLjFYjvjLY7r::.  ;v  vr... rE8q;.:,,
//		             751jSLXPFu5uU@guohezou.,1vjY2E8@Yizero.
//		             BB:FMu rkM8Eq0PFjF15FZ0Xu15F25uuLuu25Gi.
//		           ivSvvXL    :v58ZOGZXF2UUkFSFkU1u125uUJUUZ,
//		         :@kevensun.      ,iY20GOXSUXkSuS2F5XXkUX5SEv.
//		     .:i0BMBMBBOOBMUi;,        ,;8PkFP5NkPXkFqPEqqkZu.
//		   .rqMqBBMOMMBMBBBM .           @kexianli.S11kFSU5q5
//		 .7BBOi1L1MM8BBBOMBB..,          8kqS52XkkU1Uqkk1kUEJ
//		 .;MBZ;iiMBMBMMOBBBu ,           1OkS1F1X5kPP112F51kU
//		   .rPY  OMBMBBBMBB2 ,.          rME5SSSFk1XPqFNkSUPZ,.
//		          ;;JuBML::r:.:.,,        SZPX0SXSP5kXGNP15UBr.
//		              L,    :@huhao.      :MNZqNXqSqXk2E0PSXPE .
//		          viLBX.,,v8Bj. i:r7:,     2Zkqq0XXSNN0NOXXSXOU
//		        :r2. rMBGBMGi .7Y, 1i::i   vO0PMNNSXXEqP@Secbone.
//		        .i1r. .jkY,    vE. iY....  20Fq0q5X5F1S2F22uuv1M;
//============================当你妹的程序员啊======================


namespace Lib;
include_once APP_PATH . 'Lib/Common/Function.php';

use Pimple\Container;
use Noodlehaus\Config;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class App
{
    use Handler, Model;

    protected static $container;

    /**
     *[run Run]
     * @author  Wongzx <[842687571@qq.com]>
     * @copyright Copyright (c)
     * @return    [type]        [description]
     */
    public function run()
    {
        //系统常量
        self::systemConstant();

        //加载容器
        $this->initContainer();

        //加载路由
        $this->initRoute();


    }

    /**
     * initContainer  [初始化容器]
     * @copyright Copyright (c)
     * @author Wongzx <842687571@qq.com>
     */
    public static function initContainer()
    {
        //实例化容器对象
        self::$container = new Container();

        //载入我们的config文件
        $config = Config::load(APP_PATH . "Application/Configs");

        //注入到容器，下次可以直接使用
        self::$container['config'] = $config;

        //数据库
//        $db = new Database([
//            'dbname' => $config['doctrine']['dbal']['db_name'],
//            'user' => $config['doctrine']['dbal']['db_user'],
//            'password' => $config['doctrine']['dbal']['db_pwd'],
//            'host' => $config['doctrine']['dbal']['db_host'],
//            'driver' => $config['doctrine']['dbal']['db_driver'],
//            'port' => $config['doctrine']['dbal']['db_port'],
//            'charset' => $config['doctrine']['dbal']['db_charset'],
//        ]);
        $db = new Database($config->get('medoo'));
        self::$container['dataBase'] = $db->db;


        //初始化视图
        $view = new View();
        self::$container['view'] = $view;

        //日志服务代码如下，我们使用config作为闭包的参数传进去
//        $container['logger'] = function () use ($config) {
//        };
        $logger = new Logger($config->get('app_name'));
        $logger->pushHandler(new StreamHandler(APP_PATH . $config->get('log_file'), Logger::WARNING));

        self::$container['logger'] = $logger;
    }

    /**
     * getContainer  [得到容器加载应用]
     * @copyright Copyright (c)
     * @author Wongzx <842687571@qq.com>
     * @return mixed
     */
    public static function getContainer()
    {
        return self::$container;
    }

    /**
     * getLogger  [description]
     * @copyright Copyright (c)
     * @author Wongzx <842687571@qq.com>
     */
    public static function getLogger()
    {
        return self::$container['logger'];
    }

    /**
     * getConfig  [description]
     * @author Wongzx <842687571@qq.com>
     * @param $configName
     * @param string $default
     * @copyright Copyright (c)
     * @return mixed
     */
    public static function getConfig($configName, $default = 'default')
    {
        return self::$container['config'][$default][$configName];
    }

    /**
     *[getDatabase mixed]
     * @author  Wongzx <[842687571@qq.com]>
     * @copyright Copyright (c)
     * @return    [type]        [description]
     */
    public function getDatabase()
    {
        return self::$container['dataBase'];
    }

}