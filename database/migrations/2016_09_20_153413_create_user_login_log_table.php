<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserLoginLogTable extends Migration
{
    /**
     * Run the migrations.
     * Create by hugo
     * 会员登陆记录表
     * @return void
     */
    public function up()
    {
        /*
         * id : 自增ID
         * user_id : 会员/代理表自增ID
         * reseller_id : 经销商表自增ID
         * isagent : 是否代理商(1:是,0:不是)
         * username : 会员/代理登陆用户名
         * login_time : 登陆时间
         * login_side : 登陆设备(1:PC,2:H5,3:苹果,4:安卓)
         * ip : 登陆时IP地址
         * country : 国家
         * address : 详细地址
         * carrier : 网络供应商,如:电信,移动等
         * os : 操作系统
         * screen : 屏幕分辨率
         * browser : 浏览器
         * abnormal : 登陆是否异常(1:异常,0:正常)
         * */
        Schema::create('user_login_log',function(Blueprint $table){
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('reseller_id');
            $table->tinyInteger('isagent')->default(0);
            $table->string('username');
            $table->timestamp('login_time');
            $table->tinyInteger('login_side')->default(1);
            $table->string('ip',15);
            $table->string('country',30);
            $table->string('address',150);
            $table->string('carrier',30);
            $table->string('os',30);
            $table->string('screen',15)->nullabel();
            $table->string('browser',30);
            $table->tinyInteger('abnormal')->default(0);

            //建立索引
            $table->index('username');
            $table->index('login_time');
            $table->index('login_side');
            $table->index(['username','login_time']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('user_login_log');
    }
}
