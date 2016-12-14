<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminActiveLogTable extends Migration
{
    /**
     * Run the migrations.
     * Create by hugo
     * 管理员操作记录表
     * @return void
     */
    public function up()
    {
        /*
         * 冗余
         * */
        Schema::create('admin_active_log',function(Blueprint $table){
            $table->increments('id');
            $table->integer('admin_id');
            $table->integer('reseller_id')->default(0);
            $table->tinyInteger('isreseller')->default(0);
            $table->string('username',50);
            $table->text('description');
            $table->string('ip',15);
            $table->timestamp('created_at')->nullable();

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
        Schema::dropIfExists('admin_active_log');
    }
}
