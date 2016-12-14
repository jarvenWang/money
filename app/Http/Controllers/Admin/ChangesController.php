<?php

namespace App\Http\Controllers\Admin;

use Faker\Provider\cs_CZ\DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ChangesController extends CommonController
{
    /**
     * 账变页面
     * @author wjb
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function user_change(Request $request){
        //检查权限
        $this->check_permissin($this->route);

        $page = $request->input('page');
        $nowpage = isset($page)?$page-1:0;

        $limits = 15;
        $start = $nowpage*$limits;
        // 获取总条数
        $count = DB::table('user_account_change')->join('users','user_account_change.user_id','=','users.id')->select('users.username','user_account_change.id','user_account_change.type','user_account_change.amount_change','user_account_change.balance','user_account_change.remark','user_account_change.created_at')->count();
        // 计算总页面
        $allpage = ceil($count / $limits);
        $allpage = intval($allpage);

        $res_change = DB::table('user_account_change')->offset($start)->limit($limits)->join('users','user_account_change.user_id','=','users.id')->select('users.username','user_account_change.id','user_account_change.type','user_account_change.amount_change','user_account_change.balance','user_account_change.remark','user_account_change.created_at')->get();

        return view("payment.account_log",['nowpage'=>$nowpage,'allpage'=>$allpage,'res_change'=>$res_change,'count'=>$count]);
    }

    /**
     * 按条件查询并分页
     * @author wjb
     * @param Request $request
     * @return array
     */
    public function changes(Request $request){
        //检查权限
        $this->check_permissin($this->route);
        
        $nowpage = intval($request->input('page'));
        $num = intval($request->input('num'));
        $num = isset($num)?$num:15;
        $start = $request->input('start');
        $start = isset($start)?$start:'';
        $end = $request->input('end');
        $end = isset($end)?$end:'';
        $status = $request->input('status');
        $status = isset($status)?$status:'';
        $where =array();
        if($status !=''){
            $where[]=['user_account_change.status',$status];
        }
        if($start !=''){
            $where[]=['user_account_change.created_at','>=', $start];
        }
        if($end !=''){
            $where[]=['user_account_change.created_at','<=', $end];
        }
        $nowpage = isset($nowpage)?$nowpage:0;
        $limits = $num;
        $start_set = $nowpage*$limits;
        if(!empty($where)){
                $test=1;
                $res_change = DB::table('user_account_change')->where($where)->offset($start_set)->limit($limits)->join('users','user_account_change.user_id','=','users.id')->select('users.username','user_account_change.id','user_account_change.type','user_account_change.amount_change','user_account_change.balance','user_account_change.remark','user_account_change.created_at')->get();
                $count = DB::table('user_account_change')->where($where)->limit($limits)->join('users','user_account_change.user_id','=','users.id')->select('users.username','user_account_change.id','user_account_change.type','user_account_change.amount_change','user_account_change.balance','user_account_change.remark','user_account_change.created_at')->count();
        }else{
                $test=2;
                $res_change = DB::table('user_account_change')->offset($start_set)->limit($limits)->join('users','user_account_change.user_id','=','users.id')->select('users.username','user_account_change.id','user_account_change.type','user_account_change.amount_change','user_account_change.balance','user_account_change.remark','user_account_change.created_at')->get();
                $count = DB::table('user_account_change')->limit($limits)->join('users','user_account_change.user_id','=','users.id')->select('users.username','user_account_change.id','user_account_change.type','user_account_change.amount_change','user_account_change.balance','user_account_change.remark','user_account_change.created_at')->count();
        }
        // 计算总页面
        $allpage = ceil($count / $limits);
        $allpage = intval($allpage);
        $str = '';
        foreach ($res_change as $change){
            $str.="<tr class='$change->id'><td align='center' style='display: none;'>$change->id</td><td align='center'>$change->username</td><td align='center'>$change->type</td><td align='center'>$change->amount_change</td><td align='center'>$change->balance</td><td align='center'>$change->remark</td><td align='center'>$change->created_at</td></tr>";
        }
        $arr = array(
            'test'=>$test,
            'nowpage'=>$nowpage,
            'nextpage'=>$nowpage+1,
            'allpage'=>$allpage,
            'list'=>$str,
        );
        return $arr;
    }

}
