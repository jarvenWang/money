<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     * Create by hugo
     * 权限设置表
     * @return void
     */
    public function up()
    {
        /*
         * id : 自增ID
         * name : 权限英文名称,命名规则:以英文字母开头,英文、数字、横线(-)组成
         * display_name : 显示名称,命名要求,须清晰表明权限的作用
         * description : 权限详细说明
         * */
        Schema::create('admin_permissions',function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->string('display_name');
            $table->text('description')->nullable();
            $table->timestamps();

            //建立索引
            $table->unique('name');
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
        Schema::dropIfExists('admin_permissions');
    }
}
