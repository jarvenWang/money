<?php

namespace App\Http\Controllers\Admin;

use Faker\Provider\cs_CZ\DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;

class PaymentController extends CommonController
{

    /**
     * !!入款记录列表!!
     * @author wjb
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function payment(Request $request){
        //检查权限
        $this->check_permissin($this->route);

        $page = $request->input('page');
        $nowpage = isset($page)?$page-1:0;

        $pass_count = DB::table('payment_log')->where('status','=',2)->count();
        $wait_count = DB::table('payment_log')->where('status','=',3)->count();
        $start_count = DB::table('payment_log')->where('status','=',0)->count();
        $limits = 2;
        $start = $nowpage*$limits;
        // 获取总条数
        $count = DB::table('payment_log')->count();        // 计算总页面
        $allpage = ceil($count / $limits);
        $allpage = intval($allpage);

        $res_change = DB::table('payment_log')->offset($start)->limit($limits)->where('payment_log.style','1')->join('users', 'payment_log.uid', '=', 'users.id')->select('payment_log.style','payment_log.fee','payment_log.id', 'payment_log.uid','payment_log.account', 'payment_log.money', 'payment_log.type', 'payment_log.apply_time', 'payment_log.status', 'payment_log.check_time', 'payment_log.remark','users.username')->orderBy('id','desc')->get();
        $result = DB::table('payment_log')->offset($start)->limit($limits)->where('payment_log.style','1')->join('users', 'payment_log.uid', '=', 'users.id')->select('payment_log.style','payment_log.fee','payment_log.id', 'payment_log.uid','payment_log.account', 'payment_log.money', 'payment_log.type', 'payment_log.apply_time', 'payment_log.status', 'payment_log.check_time', 'payment_log.remark','users.username')->orderBy('id','desc')->get();

        return view("payment.payment_log",['start_count'=>$start_count,'wait_count'=>$wait_count,'pass_count'=>$pass_count,'nowpage'=>$nowpage,'allpage'=>$allpage,'datas'=>$res_change,'results'=>$result,'count'=>$count]);
    }

    /**
     * !!入款记录条件查询和分页方法!!
     * @author wjb
     * @param Request $request
     * @return array
     */
    public function payment_log(Request $request){
        //检查权限
        $this->check_permissin($this->route);

        //$style = intval($request->input('style'));
        $nowpage = intval($request->input('page'));
        $num = intval($request->input('num'));
         if($num==''){
            $num=2;
        }
        $start = $request->input('start');
        $start = isset($start)?$start:'';
        $end = $request->input('end');
        $end = isset($end)?$end:'';
        $status = $request->input('status');
        $status = isset($status)?$status:'';
        $where =array();
        if($status !=''){
            $where[]=['payment_log.status',$status];
        }
        if($start !=''){
            $where[]=['payment_log.apply_time','>=', $start];
        }
        if($end !=''){
            $where[]=['payment_log.apply_time','<=', $end];
        }
        $nowpage = isset($nowpage)?$nowpage:0;
        $limits = $num;
        $start_set = $nowpage*$limits;
        $style_arr =array();
        //if($style==1){
            $style_arr[]=['payment_log.style', 1];
//        }elseif ($style==2){
//            $style_arr[]=['payment_log.style', 2];
//        }
        if(!empty($where)){
            $test=1;
            $res_change = DB::table('payment_log')->where($where)->where($style_arr)->offset($start_set)->limit($limits)->join('users', 'payment_log.uid', '=', 'users.id')->select('payment_log.style','payment_log.fee','payment_log.id', 'payment_log.uid','payment_log.account', 'payment_log.money', 'payment_log.type', 'payment_log.apply_time', 'payment_log.status', 'payment_log.check_time', 'payment_log.remark','users.username')->orderBy('payment_log.id','desc')->get();
            $count = DB::table('payment_log')->where($where)->where($style_arr)->join('users', 'payment_log.uid', '=', 'users.id')->select('payment_log.style','payment_log.fee','payment_log.id', 'payment_log.uid','payment_log.account', 'payment_log.money', 'payment_log.type', 'payment_log.apply_time', 'payment_log.status', 'payment_log.check_time', 'payment_log.remark','users.username')->orderBy('payment_log.id','desc')->count();
        }else{
            $test=2;
            $res_change = DB::table('payment_log')->where($style_arr)->offset($start_set)->limit($limits)->join('users', 'payment_log.uid', '=', 'users.id')->select('payment_log.style','payment_log.fee','payment_log.id', 'payment_log.uid','payment_log.account', 'payment_log.money', 'payment_log.type', 'payment_log.apply_time', 'payment_log.status', 'payment_log.check_time', 'payment_log.remark','users.username')->orderBy('payment_log.id','desc')->get();
            $count = DB::table('payment_log')->where($style_arr)->join('users', 'payment_log.uid', '=', 'users.id')->select('payment_log.style','payment_log.fee','payment_log.id', 'payment_log.uid','payment_log.account', 'payment_log.money', 'payment_log.type', 'payment_log.apply_time', 'payment_log.status', 'payment_log.check_time', 'payment_log.remark','users.username')->orderBy('payment_log.id','desc')->count();

        }
        // 计算总页面
        $allpage = intval(ceil($count/$limits));
        $str = '';
        foreach ($res_change as $change){
            $str.="<tr class='$change->id'><td align='center'>$change->id</td><td align='center'>$change->username</td><td align='center'>$change->fee</td><td align='center'>$change->money</td><td align='center'>$change->type</td><td align='center'>$change->apply_time</td><td align='center' class='ckstatus$change->id'>$change->status</td><td align='center' class='cktime$change->id'>$change->check_time</td><td align='center' class='ckremark$change->id'>$change->remark</td><td align='center'><a onclick='edit_log($change->id)' class='com-smallbtn com-btn-color01 editer-btn' style='color: white;'>审核</a><a onclick='del_log($change->id)' class=' com-smallbtn com-btn-color02 ml5 del-btn' style='color: white;'>删除</a></td></tr>";
        }
        $arr = array(
            'style'=>1,
            'test'=>$test,
            'limit'=>$limits,
            'nowpage'=>$nowpage,
            'nextpage'=>$nowpage+1,
            'allpage'=>$allpage,
            'list'=>$str,
        );
        return $arr;
    }

    /**
     * !!出款记录条件查询和分页方法!!
     * @author wjb
     * @param Request $request
     * @return array
     */
    public function payment_logs(Request $request){
        //检查权限
        $this->check_permissin($this->route);

        //$style = intval($request->input('style'));
        $nowpage = intval($request->input('page'));
        $num = intval($request->input('num'));
        if($num==''){
            $num=2;
        }
        $start = $request->input('start');
        $start = isset($start)?$start:'';
        $end = $request->input('end');
        $end = isset($end)?$end:'';
        $status = $request->input('status');
        $status = isset($status)?$status:'';
        $where =array();
        if($status !=''){
            $where[]=['payment_log.status',$status];
        }
        if($start !=''){
            $where[]=['payment_log.apply_time','>=', $start];
        }
        if($end !=''){
            $where[]=['payment_log.apply_time','<=', $end];
        }
        $nowpage = isset($nowpage)?$nowpage:0;
        $limits = $num;
        $start_set = $nowpage*$limits;
        $style_arr =array();
        //if($style==1){
//        $style_arr[]=['payment_log.style', 1];
//        }elseif ($style==2){
            $style_arr[]=['payment_log.style', 2];
//        }
        if(!empty($where)){
            $test=1;
            $res_change = DB::table('payment_log')->where($where)->where($style_arr)->offset($start_set)->limit($limits)->join('users', 'payment_log.uid', '=', 'users.id')->select('payment_log.style','payment_log.fee','payment_log.id', 'payment_log.uid','payment_log.account', 'payment_log.money', 'payment_log.type', 'payment_log.apply_time', 'payment_log.status', 'payment_log.check_time', 'payment_log.remark','users.username')->orderBy('payment_log.id','desc')->get();
            $count = DB::table('payment_log')->where($where)->where($style_arr)->join('users', 'payment_log.uid', '=', 'users.id')->select('payment_log.style','payment_log.fee','payment_log.id', 'payment_log.uid','payment_log.account', 'payment_log.money', 'payment_log.type', 'payment_log.apply_time', 'payment_log.status', 'payment_log.check_time', 'payment_log.remark','users.username')->orderBy('payment_log.id','desc')->count();
        }else{
            $test=2;
            $res_change = DB::table('payment_log')->where($style_arr)->offset($start_set)->limit($limits)->join('users', 'payment_log.uid', '=', 'users.id')->select('payment_log.style','payment_log.fee','payment_log.id', 'payment_log.uid','payment_log.account', 'payment_log.money', 'payment_log.type', 'payment_log.apply_time', 'payment_log.status', 'payment_log.check_time', 'payment_log.remark','users.username')->orderBy('payment_log.id','desc')->get();
            $count = DB::table('payment_log')->where($style_arr)->join('users', 'payment_log.uid', '=', 'users.id')->select('payment_log.style','payment_log.fee','payment_log.id', 'payment_log.uid','payment_log.account', 'payment_log.money', 'payment_log.type', 'payment_log.apply_time', 'payment_log.status', 'payment_log.check_time', 'payment_log.remark','users.username')->orderBy('payment_log.id','desc')->count();

        }
        // 计算总页面
        $allpage = intval(ceil($count/$limits));
        $str = '';
        foreach ($res_change as $change){
            $str.="<tr class='$change->id'><td align='center'>$change->id</td><td align='center'>$change->username</td><td align='center'>$change->fee</td><td align='center'>$change->money</td><td align='center'>$change->type</td><td align='center'>$change->apply_time</td><td align='center' class='ckstatus$change->id'>$change->status</td><td align='center' class='cktime$change->id'>$change->check_time</td><td align='center' class='ckremark$change->id'>$change->remark</td><td align='center'><a onclick='edit_log($change->id)' class='com-smallbtn com-btn-color01 editer-btn' style='color: white;'>审核</a><a onclick='del_log($change->id)' class=' com-smallbtn com-btn-color02 ml5 del-btn' style='color: white;'>删除</a></td></tr>";
        }
        $arr = array(
            'style'=>2,
            'test'=>$test,
            'limit'=>$limits,
            'nowpage'=>$nowpage,
            'nextpage'=>$nowpage+1,
            'allpage'=>$allpage,
            'list'=>$str,
        );
        return $arr;
    }
    /**
     * !!删除记录方法!!
     * @author wjb
     * @param Request $request
     */
    public function del_log(Request $request){
        //检查权限
        $this->check_permissin($this->route);

        $id = intval($request->input('id'));
        if($id){
            DB::table('payment_log')->where('id','=',$id)->delete();
            echo 1;exit;
        }else{
            echo 2;exit;
        }
    }

    /**
     * 审核账务记录
     * @author
     * @param Request $request
     * @return array
     */
    public function check_log(Request $request){
        //检查权限
        $this->check_permissin($this->route);

        $id = intval($request->input('id'));
        $remark = $request->input('remark');
        $str = $request->input('status');
        $time = date("Y-m-d H:i:s",time());
        $res = DB::table('payment_log')->where('id','=',$id)->select('status')->get();
        foreach ($res as $item){
            $res_status=$item->status;
        }
        if($res_status == 2 || $res_status == 3){
            echo 3;exit;
        }else{
            if($str == 'ok'){
                $status = 2;
            }else{
                $status = 3;
            }
        }

        $update = [
            'remark' => $remark,
            'check_time' => $time,
            'status' => $status,
        ];
        $res = DB::table('payment_log')->where('id','=',$id)->update($update);
        if($res){
            return $update;exit;
        }else{
            echo 2;exit;
        }

    }
}
