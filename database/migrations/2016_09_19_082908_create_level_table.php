<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLevelTable extends Migration
{
    /**
     * Run the migrations.
     * Create by hugo
     * 会员层级表
     * @return void
     */
    public function up()
    {
        /*
         * id : 层级表自增ID
         * reseller_id : 经销商表自增ID
         * name : 会员层级名称
         * type : 分成方式(0,两者都有,1:占成,2:反水)
         * fandian : 反水比例
         * fencheng : 分成比例
         * payment_channel : 所属支付通道
         * allow_payment : 允许的支付方式
         * url : 专用网址
         * total : 此层级会员数
         * created_by : 添加此层级的管理员用户名
         * allow_games : 允许下注的游戏代码
         * created_at : 添加时间
         * updated_at : 更新时间
         * */
        Schema::create('level',function(Blueprint $table){
            $table->increments('id');
            $table->integer('reseller_id');
            $table->string('name');
            $table->integer('type')->default(0);
            $table->decimal('fandian',3,1)->default(0);
            $table->decimal('fencheng',3,1)->default(0);
            $table->string('url')->nullable();
            $table->integer('total')->default(0);
            $table->string('payment_channel')->default(0);
            $table->string('allow_games')->nullable();
            $table->string('allow_payment')->default(0);
            $table->string('created_by');
            $table->timestamps();
            //建立索引
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
        Schema::dropIfExists('level');
    }
}
