<?php

/**
 * 路由文件
 * 常用请求方法的Shorcut方法
 * GET，POST，PUT，PATCH，DELETE，HEAD
 */
return [
    //默认访问
    [
        ['GET', 'POST'],
        'controller' => '/',
        'action' => [
            'Application\Http\Index@index'
        ]
    ],
    [
        ['GET'],
        'controller' => '/User',
        'action' => [
            'Application\Http\User@index',
            'Application\Http\User@abc',
        ]
    ],
    [
        ['GET'],
        'controller' => '/Live',
        'action' => [
            'Application\Http\Live@index',
        ]
    ],
    [
        ['GET','POST'],
        'controller' => '/Login',
        'action' => [
            'Application\Http\Login@login',
        ]
    ],

];