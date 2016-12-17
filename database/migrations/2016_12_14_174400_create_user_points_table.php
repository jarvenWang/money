<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserPointsTable extends Migration
{
    /**
     * 会员积分表
     * id : 自增ID
     * reseller_id : 所属经销商ID
     * type 1充值积分2投注送积分
     * points 奖励积分
     * amount 单日 充值金额 或者 投注金额
     *
     */
    public function up()
    {
        //
        Schema::create('user_points',function(Blueprint $table){

            $table->increments('id');
            $table->integer('reseller_id');

            $table->tinyInteger('type')->default(1);//1充值积分2投注送积分

            $table->integer('points')->default(0);//奖励积分

            $table->float('amount')->default(0);//单日 充值金额 或者 投注金额


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
        Schema::dropIfExists('user_points');

    }
}
