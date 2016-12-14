<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserSmsTable extends Migration
{
    /**
     * Run the migrations.
     * Create by Hugo
     * 会员短信中间表
     * @return void
     */
    public function up()
    {
        /*
         * user_id : 会员表自增ID
         * sms_id : 短信表自增ID
         * status : 短信状态(0:未读,1:已经读)
         * */
        Schema::create('user_sms',function(Blueprint $table){
            $table->integer('user_id');
            $table->integer('sms_id');
            $table->tinyInteger('status')->default(0);

            //建立索引
            $table->index('user_id');
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
        Schema::dropIfExists('user_sms');
    }
}
