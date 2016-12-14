<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserMobileTable extends Migration
{
    /**
     * Run the migrations.
     * 会员绑定手机表
     * @return void
     */
    public function up()
    {
        //
        Schema::create('user_mobile',function(Blueprint $table){
            $table->integer('user_id');
            $table->string('mobile',15);
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
        Schema::dropIfExists('user_mobile');
    }
}
