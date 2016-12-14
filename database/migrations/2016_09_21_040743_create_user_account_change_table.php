<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAccountChangeTable extends Migration
{
    /**
     * Run the migrations.
     * Create by hugo
     * 会员/代理帐变表
     * @return void
     */
    public function up()
    {
        /*
         * id : 自增ID
         * reseller_id : 经销商表自增ID #
         * user_id : 会员/代理表自增ID
         * agent_id : 上级代理商对应ID,方便代理商查询直属会员或直属代理的帐变记录 #
         * parent_id : 所属上级所有层级ID #
         * isagent : 是否代理商(0:会员,1:代理) #
         * admin_id : 处理提款申请,充值申请等的管理员ID
         * username : 会员用户名,方便查询 #
         * type : 帐变类型(1:存款,2:提款,3:红利,4:反水,5:下注,6:派彩,7:转入,8:转出)
         * 存款:公司入款,线上支付(网银,支付宝,微信等第三方),微信二维码,支付宝二维码
         * balance : 当前帐户余额
         * before_change : 帐变前帐户余额
         * amount_change : 变动金额
         * order_number : 订单号
         * remark : 备注说明
         * status : 状态(0:待审,1:锁定,2:成功,3:失败,4:回查成功,5:回查失败),主要用于会员提款,出款等申请操作
         * created_at : 添加时间
         * handled_at : 处理时间
         * 提款跟充值的订单第一次点击时即锁定该笔订单,只有锁定人(管理员)可以继续操作
         * */
        Schema::create('user_account_change',function(Blueprint $table){
            $table->increments('id');
            $table->integer('reseller_id');
            $table->integer('user_id');
            $table->integer('agent_id');
            $table->string('parent_id');
            $table->tinyInteger('isagent')->default(0);
            $table->integer('admin_id')->default(0);
            $table->string('username',50);
            $table->tinyInteger('type');
            $table->double('balance',15,2);
            $table->double('before_change',15,2);
            $table->double('amount_change',15,2);
            $table->string('order_number');
            $table->text('remark');
            $table->tinyInteger('status')->default(0);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('handled_at')->nullable();

            //建立索引
            $table->index('reseller_id');
            $table->index(['reseller_id','username'],'reseller_id_uesrname');
            $table->index(['reseller_id','created_at'],'reseller_id_created_at');
            $table->index(['reseller_id','type'],'reseller_id_type');
            $table->index(['reseller_id','agent_id'],'reseller_id_agent_id');
            $table->index(['reseller_id','agent_id','type'],'reseller_id_agent_id_type');

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
        Schema::dropIfExists('user_account_change');
    }
}
