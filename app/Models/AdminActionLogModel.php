<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;
use Carbon\Carbon;

class AdminActionLogModel extends Model
{

    protected $table = 'admin_active_log';
    /*字段*/
    private $id; //id
    private $admin_id; //管理员id
    private $reseller_id; //商家id
    private $isreseller; //是否商家 1是 0否
    private $username; //管理员名
    private $description; //操作详情
    private $ip; //操作ip
    private $created_at; //创建时间

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


    public function insertAdminLog(){
        //添加操作日志
        $log = [
            'admin_id' => Auth::user()->id,
            'username' => Auth::user()->username,
            'description' => $this->description,
            'created_at' => Carbon::now(),
            'isreseller' => 1,
            'reseller_id' => Auth::user()->reseller_id,
            'ip' => get_client_ip()
        ];
        DB::table($this->table)->insert($log);
        //获取插入的id
        $insert_id =  DB::getPdo()->lastInsertId();
        return $insert_id;
    }

}
