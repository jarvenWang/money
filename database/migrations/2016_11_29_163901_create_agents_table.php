<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgentsTable extends Migration
{
    /**
     * Run the migrations.
     * 代理商表
     * @return void
     */
    public function up()
    {
        /**
         * id : 自增ID
         * parent_id : 上级层级ID
         * reseller_id : 所属经销商ID
         * agent_id : 直属代理商ID
         * level_id : 所属会员层级ID
         * grade_id : 所属会员等级ID
         * name : 代理真实姓名
         * username : 登陆用户名
         * password : 登陆密码
         * temp_password : 登陆时生成的临时密码
         * pay_password : 支付密码
         * email : 邮箱
         * mobile : 手机号码
         * balance : 帐户余额
         * frozen_balance : 帐户被冻结金额
         * frozen_login_time : 帐户冻结登陆时间,在此时间之前帐户无法登陆
         * fandian : 代理反水设置
         * status : 帐户状态(1:正常,0:关闭)
         * remark : 备注信息
         * max_agents : 设置代理帐户最大能开的下级代理数
         * max_members : 设置代理帐户最大能开的下级会员数
         * self_agents : 代理帐户直属下级代理数
         * self_members : 直属会员数
         * total_agents : 所有下级代理数
         * total_members : 所有下级会员数
         * total_cash : 提款次数
         * online : 在线状态(1:在线, 0:离线)
         * created_ip : 创建时IP地址
         * last_login_ip : 最后登陆IP地址
         * last_login_at : 最后登陆时间
         * last_lgin_address : 最后登陆所在地
         * number : 会员号(预留)
         * amount_cash : 提款金额
         * amount_hongli : 红利金额
         * */
        Schema::create('agents',function(Blueprint $table){
            $table->increments('id');
            $table->string('parent_id')->nullable();
            $table->integer('reseller_id');
            $table->integer('agent_id')->default(0);
            $table->integer('level_id')->default(0);
            $table->integer('grade_id')->default(0);
            $table->string("name");
            $table->string('username');
            $table->string('password');
            $table->string('temp_password')->nullable();
            $table->string('pay_password')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile',15)->nullable();
            $table->double('balance',9,2)->default(0);
            $table->double('frozen_balance',9,2)->default(0);
            $table->timestamp('frozen_login_time')->nullable();
            $table->decimal('fandian',5,2)->default(0);
            $table->tinyInteger('status')->default(1);
            $table->text('remark')->nullable();
            $table->integer('max_agents')->default(0);
            $table->integer('max_members')->default(0);
            $table->integer('self_agents')->default(0);
            $table->integer('self_members')->default(0);
            $table->integer('total_agents')->default(0);
            $table->integer('total_members')->default(0);
            $table->integer('total_cash')->default(0);
            $table->tinyInteger('online')->default(0);
            $table->string('created_ip',15);
            $table->string('last_login_ip',15)->nullable();
            $table->timestamp('last_login_at')->nullable();
            $table->string('last_login_address')->nullable();
            $table->integer('number')->default(0);
            $table->string('remember_token');
            $table->double('amount_hongli',9,2)->default(0);
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
        Schema::dropIfExists('agents');
    }
}
