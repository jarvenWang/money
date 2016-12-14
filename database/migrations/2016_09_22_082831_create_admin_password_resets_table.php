<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminPasswordResetsTable extends Migration
{
    /**
     * Run the migrations.
     * Create by hugo
     * 管理员重置密码表
     * @return void
     */
    public function up()
    {
        /*
         *
         * */
        Schema::create('admin_password_resets',function(Blueprint $table){
            $table->string('email');
            $table->string('token');
            $table->timestamp('created_at');

            //建立索引
            $table->index('email');
            $table->index('token');
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
        Schema::dropIfExists('admin_password_resets');
    }
}
