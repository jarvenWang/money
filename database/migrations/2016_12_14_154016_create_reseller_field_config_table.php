<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResellerFieldConfigTable extends Migration
{
    /**
     * 注册字段管理表
     * id : 自增ID
     * reseller_id : 所属经销商ID
     * type 0 会员设置 1 经销商设置
     * name 字段名字
     * display 是否显示
     * required 是否必须
     */
    public function up()
    {
        Schema::create('reseller_field_config',function(Blueprint $table){

            $table->increments('id');

            $table->integer('reseller_id');

            $table->integer('type')->default(0);

            $table->string('name');

            $table->string('display')->default(0);
            $table->string('required')->default(0);

            $table->timestamps();

            //建立索引

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
        Schema::dropIfExists('reseller_field_config');

    }
}
