<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Auth;
use App\Http\Requests;
use Carbon\Carbon;
use DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    //接口返回格式：
//  {
//  "status": "error/success",
//  "code": "505",
//  "msg": "错误、成功中文提示",
//  "data": {
//      返回参数数组
//      },
//  }
    //从500起之后是错误码
    protected $error_code = array(
        '501'=>'验证码为空',
        '502'=>'验证码不正确',
        '503'=>'用户名或密码错误',
        '504'=>'登陆失败',
        "505"=>'用户不存在',
        "506"=>"登陆超时,请重新登陆",
        "507"=>"token无效",
        "508"=>"安全令牌丢失",
        "509"=>"没有权限",
        "510"=>"输入格式不正确",
        "511"=>"请选择权限组",
        "512"=>"管理员添加失败",
        "513"=>"管理员删除失败",
        "514"=>"准备删除的管理员不存在",
        "515"=>"准备编辑的管理员不存在",
        "516"=>"请选择管理员的默认权限组",
        "517"=>"选择的权限组不存在",
        "518"=>"请填写用户组标识符",
        "519"=>"请选择权限",
        "520"=>"权限组添加失败",
        "521"=>"权限组不存在",
        "522"=>"删除失败",
        "523"=>"编辑失败",
        "524"=>"权限添加失败",
        "525"=>"删除的权限不存在",
        "526"=>"请填写必要的参数",
        "527"=>"暂无数据",
        "528"=>"添加失败",

    );

    //从100~500间是正确码
    protected $success_code = array(
        '101'=>'验证成功',
        '102'=>'验证',
        '103'=>'验证码获取成功',
        '104'=>'获取数据成功',
        '105'=>'管理员添加成功',
        '106'=>'管理员删除成功',
        '107'=>'管理员修改成功',
        '108'=>'权限组添加成功',
        '109'=>'删除成功',
        '110'=>'权限组修改成功',
        '111'=>'权限添加成功',
        '112'=>'编辑成功',
        '113'=>'操作成功',
        '114'=>'添加成功',
    );

    /**
     * 错误提示
     * @author wjb
     * @date 2016/12/10
     * @param $number
     * @return \Illuminate\Http\JsonResponse
     */
    protected function msg_error($number){
        $arr = array(
            'status'=>'0',
            'code'=>"$number",
            'msg'=>$this->error_code[$number]
        );
        return response()->json($arr);
    }

    /**
     * 成功提示
     * @author wjb
     * @date 2016/12/10
     * @param $number
     * @param $array
     * @return \Illuminate\Http\JsonResponse
     */
    protected function msg_success($number,$array,$count=''){
        $arr = array(
            'status'=>'1',
            'code'=>"$number",
            'msg'=>$this->success_code[$number],
            'data'=>array(
                'list'=>$array,
                'count'=>$count,
            )
        );
        return $arr;
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
