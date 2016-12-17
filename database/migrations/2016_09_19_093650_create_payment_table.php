<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentTable extends Migration
{
    /**
     * Run the migrations.
     * Create by hugo
     * 支付接口设置表
     * @return void
     */
    public function up()
    {
        /*
         * id : 自增ID
         * name : 支付接口名称(支付宝,财付通...)
         * function_name : 处理支付的函数名,方便前端API调用
         * level : 所属层级（1网上银行2微信3支付宝4财富通）
         * status : 接口状态(1:正常,0:关闭)
         * */
        Schema::create('payment',function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->string('function_name');
            $table->tinyInteger('level')->default(0);
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('payment');
    }
}
