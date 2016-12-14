<?php
namespace App\Api\Controllers;

use App\Models\Payment;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Controllers\Controller;
use Cookie;
use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Hash;
use Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Auth;
use Gregwar\Captcha\CaptchaBuilder;

class PaymentController extends Controller
{
    /**
     * 入款记录列表
     * @author wjb
     * @date 2016/12/14
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function deposit_record(Request $request){
        //当面页数
        $page = $request->input('page');
        $page =isset($page)?$page:1;
        //每页显示几条数据
        $num =$request->input('num');
        $num =isset($num)?$num:10;
        //状态status : （出）入款状态(1:首存审核成功,0:审核中，2：成功 3待审)
        $status =$request->input('status');
        $status =isset($status)?$status:0;
        //style（0默认 1入款 2出款）
        $style =$request->input('style');
        if($style!= 1 && $style!= 2){
            $arr = array(
                'status'=>'0',
                'code'=>'510',
                'msg'=>'请选择记录的状态'
            );
            return response()->json($arr);
        }
        $where =array();
        if(isset($style)){
            $where['type']=$style;
        }
        if(isset($status)){
           $where['status']=$status;
        }
        //获取管理员数据
        $count = Payment::count();

        //获取管理员数据
        $datas = Payment::simplePaginate($num,['*'],'page', $page);
        //print_r($datas);exit;
        $columns = getColumnList('payment_log');
        foreach ($datas as $key=>$data){
            foreach ($columns as $column) {
                $arr_admin[$key]["$column"]=$data->$column;
            };
        };
        //提示码
        $number = 104;
        //返回数组
        $array = $arr_admin;
        $arr = $this->msg_success($number,$array,$count);
        return response()->json($arr);

    }


    public function out_record(Request $request){

    }
}