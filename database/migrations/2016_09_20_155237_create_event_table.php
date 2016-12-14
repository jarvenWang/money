<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventTable extends Migration
{
    /**
     * Run the migrations.
     * Create by hugo
     * 活动表
     * @return void
     */
    public function up()
    {
        /*
         * id : 自增ID
         * name : 活动名称
         * description : 活动说明
         * target : 活动对象(1:新会员,2:老会员)
         * type : 活动类型(1:注册,2:验证,3:存送,4:流水,5:盈亏,6:推广)
         * status : 活动状态(1:正常,0:关闭)
         * number : 可申请次数
         * condition_id : 参与资格表自增ID
         * module_id : 所属模块表自增ID
         * created_at : 添加时间
         * updated_at : 更新时间
         * */
        Schema::create('event',function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->tinyInteger('target');
            $table->tinyInteger('type');
            $table->tinyInteger('status');
            $table->integer('number');
            $table->tinyInteger('condition_id');
            $table->tinyInteger('module_id');
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
        //
        Schema::dropIfExists('event');
    }
}
