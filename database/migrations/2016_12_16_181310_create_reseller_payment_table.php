<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResellerPaymentTable extends Migration
{
    /**
     * 在线支付表
     * @author wjb
     * Run the migrations.
     * @return void
     *
     * 字段注释：
     * payment_id : 支付平台id
     * name : 接口名称
     * number : 商户号
     * public_key : 公钥
     * private_key : 私钥
     * min_amount : 单笔最低
     * max_amount : 单笔最高
     * today_limit_amount :停用上限
     * level : 接口级别
     * status :状态（1 启用 0 关闭）
     */
    public function up()
    {
        Schema::create('reseller_payment', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('payment_id');
            $table->string('name');
            $table->integer('number');
            $table->string('public_key');
            $table->string('private_key');
            $table->double('min_amount',9,2)->default(0);
            $table->double('max_amount',9,2)->default(0);
            $table->double('today_limit_amount',9,2)->default(0);
            $table->tinyInteger('level')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->timestamps();

            //建立索引
            $table->index('payment_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reseller_payment');
    }
}
