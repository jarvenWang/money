<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigTable extends Migration {
    /**
     * 网站配置表
     * id : 自增ID
     * reseller_id : 所属经销商ID
     * company_name 公司名称
     * default_agent 默认代理
     * close 关闭 0 开启 1 关闭
     * close_reason 关闭原因
     *
     * today_recharge_amount 单日充值金额
     * today_recharge_points 单日充值奖励积分
     * today_recharge_status 单日充值开关 默认1 1 开 0 关闭
     * today_bet_amount 单日投注金额
     * today_bet_points 单日投注奖励积分
     * today_limit_points 单日奖励积分上限
     * today_bet_status 单日投注开关 默认1 1 开 0 关闭
     *
     * 同一IP重复注册时间 ip_register_time 0分钟 不限时间
     * 登录超时时间 login_timeout  0分钟 不限时间
     * 是否开放注册 open_register 1 开放注册 0 关闭注册
     *
     * max_points 每日奖励积分上限 0 不限制
     * close_recharge_point 充值送积分是否关闭 1 开启 0关闭
     * close_bet_point 投注送积分是否关闭 1 开启 0关闭
     */
    public function up() {
        //
        Schema::create('config', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('reseller_id');
            $table->string('company_name');
            $table->integer('default_agent')->default(0);
            $table->tinyInteger('close')->default(0);
            $table->text('close_reason');

            $table->integer('ip_register_time')->default(0);
            $table->integer('login_timeout')->default(0);
            $table->integer('open_register')->default(1);

            $table->integer('today_recharge_amount')->nullable();
            $table->integer('today_recharge_points')->nullable();
            $table->integer('today_bet_amount')->nullable();
            $table->integer('today_bet_points')->nullable();
            $table->integer('today_limit_points')->nullable();

            $table->integer('today_recharge_status')->default(1);
            $table->integer('today_bet_status')->default(1);



            $table->integer('max_points')->default(0);//每日奖励积分上限
            $table->tinyInteger('close_recharge_point')->default(1);//充值送积分是否关闭 1 开启 0关闭
            $table->tinyInteger('close_bet_point')->default(1);//投注送积分是否关闭 1 开启 0关闭


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        //
        Schema::dropIfExists('config');

    }
}
