<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameManagerTable extends Migration
{
    /**
     * 游戏种类表
     * id : 自增ID
     * reseller_id : 所属经销商ID
     * type 游戏类型 0 体育 1 彩票 2 真人视讯 3 电子游戏
     * game_name 游戏名字
     * business 商家
     * remark 备注
     * status 开启状态 默认 0 关闭
     *
     */
    public function up()
    {
        //
        Schema::create('game_manager',function(Blueprint $table){

            $table->increments('id');
            $table->integer('reseller_id');
            $table->integer('type')->default(0);
            $table->string('game_name');
            $table->string('business');
            $table->string('remark');
            $table->integer('status')->default(0);


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
        Schema::dropIfExists('game_manager');

    }
}
