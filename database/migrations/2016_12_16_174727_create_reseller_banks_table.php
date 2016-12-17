<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResellerBanksTable extends Migration
{
    /**
     * 商户银行表
     * @author wjb
     * Run the migrations.
     * @return void
     *
     * 字段注释：
     * reseller_id : 商户的id
     * name : 银行的名称
     * code : 银行的简称（如：中国工商银行（ICBC））
     */
    public function up()
    {
        Schema::create('reseller_banks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('reseller_id');
            $table->string('name');
            $table->string('code',6);
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
        Schema::dropIfExists('reseller_banks');
    }
}
