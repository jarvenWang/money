<?php


//$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ($api) {
    $api->get('login','App\Http\Controllers\Api\Chenze\UserController@login');

    //不用使用跨域中间件 跟跨域header有冲突
    //$api->group(['namespace' => 'App\Http\Controllers\Api\Chenze','middleware' => ['cors','authJWT']], function ($api) {
    $api->group(['namespace' => 'App\Http\Controllers\Api\Chenze','middleware' => []], function ($api) {


    $api->get('token','UserController@login');

    $api->resource('member','UserRestController');
    $api->resource('grade','GradeRestController');
    $api->resource('level','levelRestController');
    $api->resource('user_log','UserLogRestController');


    });


});


