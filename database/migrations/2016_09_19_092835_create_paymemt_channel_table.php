<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymemtChannelTable extends Migration
{
    /**
     * Run the migrations.
     * Create by hugo
     * 支付通道表
     * @return void
     */
    public function up()
    {
        /**
         * id : 自增ID
         * reseller_id : 经销商表自增ID（admins表ID）
         * payment_id : 支付平台ID
         * name : 接口名称
         * number : 商户号
         * public_key : 公钥
         * private_key : 私钥
         * min_amount : 单笔最低
         * max_amount : 单笔最高
         * today_limit_amount :停用上限
         * level : 接口级别
         * status :状态（1 启用 0 关闭）
         * */
        Schema::create('payment_channel',function(Blueprint $table){
            $table->increments('id');
            $table->integer('reseller_id');
            $table->integer('payment_id');
            $table->string('name');
            $table->string('number');
            $table->string('public_key');
            $table->string('private_key');
            $table->double('min_amount',9,2)->default(0);
            $table->double('max_amount',9,2)->default(0);
            $table->string('today_limit_amount');
            $table->string('level');
            $table->string('status');
            $table->timestamps();

            //建立索引
            $table->index('id');
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
        Schema::dropIfExists('payment_channel');
    }
}
