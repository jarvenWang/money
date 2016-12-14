<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymemtChannelTable extends Migration
{
    /**
     * Run the migrations.
     * Create by hugo
     * 经销商支付通道表
     * @return void
     */
    public function up()
    {
        /**
         * id : 自增ID
         * reseller_id : 经销商表自增ID（admins表ID）
         * payment_id : 支付设置表自增ID
         * name : 支付通道名称
         * //以下支付接口参数由经销商提供
         * auth_key : 支付接口安全码(验证码)
         * auth_username : 支付接口用户名
         * auth_password : 支付接口密码
         * type : 类型（1主2备）
         * website : 域名
         *  min_pay : 最低支付
         *  max_pay : 最高支付
         *  website : 域名
         *  limit : 停用上限
         * status : 是否启用 (0关闭 1启用)
         * remark : 备注说明
         * updated_at : 更新时间
         * */
        Schema::create('payment_channel',function(Blueprint $table){
            $table->increments('id');
            $table->integer('reseller_id');
            $table->integer('payment_id');
            $table->string('name');
            $table->string('auth_key');
            $table->string('auth_username');
            $table->string('auth_password');
            $table->string('type');
            $table->string('website');
            $table->double('min_pay',9,2)->default(0);
            $table->double('max_pay',9,2)->default(0);
            $table->string('limit');
            $table->string('status');
            $table->string('remark');
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
