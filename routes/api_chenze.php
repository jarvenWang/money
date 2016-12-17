<?php


//$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ($api) {
    $api->get('login', 'App\Http\Controllers\Api\Chenze\UserController@login');

    //不用使用跨域中间件 跟跨域header有冲突
    //$api->group(['namespace' => 'App\Http\Controllers\Api\Chenze','middleware' => ['cors','authJWT']], function ($api) {
//  全局设置 ->会员相关设置
    $api->group(['namespace' => 'App\Api\Controllers\systems\globalSetting', 'middleware' => []], function ($api) {

        $api->get('basic_set', 'MemberController@basic_set');

        $api->get('member_registration', 'MemberController@member_registration');

        $api->get('change_registration_field', 'MemberController@change_registration_field');

        $api->get('member_points', 'MemberController@member_points');
        //系统设置 会员等级
        $api->get('member_grade', 'MemberController@member_grade');
//        删除某个会员等级
        $api->get('del_member_grade', 'MemberController@del_member_grade');

        $api->get('change_member_points', 'MemberController@change_member_points');

    });

//  代理
    $api->group(['namespace' => 'App\Api\Controllers\agent', 'middleware' => []], function ($api) {

//  代理
        $api->resource('agent', 'AgentRestController');
//  佣金结算
        $api->get('commission_settlement', 'AgentRestController@commission_settlement');
//  代理审核
        $api->get('verify_agent', 'AgentRestController@verify_agent');

    });

//  会员
    $api->group(['namespace' => 'App\Api\Controllers\member', 'middleware' => []], function ($api) {

        $api->resource('member', 'UserRestController');
        $api->resource('grade', 'GradeRestController');
        $api->resource('level', 'LevelRestController');
        $api->resource('user_log', 'UserLogRestController');

        $api->get('fanshui', 'UserRestController@fanshui');
        $api->get('fanshui_log', 'UserRestController@fanshui_history');
        $api->get('agent_level', 'LevelRestController@agent_level');

    });
});


