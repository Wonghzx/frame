<?php

namespace Lib\Configs;

class db
{
    public static $type = \Swoole\Database::TYPE_MYSQLi;

    public static $host = '127.0.0.1';

    public static $port = '3306';

    public static $name = 'swoole';

    public static $user = 'root';

    public static $pwd = '123456';

    public static $dbms = 'mysql';

    public static $engine = 'MyISAM';

    public static $charset = 'utf8';

    public static $setName = true;
}