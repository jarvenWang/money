<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGradeTable extends Migration
{
    /**
     * Run the migrations.
     * Create by hugo
     * 会员等级表
     * @return void
     */
    public function up()
    {
        /*
         * id : 等级表自增ID
         * reseller_id : 经销商表自增ID
         * total_members : 会员总数
         * game_ids : 活动表关联id 1，2，3表示 有id为1，2，3的活动
         * name : 等级称号
         * private_service : 专属服务
         * sort : 等级排序
         * min_points : 最小积分
         * max_points : 最大积分
         * from_date : 开始时间
         * to_date : 结束时间
         * url : 专用网址
         *
         * ====================================
         * 特权服务及升级奖励待定
         *
         * */
        Schema::create('grade',function(Blueprint $table){
            $table->increments('id');
            $table->integer('reseller_id');
            $table->string('name');
            $table->string('game_ids')->nullable();// 1,2,3
            $table->integer('private_service');
            $table->integer('sort')->default(0);
            $table->integer('min_points')->default(0);
            $table->integer('max_points');
            $table->integer('total_members')->default(0);
            $table->timestamp('from_date')->nullable();
            $table->timestamp('to_date')->nullable();
            $table->string('url')->nullable();
            $table->timestamps();
            //建立索引
            $table->index('reseller_id');
            $table->index('created_at');
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
        Schema::dropIfExists('grade');
    }
}
