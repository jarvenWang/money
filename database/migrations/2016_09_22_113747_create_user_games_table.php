<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserGamesTable extends Migration
{
    /**
     * Run the migrations.
     * Create by hugo
     * 会员游戏接入中间表
     * @return void
     */
    public function up()
    {
        /*
         * user_id : 会员表自增ID
         * game_code : 接入游戏代号
         * */
        Schema::create('user_games',function(Blueprint $table){
            $table->integer('user_id');
            $table->string('game_code',20);

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
        Schema::dropIfExists('user_games');
    }
}
