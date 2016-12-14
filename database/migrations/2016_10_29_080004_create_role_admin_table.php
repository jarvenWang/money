<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoleAdminTable extends Migration
{
    /**
     * Run the migrations.
     * 管理员角色(用户组)表
     * @return void
     */
    public function up()
    {
        /*
         * admin_id : 管理员id
         * role_id : 角色id
         * */
        Schema::create('role_admin', function(Blueprint $table){
            $table->increments('id');
            $table->integer('admin_id');
            $table->integer('role_id');
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
        Schema::dropIfExists('role_admin');
    }
}
