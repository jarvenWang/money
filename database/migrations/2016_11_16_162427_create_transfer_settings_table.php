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
         * name：备注名称
         * style : 银行或其它（0银行 1其它）
         * website：银行网址或二维码链接(根据style判断)
         * bank_id:银行表id（不为0代表选择银行）
         * bank_account:银行卡号
         * bank_info:开户行信息
         * min_pay：单笔最低
         * max_pay：单笔最高
         * limit：上线报警
         * status：开启状态（0关闭，1开启）
         *
         */
        Schema::create('transfer_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('reseller_id')->default(0);
            $table->integer('level_id')->default(0);
            $table->string('name');
            $table->tinyInteger('style');
            $table->string('website');
            $table->tinyInteger('bank_id')->default(0);
            $table->string('bank_account')->default('');
            $table->string('bank_info')->default('');
            $table->double('min_pay',9,2)->default(0);
            $table->double('max_pay',9,2)->default(0);
            $table->double('limit',9,2)->default(0);
            $table->tinyInteger('status')->default(0);
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
