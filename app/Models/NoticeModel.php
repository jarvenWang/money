<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class NoticeModel extends Model
{

    protected $table = 'notice';
    public $display_where = array( //显示设备类型
        0 => '全部',
        1 => 'PC端',
        2 => '手机端'
    );

    public $display_type = array(  //显示方式
        1=>'滚动公告',
        2=>'弹出窗口'
    );

}
