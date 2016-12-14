<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmsTable extends Migration
{
    /**
     * Run the migrations.
     * Create by Hugo
     * 常规-短信表
     * @return void
     */
    public function up()
    {
        /*
         * id : 自增ID
         * reseller_id : 经销商ID
         * title : 标题
         * content : 图文内容
         * url : 外链接
         * created_at : 添加时间
         * created_by : 添加此短信的管理员用户名
         * send_to : 接收对象类型(all:全部,grade:按等级,level:按层级,username:按会员帐号)
         * send_to_id : 接收对象ID(0表示全部,其它对应等级、层级、会员ID)
         * */
        Schema::create('sms',function(Blueprint $table){
            $table->increments('id');
            $table->integer('reseller_id');
            $table->string('title');
            $table->longText('content')->nullable();
            $table->string('url')->nullable();
            $table->string('send_to');
            $table->integer('send_to_id')->default(0);
            $table->string('created_by');
            $table->timestamps();

            //建立索引
            $table->index('reseller_id');
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
        Schema::dropIfExists('sms');
    }
}
