<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {

    if (Auth::check())
    {
        return redirect('index');
    }
    return redirect('login');
});
Route::get('checker','CheckerController@index');

//登陆界面
Route::get('login', 'Admin\LoginController@index');
Route::get('getcode', 'Admin\LoginController@getcode');
//处理登陆操作
Route::post('login', 'Admin\LoginController@handle');
//登出
Route::get('logout', 'Admin\LoginController@logout');
//测试方法
Route::get('test', 'BaseMemberController@_list');

//重置密码
Route::get('customer-repass.html', 'Admin\LoginController@repassword');
Route::post('set_password', 'Admin\LoginController@set_password');

Route::group(['middleware'=>'auth'],function(){

    //登陆成功后总界面
//    Route::get('main', 'Admin\LoginController@main');
    Route::get('index', 'MemberListController@index');

    //管理员列表
    Route::get('users', 'Admin\UserController@index');

    //添加管理员
    Route::get('add-user', 'Admin\UserController@add');

    Route::get('routine-setting.html', 'Admin\UserController@add');

    Route::post('add-user', 'Admin\UserController@addHandle');
    //编辑管理员
    Route::post('edit-user', 'Admin\UserController@edit');
    //删除管理员
    Route::post('delete-user', 'Admin\UserController@deleteHandle');
    
    //添加用户组
    Route::get('add-role', 'Admin\UserController@addRole');
    Route::post('add-role', 'Admin\UserController@addRoleHandle');

    //编辑角色
    Route::post('edit-role', 'Admin\UserController@editRoleHandle');
    //删除角色
    Route::post('del-role', 'Admin\UserController@deleteRoleHandle');

    //添加权限节点
    Route::get('add-permission', 'Admin\UserController@addPermission');
    Route::post('add-permission', 'Admin\UserController@addPermissionHandle');

    //编辑权限节点
    Route::get('edit-permission', 'Admin\UserController@editPermission');
    Route::post('edit-permission', 'Admin\UserController@editPermissionHandle');

    //删除权限节点
    Route::post('delete-permission', 'Admin\UserController@deletePermissionHandle');

    //权限节点列表
    Route::get('permissions', 'Admin\UserController@permissions');

    //----------------------chenze add-----------------------------------
    //首页 统计主页
    Route::any('main.html',['as'=>'_main','uses'=>'MemberListController@main']);

    //会员列表页
    Route::any('member-list.html',['as'=>"_member-list",'uses'=>'MemberListController@member_list']);

    Route::any('delid',['as'=>'_delid','uses'=>'MemberListController@delid']);

    Route::any('selectUser', ['as'=>'_selectUser','uses'=>'MemberListController@selectUser']);

    Route::any('changeUser',['as'=>'_changeUser','uses'=>'MemberListController@changeUser']);

//
//添加用户
//Route::post('addUser','ListController@addUser')->name('_addUser')->middleware(['web']);
    Route::post('addUser','MemberListController@addUser')->name('_addUser');

    //会员层级
    Route::any('member-level.html', ['as'=>'_member-level','uses'=>'MemberListController@member_level'] );
    Route::any('changeLevel',['as'=>'_changeLevel','uses'=>'MemberListController@changeLevel']);
    Route::any('selectLevel', ['as'=>'_selectLevel','uses'=>'MemberListController@selectLevel']);
    Route::post('addLevel','MemberListController@addLevel')->name('_addLevel');
    //    agent-level
    //代理层级
    Route::any('agent-level.html', ['as'=>'_member-agent-level','uses'=>'MemberListController@member_agent_level'] );
    Route::any('changeAgentLevel',['as'=>'_changeAgnetLevel','uses'=>'MemberListController@changeAgentLevel']);
    Route::any('selectAgentLevel', ['as'=>'_selectAgentLevel','uses'=>'MemberListController@selectAgentLevel']);
    Route::post('addAgentLevel','MemberListController@addAgentLevel')->name('_addAgentLevel');
    //会员等级
    Route::any('member-grade.html', ['as'=>'_member-grade','uses'=>'MemberListController@member_grade'] );
    Route::any('changeGrade',['as'=>'_changeGrade','uses'=>'MemberListController@changeGrade']);
    Route::any('selectGrade', ['as'=>'_selectGrade','uses'=>'MemberListController@selectGrade']);
    Route::post('addGrade','MemberListController@addGrade')->name('_addGrade');

    //代理列表
    Route::any('agent-list.html', ['as'=>'_agent-list','uses'=>'MemberListController@agentList'] );
    Route::any('changeAgent',['as'=>'_changeAgent','uses'=>'MemberListController@changAgent']);
    Route::any('selectAgent', ['as'=>'_selectAgent','uses'=>'MemberListController@selectAgent']);
    Route::post('addAgent','MemberListController@addGrade')->name('addAgent');
//    member-grade
    //-------------------chenze end add----------------------------------
    //财务 -- 记录
    Route::get('finance-record.html','Admin\PaymentController@payment');
    //入款记录查询方法
    Route::get('payment_log','Admin\PaymentController@payment_log');
    //出款记录查询方法
    Route::get('payment_logs','Admin\PaymentController@payment_logs');
    //删除记录
    Route::post('del_log','Admin\PaymentController@del_log');
    //审核申请记录
    Route::post('check_log','Admin\PaymentController@check_log');
    //财务 -- 接口
    Route::get('finance-interface.html','Admin\SetApiController@account_set');
    //添加支付平台
    Route::post('add-mode','Admin\SetApiController@add_mode');
    //接口设置
    Route::post('set-payapi','Admin\SetApiController@set_payapi');
    //删除通道设置
    Route::post('delete-channel','Admin\SetApiController@delete_channel');
    //编辑通道设置
    Route::post('edit-channel','Admin\SetApiController@edit_channel');
    Route::post('doedit-channel','Admin\SetApiController@doedit_channel');
    //添加安全转账设置
    Route::post('add-transfer','Admin\SetApiController@add_transfer');
    //删除安全转账设置
    Route::post('delete-settings','Admin\SetApiController@delete_settings');
    //编辑安全转账设置
    Route::post('edit-settings','Admin\SetApiController@edit_settings');
    Route::post('doedit-settings','Admin\SetApiController@doedit_settings');
    //财务 -- 账变
    Route::any('finance-accountchange.html','Admin\ChangesController@user_change');
    Route::get('changes','Admin\ChangesController@changes');
    //加扣款
    Route::get('finance-debit.html','Admin\SetMoneyController@index');
    //搜索用户名的存在
    Route::any('search_member','Admin\SetMoneyController@search_member');
    //修改用户的余额
    Route::any('change_money','Admin\SetMoneyController@change_money');

    //-------------------ttao start add----------------------------------
    //公告
    Route::any('noticeList.html',['as'=>"_noticeList",'uses'=>'NoticeController@noticeList']);
    Route::any('delNotice',['as'=>'_delNotice','uses'=>'NoticeController@delNotice']);
    Route::any('selectNotice', ['as'=>'_selectNotice','uses'=>'NoticeController@selectNotice']);
    Route::any('changeNotice',['as'=>'_changeNotice','uses'=>'NoticeController@changeNotice']);
    Route::any('addNotice',['as'=>'_addNotice','uses'=>'NoticeController@addNotice']);
    //消息
    Route::any('messageList.html',['as'=>"_messageList",'uses'=>'MessageController@messageList']);
    Route::any('delMessage',['as'=>'_delMessage','uses'=>'MessageController@delMessage']);
    Route::any('selectMessage', ['as'=>'_selectMessage','uses'=>'MessageController@selectMessage']);
    Route::any('changeMessage',['as'=>'_changeMessage','uses'=>'MessageController@changeMessage']);
    Route::any('addMessage',['as'=>'_addMessage','uses'=>'MessageController@addMessage']);
    //-------------------ttao end add----------------------------------
});



