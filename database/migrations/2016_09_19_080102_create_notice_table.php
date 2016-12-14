<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoticeTable extends Migration
{
    /**
     * Run the migrations.
     * Create by Hugo
     * 常规-系统公告
     * @return void
     */
    public function up()
    {
        /*
         * id : 公告自增ID
         * reseller_id : 经销商表自增ID
         * title : 公告标题
         * content : 公告内容
         * isagent :1就是代理公告，默认0
         * display_where : 显示设备类型(0:全部,1:PC端,2:手机端)
         * display_type : 显示方式(1:滚动公告,2:弹出窗口)
         * deleted_at : 软删除(放入回收站,并没有真正从数据库删除),记录删除时间
         * created_at : 记录添加时间
         * updated_at : 记录更新时间
         * created_by : 添加此公告的管理员用户名
         * */
        Schema::create('notice',function(Blueprint $table){
            $table->increments('id');
            $table->integer('reseller_id');
            $table->string('title');
            $table->longText('content');
            $table->integer('isagent')->default(0);
            $table->tinyInteger('display_where');
            $table->tinyInteger('display_type');
            $table->timestamp('deleted_at')->nullable();
            $table->string('created_by');
            $table->timestamps();

            //建立索引
            $table->index(['reseller_id','deleted_at']);
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
        Schema::dropIfExists('notice');
    }
}
