<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminPermissionRoleTable extends Migration
{
    /**
     * Run the migrations.
     * 管理员角色(用户组)表
     * @return void
     */
    public function up()
    {
        /*
         * role_id: 角色id
         * permission_id : 权限节点id
         * */
        Schema::create('admin_permission_role', function(Blueprint $table){
            $table->increments('id');
            $table->integer('role_id');
            $table->integer('permission_id');
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
        Schema::dropIfExists('admin_permission_role');
    }
}
