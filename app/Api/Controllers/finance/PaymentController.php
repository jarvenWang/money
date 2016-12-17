<?php
namespace App\Api\Controllers\finance;

use App\Models\Admin;
use App\Models\Payment;
use App\Models\UserAccountChange;
use App\Models\TransferSettings;
use Fixtures\Prophecy\EmptyClass;
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
use Illuminate\Support\Facades\Input;

class PaymentController extends Controller
{
    /**
     * 入款(出款)记录列表
     * @author wjb
     * @date 2016/12/14
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function deposit_record(Request $request){
        $username =$request->input('username');
        $start =$request->input('start');
        $end =$request->input('end');
        //当面页数
        $page = $request->input('page');
        $page =isset($page)?$page:1;
        //每页显示几条数据
        $num =$request->input('num');
        $num =isset($num)?$num:10;
        //状态status : （出）入款状态(1:首存审核成功,0:审核中，2：成功 3待审)
        $status =$request->input('status');

        //style（0默认 1入款 2出款 3所有记录）
        $style =$request->input('style');
        if($style!= 1 && $style!= 2 && $style!= 3){
            $arr = array(
                'status'=>'0',
                'code'=>'510',
                'msg'=>'请选择帐变的类型'
            );
            return response()->json($arr);
        }
        $where =array();
        if(isset($style)){
            if($style != 3){
                $where['style']=$style;
            }
        }
        //
        if(isset($status)){
            $where['status']=$status;
        }
        if($username!=''){
            $res_user = Users::where('username',$username)->get();
            if($res_user->isEmpty()){
                $arr = array(
                    'status'=>'0',
                    'code'=>"527",
                    'msg'=>"暂无数据"
                );
                return response()->json($arr);
            }else{
                foreach ($res_user as $k=>$v){
                    $uid = $v->id;
                }
            }
            $where['uid']=$uid;
        }
        $type = $request->input('type');
        if(isset($type)){
            $where['type']=$type;
        }
        $order_number = $request->input('order_number');
        if(isset($order_number)){
            $where['order_number']=$order_number;
        }
        if($start !=''){
            $where[]=['created_at','>=', $start];
        }
        if($end !=''){
            $where[]=['created_at','<=', $end];
        }
        //获取管理员数据
        $count = Payment::where($where)->count();

        //获取管理员数据
        $datas = Payment::where($where)->simplePaginate($num,['*'],'page', $page);
        //print_r($datas);exit;
        if(!$datas->isEmpty()){
            $columns = getColumnList('payment_log');
            foreach ($datas as $key=>$data){
                foreach ($columns as $column) {
                    $arr_admin[$key]["$column"]=$data->$column;
                };

            };
            $type_arr=array();
            $status_arr=array();
            if($style == 1){
                $type_arr = array(
                    '3'=>'在线支付',
                    '4'=>'微信支付',
                    '5'=>'支付宝支付',
                    '6'=>'财富通支付',
                    '7'=>'红利',
                );
            }
            if($style == 3){
                $type_arr= array(
                    '1'=>'转入',
                    '2'=>'转出',
                    '3'=>'在线支付',
                    '4'=>'微信支付',
                    '5'=>'支付宝支付',
                    '6'=>'财富通支付',
                    '7'=>'红利',
                    '8'=>'返水',
                    '9'=>'佣金',
                    '10'=>'加款',
                    '11'=>'扣款',
                );
            }
            if($style == 2){
                $status_arr = array(
                    '0'=>'审核中',
                    '2'=>'成功',
                    '3'=>'待审核',
                    '4'=>'失败',
                );
            }
            $type_arr = $this->arrayToObject($type_arr);
            $status_arr = $this->arrayToObject($status_arr);
            //提示码
            //$number = 104;
            //返回数组
            $array = $arr_admin;
            $arr = array(
                'status'=>'1',
                'code'=>"104",
                'msg'=>'获取数据成功',
                'data'=>array(
                    'list'=>$array,
                    'count'=>$count,
                    'type_arr'=>$type_arr,
                    'status_arr'=>$status_arr,
                )
            );
            return response()->json($arr);
        }else{
            $arr = array(
                'status'=>'0',
                'code'=>"527",
                'msg'=>"暂无数据"
            );
            return response()->json($arr);
        }

    }

    public function arrayToObject($e){
        if( gettype($e)!='array' ) return;
        foreach($e as $k=>$v){
            if( gettype($v)=='array' || getType($v)=='object' )
                $e[$k]=(object)arrayToObject($v);
        }
        return (object)$e;
    }

    /**
     * 查询用户名是否存在
     * @author wjb
     * @date 2016/12/15
     * @param Request $request
     * @return array
     */
    public function search_member(Request $request){
        $username = $request->input('username');
        $rule = [
            'username' => 'required',
        ];
        $messages = [
            'username.required' => '请填写用户名',
        ];
        $validator = Validator::make($request->all(),$rule,$messages);
        if ($validator->fails())
        {
            $arr = array(
                'status'=>'0',
                'code'=>"510",
                'msg'=>$validator->errors()->first()
            );
            return response()->json($arr);
        }
        if($res=DB::table('users')->where('username',$username)->first()){
            $data = array();
            $data['id']=$res->id;
            $data['balance']=$res->balance;
            //提示码
            $number = 104;
            //返回数组
            $arr = $this->msg_success($number,$data);
            return response()->json($arr);
        }else{
            $arr = array(
                'status'=>'0',
                'code'=>"505",
                'msg'=>"用户不存在"
            );
            return response()->json($arr);
        }

    }

    /**
     * 加扣款列表
     * @author wjb
     * @date 2016/12/15
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function plus_deduction(Request $request){
        //当面页数
        $page = $request->input('page');
        $page =isset($page)?$page:1;
        //每页显示几条数据
        $num =$request->input('num');
        $num =isset($num)?$num:10;

        $username = $request->input('username');

        $type = $request->input('type');

        $start = $request->input('start');

        $end = $request->input('end');
        $where =array();
        if($start !=''){
            $where[]=['created_at','>=', $start];
        }
        if($end !=''){
            $where[]=['created_at','<=', $end];
        }

        if($username !=''){
            $where['username']=$username;
        }

        if($type!=''){
            $where['type']=$type;
        }

        //获取管理员数据
        $count = UserAccountChange::where($where)->count();
        //获取管理员数据
        $datas = UserAccountChange::where($where)->simplePaginate($num,['*'],'page', $page);
            if(!$datas->isEmpty()){
                $columns = getColumnList('user_account_change');
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
            }else{
                $arr = array(
                    'status'=>'0',
                    'code'=>"527",
                    'msg'=>"暂无数据"
                );
                return response()->json($arr);
            }

    }

    /**
     * 改变余额
     * @author wjb
     * @date 2016/12/16
     * @param Request $request
     */
    public function change_money(Request $request){
        $rule = [
            'id' => 'required',
            //'balance' => 'required',
            'money' => 'required',
            'remark'=>'required',
            'type'=>'required',
            'fee'=>'required',
        ];
        $rule_error = [
            'id.required' => '请填写用户名id',
            //'balance.required' => '请填写原来金额',
            'money.required' => '请填写改变金额',
            'remark.required' => '请填写操作原因',
            'type.required' => '请选择操作类型',
            'fee.required' => '请选择手续费',
        ];
        $validator = Validator::make($request->all(),$rule,$rule_error);

        if ($validator->fails())
        {
            $arr = array(
                'status'=>'0',
                'code'=>"510",
                'msg'=>$validator->errors()->first()
            );
            return response()->json($arr);
        }

        //事务处理
        DB::transaction(function()
        {
            $id = intval(Input::get('id'));
            $fee = intval(Input::get('fee'));
            //$balance = intval(Input::get('balance'));
            $res_balance = DB::table('users')->where('id',$id)->select('balance')->lockForUpdate()->first();
            $balance = $res_balance->balance;
            $money = intval(Input::get('money'));
            $remark = Input::get('remark');

            $type = intval(Input::get('type'));

            if($type==1){
                $res1 = DB::table('users')->where('id',$id)->lockForUpdate()->increment('balance', $money);
            }elseif ($type==2){
                $res1 = DB::table('users')->where('id',$id)->lockForUpdate()->decrement('balance', $money);
                $money = '-'.$money;
            }


            $add = array(
                'uid'=>$id,
                'money'=>$money,
                'status'=>2,//默认设置为成功
                //'account'=>'8888',
                'fee'=>$fee,
                'check_time'=>Carbon::now(),
                'apply_time'=>Carbon::now(),
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
                'remark'=>$remark,
                'type'=>8,//默认8为后台加扣款类型
                'style'=>4,//后台手动操作金额
            );

//            if($type==1){
//                $add['style']=1;
//            }elseif ($type==2){
//                $add['style']=2;
//            }

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
                'order_number'=>'order'.time().rand(10000,99999),
                'remark'=>$remark,
                'status'=>2,
                'created_at'=>Carbon::now(),
                'handled_at'=>Carbon::now(),
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
                $arr = array(
                    'status'=>'0',
                    'code'=>"510",
                    'msg'=>"未知错误"
                );
                return response()->json($arr);
            }

        });
        $arr = array(
            'status'=>'1',
            'code'=>"113",
            'msg'=>"操作成功"
        );
        return response()->json($arr);

    }


    /**
     * 获取转账列表
     * @author wjb
     * @date 2016/12/17
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function transfer_list(Request $request){
        $id =$request->input('id');
        $where = array();
        if(!empty($id)){
            $where['id'] = $id;
        }
        $res = TransferSettings::where($where)->get();
        if($res->isEmpty()){
            $arr = array(
                'status'=>'0',
                'code'=>"527",
                'msg'=>"暂无数据"
            );
            return response()->json($arr);
        }else{
            //提示码
            $number = 112;
            //返回数组
            $array = $res;
            $arr = $this->msg_success($number,$array);
            return response()->json($arr);
        }

    }


}