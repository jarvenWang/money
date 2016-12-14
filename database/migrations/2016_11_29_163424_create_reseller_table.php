<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResellerTable extends Migration
{
    /**
     * Run the migrations.
     * 经销商表
     * @return void
     */
    public function up()
    {
        /**
         * id : 自增ID
         * name : 姓名
         * username : 用户名
         * email : 邮箱
         * password : 密码
         * temp_password : 临时密码
         * level : 层级,数值小的可以查看数值大的
         * status : 状态(1:正常,0:关闭)
         * website_status : 经销商网站状态(1:正常,0:关闭)
         * close_reason : 网站关闭原因
         * remark : 备注信息
         * self_agents : 经销商直属代理数
         * self_members : 经销商直属会员数
         * total_agents : 经销商所有层级代理数
         * total_members : 经销商所有层级下会员数
         * last_online : 最后在线时间
         * isreseller : 是否经销商(0:管理员,1:经销商)
         * reseller_id : 管理员所属经销商ID
         * domains : 经销商绑定的域名列表
         * member_banks : 会员可以绑定的银行数
         * created_at : 添加时间
         * updated_at : 最后更新资料的时间
         * */
        Schema::create('reseller',function(Blueprint $table){
            $table->increments('id');
            $table->string('name',30);
            $table->string('username',50);
            $table->string('email')->nullable();
            $table->string('password');
            $table->string('temp_password')->nullable();
            $table->tinyInteger('level');
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('website_status')->deafult(0);
            $table->text('close_reason')->nullable();
            $table->text('remark')->nullable();
            $table->integer('self_agents')->default(0);
            $table->integer('self_members')->default(0);
            $table->integer('total_agents')->default(0);
            $table->integer('total_members')->default(0);
            $table->timestamp('last_online')->nullable();
            $table->string('last_login_ip',15)->nullable();
            $table->tinyInteger('isreseller')->default(0);
            $table->integer('reseller_id')->default(0);
            $table->string('remember_token')->nullabel();
            $table->text('domains')->nullabel();
            $table->tinyInteger('member_banks')->default(0);
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
        Schema::dropIfExists('reseller');
    }
}
