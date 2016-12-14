<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgentLevelTable extends Migration
{
    /**
     * Run the migrations.
     * 代理层级表
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
         * private_service : 专属服务(优惠)
         * total : 此层级代理数
         * created_by : 添加此层级的管理员用户名
         * created_at : 添加时间
         * updated_at : 更新时间
         * */
        Schema::create('agent_level',function(Blueprint $table){
            $table->increments('id');
            $table->integer('reseller_id');
            $table->string('name');
            $table->integer('type')->default(0);
            $table->decimal('fandian',3,1)->default(0);
            $table->decimal('fencheng',3,1)->default(0);
            $table->integer('total')->default(0);
            $table->integer('private_service')->default(0);
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
        Schema::dropIfExists('agent_level');
    }
}
