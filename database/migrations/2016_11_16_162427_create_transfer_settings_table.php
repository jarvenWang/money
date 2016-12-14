<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransferSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * 安全转账设置表
         * @author wjb
         * id:主键ID
         * reseller_id:代理商ID
         * level_id:层级
         * bank_id:所属银行
         * bank_name:银行名称
         * bank_account:银行账号
         * bank_info:开户信息
         * website：网址
         * max_pay：最高支付
         * min_pay：最低支付
         * limit：上线报警
         * status：开启状态（0关闭，1开启）
         * remark：备注信息
         */
        Schema::create('transfer_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('reseller_id');
            $table->integer('level_id');
            $table->tinyInteger('bank_id');
            $table->string('bank_name');
            $table->string('bank_account');
            $table->string('bank_info');
            $table->string('website');
            $table->double('max_pay',9,2)->default(0);
            $table->double('min_pay',9,2)->default(0);
            $table->double('limit',9,2)->default(0);
            $table->tinyInteger('status')->default(0);
            $table->string('remark');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transfer_settings');
    }
}
