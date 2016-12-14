<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Carbon\Carbon;
use DB;



class CommonController extends Controller
{
    /**
     * current_route : 当前请求的路由名称,用来进行权限判断
     * user : 当前用户对象
     */
    protected $route;
    protected $user;
    public function __construct(Request $request)
    {
        //获取当前路由
        $full = explode('/',str_replace('http://','',url()->current()));
        $len = count($full)-1;
        $this->route = $full[$len];
    }

    /**
     * 检查权限
     * @author wjb
     * @param $route
     */
    protected function check_permissin($route){
        if (!Auth::user()->can($route))
        {
            echo "<div class=\"permiss-box\"><p  class=\"permiss-text\">权限不足</p></div>";
            exit;
        }
    }
    /**
     * 管理员操作日志
     * @author wjb
     * @param $description
     * @return bool
     */
    protected function add_admin_log($description){
        //管理员信息获取
        $user = Auth::user();
        $ip = get_client_ip();
        $log = [
            'admin_id' => $user->id,
            'isreseller' => $user->isreseller,
            'reseller_id' => $user->reseller_id,
            'username' => $user->username,
            'description'=>$description,
            'ip' => $ip,
            'created_at' => Carbon::now(),
        ];
        $res = DB::table('admin_active_log')->insert($log);
        if($res){
            return true;
        }else{
            return false;
        }
    }

}
