<?php
header('Access-Control-Allow-Origin:*');
header("Access-Control-Allow-Methods: POST, GET, OPTIONS,DELETE,PUT");
$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ($api) {
    //不需要通过中间件的
    $api->group(['namespace' => 'App\Api\Controllers'], function ($api) {
        $api->post('make', 'service\AdminController@makecode');  //检验登录验证码

        $api->post('admins-login', 'service\AdminController@login');  //管理员登录授权
    });
    //必须要通过中间件的
    $api->group(['namespace' => 'App\Api\Controllers','middleware'=>['authJWT','owner']], function ($api) {
        //'middleware'=>'owner'
        //管理员
        $api->resource('admin', 'service\AdminController');
        //权限组
        $api->resource('role', 'service\RoleController');
        //权限
        $api->resource('permission', 'service\PermissionController');
        //--------------------------财务--------------------------
        //入款(出款)记录列表
        $api->post('payment', 'finance\PaymentController@deposit_record');
        //查询会员账户余额
        $api->post('search', 'finance\PaymentController@search_member');
        //加扣款列表
        $api->post('plusDeduction', 'finance\PaymentController@plus_deduction');
        //修改账户余额
        $api->get('changeMoney', 'finance\PaymentController@change_money');
        //转账
        $api->resource('transfer', 'finance\TransferController');
        //支付接口
        $api->resource('paymentInterface', 'finance\PaymentInterfaceController');
    });

});
include __DIR__.'/api_chenze.php';

