<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SmsModel extends Model
{

    protected $table = 'sms';
    /*字段*/
    private $id; //自增ID
    private $reseller_id; //经销商ID
    private $title; //标题
    private $content; //图文内容
    private $url; //外链接
    private $created_at; //添加时间
    private $created_by; //添加此短信的管理员用户名
    private $send_to; //接收对象类型(all:全部,grade:按等级,level:按层级,username:按会员帐号)
    private $send_to_id; //接收对象ID(0表示全部,其它对应等级、层级、会员ID)

    /*字段详情*/
    public  $send_to_arr = array(
        'all'=>'全部',
        'grade'=>'等级',
        'level'=>'层级',
        'username'=>'会员帐号',
    );
    //__get()方法用来获取私有属性
    function __get($property_name)
    {
        if(isset($this->$property_name))
        {
            return($this->$property_name);
        }else
        {
            return(NULL);
        }
    }
    //__set()方法用来设置私有属性
    function __set($property_name, $value)
    {
        $this->$property_name = $value;
    }





}
