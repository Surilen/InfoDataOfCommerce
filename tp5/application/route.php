<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

return [
    '__pattern__' => [
        'name' => '\w+',
    ],
    '[hello]'     => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],
    'login' => 'index/Login/login',
    'loginout' => 'index/Login/loginout',
    'article' => 'index/Data/article',
    'adminlogin' => 'index/Login/adminerlogin',
    'adminloginout' => 'index/Login/adminerloginout',
    'admin' => 'index/Admin/getPage',
    'f9eqhrgeurwwgh7regw8gqrg' => 'index/Login/work',//ban掉明文密码加密方法，防止误操作
];
