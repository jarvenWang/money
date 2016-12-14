<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserActiveLogTable extends Migration
{
    /**
     * Run the migrations.
     * Create by hugo
     * 会员/代理操作记录表
     * @return void
     */
    public function up()
    {
        /*
         * id : 自增ID
         * reseller_id : 经销商表自增ID
         * user_id : 会员/代理表自增ID
         * username : 会员/代理登陆用户名
         * description : 操作描述
         * created_at : 添加时间
         * ip : 操作时IP地址
         * */
        Schema::create('user_active_log',function(Blueprint $table){
            $table->increments('id');
            $table->integer('reseller_id');
            $table->integer('user_id');
            $table->string('username');
            $table->text('description');
            $table->nullableTimestamps('created_at');
            $table->string('ip',15);

            //建立索引
            $table->index('user_id');
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
        Schema::dropIfExists('user_active_log');
    }
}
