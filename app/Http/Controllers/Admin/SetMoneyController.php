<?php

namespace App\Http\Controllers\Admin;

use Faker\Provider\cs_CZ\DateTime;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\Input;

class SetMoneyController extends CommonController
{
    /**
     * !!加扣款页面!!
     * @author wjb
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        //检查权限
        $this->check_permissin($this->route);

        return view('payment.setmoney');
    }

    /**
     * !!查询用户名是否存在!!
     * @author wjb
     * @param Request $request
     * @return array
     */
    public function search_member(Request $request){
        //检查权限
        $this->check_permissin($this->route);

        $username = $request->input('username');
        $res = DB::table('users')->where('username','=',$username)->first();
        if($res){
            $data = array();
            $data['id']=$res->id;
            $data['balance']=$res->balance;
            return $data;exit;
        }else{
            echo 2;exit;
        }
    }

    /**
     * !!改变余额!!
     * @param Request $request
     */
    public function change_money(Request $request){
        //检查权限
        $this->check_permissin($this->route);

        //事务处理
        DB::transaction(function()
        {
            $id = intval(Input::get('id'));
            $balance = intval(Input::get('balance'));
            $money = intval(Input::get('money'));
            $remark = Input::get('remark');
            $type = intval(Input::get('type'));

            if($type==1){
                $res1 = DB::table('users')->where('id',$id)->increment('balance', $money);
            }elseif ($type==2){
                $res1 = DB::table('users')->where('id',$id)->decrement('balance', $money);
            }

            $add = array(
                'uid'=>$id,
                'money'=>$money,
                'status'=>2,//默认设置为成功
                'account'=>'8888',
                'check_time'=>date('Y-m-d H:i:s',time()),
                'apply_time'=>date('Y-m-d H:i:s',time()),
                'remark'=>$remark,
                'type'=>8,//默认8为后台加扣款类型
            );

            if($type==1){
                $add['style']=1;
            }elseif ($type==2){
                $add['style']=2;
            }

            $res2 = DB::table('payment_log')->insert($add);

            $res_info = DB::table('users')->where('id',$id)->first();

            $add_change=array(
                'reseller_id'=>Auth::user()->id,
                'user_id'=>$id,
                'agent_id'=>Auth::user()->id,
                'parent_id'=>Auth::user()->id,
                'isagent'=>1,
                'admin_id'=>Auth::user()->id,
                'username'=>$res_info->username,
                'balance'=>$res_info->balance,
                'before_change'=>$balance,
                'amount_change'=>$money,
                'order_number'=>'8888',
                'remark'=>$remark,
                'status'=>2,
                'created_at'=>date('Y-m-d H:i:s',time()),
                'handled_at'=>date('Y-m-d H:i:s',time()),
            );
            if($type==1){
                $add_change['type']=7;
            }elseif ($type==2){
                $add_change['type']=8;
            }

            $res3 = DB::table('user_account_change')->insert($add_change);

            //添加日志
            $description='管理员ID：'.Auth::user()->id.'修改用户ID:'.$id.'余额，影响金额：'.$money;
            $this->add_admin_log($description);

            if (!$res1 || !$res2 || !$res3) {
                DB::rollback();//事务回滚
                echo 1;exit;
            }

        });

    }
}
