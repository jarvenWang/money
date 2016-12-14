<?php
header('Access-Control-Allow-Origin:*');
header("Access-Control-Allow-Methods: POST, GET, OPTIONS,DELETE,PUT");
$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ($api) {
    //不需要通过中间件的
    $api->group(['namespace' => 'App\Api\Controllers'], function ($api) {
        $api->post('make', 'AdminController@makecode');  //检验登录验证码

        $api->post('admins-login', 'AdminController@login');  //管理员登录授权
    });
    //必须要通过中间件的
    $api->group(['namespace' => 'App\Api\Controllers','middleware'=>['authJWT','owner']], function ($api) {
        //'middleware'=>'owner'
        //管理员
        $api->resource('admin', 'AdminController');
        //权限组
        $api->resource('role', 'RoleController');
        //权限
        $api->resource('permission', 'PermissionController');
        //--------------------------财务--------------------------
        //入款记录列表
        $api->post('payment', 'PaymentController@deposit_record');


    });

});
include __DIR__.'/api_chenze.php';

