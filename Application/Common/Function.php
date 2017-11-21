<?php

/**
 * 公共方法文件 helpFunction
 */

/**
 * 系统加密方法
 * @param string $data 要加密的字符串
 * @param string $key 加密密钥
 * @param int $expire 过期时间 单位 秒
 * return string
 * @author Wongzx <842687571@.qq.com>
 */
function url_encrypt($data, $key = '', $expire = 0)
{
    $key = md5(empty($key) ? 'Want to crack? I asked' : $key);
    $data = base64_encode($data);
    $x = 0;
    $len = strlen($data);
    $l = strlen($key);
    $char = '';
    for ($i = 0; $i < $len; $i++) {
        if ($x == $l) $x = 0;
        $char .= substr($key, $x, 1);
        $x++;
    }
    $str = sprintf('%010d', $expire ? $expire + time() : 0);
    for ($i = 0; $i < $len; $i++) {
        $str .= chr(ord(substr($data, $i, 1)) + (ord(substr($char, $i, 1))) % 256);
    }
    return str_replace(array('+', '/', '='), array('-', '_', ''), base64_encode($str));
}

/**
 * 系统解密方法
 * @param  string $data 要解密的字符串 （必须是think_encrypt方法加密的字符串）
 * @param  string $key 加密密钥
 * return string
 * @author Wongzx <842687571@qq.com>
 */
function url_decrypt($data, $key = '')
{
    $key = md5(empty($key) ? 'Want to crack? I asked' : $key);
    $data = str_replace(array('-', '_'), array('+', '/'), $data);
    $mod4 = strlen($data) % 4;
    if ($mod4) {
        $data .= substr('====', $mod4);
    }
    $data = base64_decode($data);
    $expire = substr($data, 0, 10);
    $data = substr($data, 10);
    if ($expire > 0 && $expire < time()) {
        return '';
    }
    $x = 0;
    $len = strlen($data);
    $l = strlen($key);
    $char = $str = '';
    for ($i = 0; $i < $len; $i++) {
        if ($x == $l) $x = 0;
        $char .= substr($key, $x, 1);
        $x++;
    }
    for ($i = 0; $i < $len; $i++) {
        if (ord(substr($data, $i, 1)) < ord(substr($char, $i, 1))) {
            $str .= chr((ord(substr($data, $i, 1)) + 256) - ord(substr($char, $i, 1)));
        } else {
            $str .= chr(ord(substr($data, $i, 1)) - ord(substr($char, $i, 1)));
        }
    }
    return base64_decode($str);
}

/**
 *[getCurl mixed]
 * @author  Wongzx <[842687571@qq.com]>
 * @param $url
 * @param array $params
 * @param int $timeOut
 * @copyright Copyright (c)
 * @return    [type]        [description]
 */
function getCurl($url, array $params, $timeOut = 300)
{
    $flag = (strpos($url, '?') !== false) ? '&' : '?';
    $query = http_build_query($params);
    $url = $url . $flag . $query;
    //初始化curl
    $ch = curl_init();
    //设置超时
    curl_setopt($ch, CURLOPT_TIMEOUT, $timeOut);
    //设置选项，包括URL
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $return = curl_exec($ch);
    curl_close($ch);
    return $return;
}

/**
 *[isMobile 判断是否 移动端 OR PC]
 * @author  Wongzx <[842687571@qq.com]>
 * @copyright Copyright (c)
 * @return    [type]        [description]
 */
function isMobile()
{
    $_SERVER['ALL_HTTP'] = isset($_SERVER['ALL_HTTP']) ? $_SERVER['ALL_HTTP'] : '';
    $mobile_browser = '0';
    if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|iphone|ipad|ipod|android|xoom)/i', strtolower($_SERVER['HTTP_USER_AGENT'])))
        $mobile_browser++;
    if ((isset($_SERVER['HTTP_ACCEPT'])) and (strpos(strtolower($_SERVER['HTTP_ACCEPT']), 'application/vnd.wap.xhtml+xml') !== false))
        $mobile_browser++;
    if (isset($_SERVER['HTTP_X_WAP_PROFILE']))
        $mobile_browser++;
    if (isset($_SERVER['HTTP_PROFILE']))
        $mobile_browser++;
    $mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'], 0, 4));
    $mobile_agents = array(
        'w3c ', 'acs-', 'alav', 'alca', 'amoi', 'audi', 'avan', 'benq', 'bird', 'blac',
        'blaz', 'brew', 'cell', 'cldc', 'cmd-', 'dang', 'doco', 'eric', 'hipt', 'inno',
        'ipaq', 'java', 'jigs', 'kddi', 'keji', 'leno', 'lg-c', 'lg-d', 'lg-g', 'lge-',
        'maui', 'maxo', 'midp', 'mits', 'mmef', 'mobi', 'mot-', 'moto', 'mwbp', 'nec-',
        'newt', 'noki', 'oper', 'palm', 'pana', 'pant', 'phil', 'play', 'port', 'prox',
        'qwap', 'sage', 'sams', 'sany', 'sch-', 'sec-', 'send', 'seri', 'sgh-', 'shar',
        'sie-', 'siem', 'smal', 'smar', 'sony', 'sph-', 'symb', 't-mo', 'teli', 'tim-',
        'tosh', 'tsm-', 'upg1', 'upsi', 'vk-v', 'voda', 'wap-', 'wapa', 'wapi', 'wapp',
        'wapr', 'webc', 'winw', 'winw', 'xda', 'xda-'
    );
    if (in_array($mobile_ua, $mobile_agents))
        $mobile_browser++;
    if (strpos(strtolower($_SERVER['ALL_HTTP']), 'operamini') !== false)
        $mobile_browser++;
    // Pre-final check to reset everything if the user is on Windows
    if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows') !== false)
        $mobile_browser = 0;
    // But WP7 is also Windows, with a slightly different characteristic
    if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows phone') !== false)
        $mobile_browser++;
    if ($mobile_browser > 0)
        return true;
    else
        return false;
}


function settingCache($cacheName = 'arrayCache', $host = '', $port = '')
{
    $params = [
        'cache' => 'Lib\\Cache',
        'params' => [
            'host' => $host,
            'port' => $port,
        ],
        'cacheName' => $cacheName
    ];
    $collector = new $params['cache'];
    $collector->createCache($params['params'], $params['cacheName']);
    return $collector;
}