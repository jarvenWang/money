<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminRolesTable extends Migration
{
    /**
     * Run the migrations.
     * 管理员角色(用户组)表
     * @return void
     */
    public function up()
    {
        /*
         * id : 自增ID
         * name : 角色(用户组)名称,于用权限检查,命名要求:以英文字母开头,由英文、数字、横线组成
         * display_name : 显示名称
         * description : 角色描述
         * reseller_id : 所属经销商ID,0为系统管理员组
         * */
        Schema::create('admin_roles', function(Blueprint $table){
            $table->increments('id');
            $table->string('name',30);
            $table->string('display_name','50');
            $table->string('description')->nullable();
            $table->integer('reseller_id')->default(0);
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
        Schema::dropIfExists('admin_roles');
    }
}
