<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentLogTable extends Migration
{
    /**
     * Run the migrations.
     * Create by hugo
     * 财务记录表
     * @return void
     */
    public function up()
    {
        /**
         * id : 自增ID
         * uid : 会员id
         * money : 金额
         * type : （出）入款类型(0:默认 ，1：微信支付 2：支付宝支付 3.....)
         * status : （出）入款状态(1:首存审核成功,0:审核中，2：成功 3待审 4失败)
         * (account：（出）入款账号 暂时注释掉)
         * apply_time：申请时间
         * check_time：审核时间
         * remark：备注信息
         * fee : 手续费
         * style : 出、入款区别（0默认 1入款 2出款）
         * */
        Schema::create('payment_log',function(Blueprint $table){
            $table->increments('id');
            $table->integer('uid');
            $table->double('money',9,2)->default(0);
            $table->tinyInteger('type')->default(0);
            $table->tinyInteger('status')->default(0);
            //$table->string('account');
            $table->timestamp('check_time')->nullable();;
            $table->timestamp('apply_time')->nullable();;
            $table->string('remark');
            $table->double('fee',9,2)->default(0);
            $table->tinyInteger('style')->default(0);
            $table->timestamps();
            //建立索引
            $table->index('id');
            $table->index('uid');
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
        Schema::dropIfExists('payment_log');
    }
}
