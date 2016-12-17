<?php

namespace App\Http\Controllers\Admin;

use Faker\Provider\cs_CZ\DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;

class SetApiController extends CommonController
{
    /**
     * 接口页面
     * @author wjb
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function account_set(){
        //检查权限
        $this->check_permissin($this->route);

        $user = Auth::user();
        $auth_key = '888888';
        //获取支付平台
        $data = DB::table('payment')->get();
        //获取支付方式
        $channel_data = DB::table('payment_channel')->where('reseller_id',$user->id)->get();
        //获取层级名称和ID
        $level_data = DB::table('level')->select('name','id')->get();
        //获取安全转账设置
        $settings_data = DB::table('transfer_settings')->get();
        return view('payment.setapi',['level_data'=>$level_data,'data'=>$data,'reseller_id'=>$user->id,'auth_key'=>$auth_key,'channel_data'=>$channel_data,'settings_data'=>$settings_data]);
    }

    /**
     * 添加支付平台方法
     * @author wjb
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function add_mode(Request $request){
        //检查权限
        $this->check_permissin($this->route);

        //获取参数
        $request->input('payname');
        $request->input('function_name');
        $request->input('status');
        $add = array(
            'name'=>$request->input('payname'),
            'function_name'=>$request->input('function_name'),
            'status'=>$request->input('status'),
        );
        $res = DB::table('payment')->insert($add);
        if($res){
            //添加日志
            $description='添加支付平台'.$request->input('payname');
            $this->add_admin_log($description);
            //添加入库
            $response = [
                'status' => 1,
                'success' => '添加成功',
                'url' => '/index'
            ];
            return response()->json($response);
        }else{
            $response = [
                'status' => 2,
                'error' => '添加失败',
                'errorCode' => 'EC02'
            ];
            return response()->json($response);
        }
    }

    /**
     * 添加支付通道
     * @author wjb
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function set_payapi(Request $request){
        //检查权限
        $this->check_permissin($this->route);

        $user = Auth::user();
        $auth_key = '888888';
        $add = array(
            'reseller_id'=> $user->id,
            'payment_id'=>$request->input('payment_id'),
            'name'=>$request->input('payment_id'),
            'auth_key'=>$auth_key,
            'auth_username'=>$request->input('auth_username'),
            'auth_password'=>$request->input('auth_password'),
            'type'=>$request->input('type'),
            'website'=>$request->input('website'),
            'min_pay'=>$request->input('min_pay'),
            'max_pay'=>$request->input('max_pay'),
            'limit'=>$request->input('limit'),
            'status'=>$request->input('status'),
            'remark'=>$request->input('remark'),
            'created_at'=>date("Y-m-d H:i:s",time()),
        );
        $res = DB::table("payment_channel")->insert($add);
        if($res){
            //添加日志
            $description='支付通道,商户：'.$request->input('auth_username');
            $this->add_admin_log($description);
            //添加入库
            $response = [
                'status' => 1,
                'success' => '添加成功',
                'url' => '/index'
            ];
            return response()->json($response);
        }else{
            $response = [
                'status' => 2,
                'error' => '添加失败',
                'errorCode' => 'EC02'
            ];
            return response()->json($response);
        }
    }

    /**
     * 删除支付通道
     * @author wjb
     * @param Request $request
     */
    public function delete_channel(Request $request){
        //检查权限
        $this->check_permissin($this->route);

        $id = intval($request->input('id'));
        if($id){
            //添加日志
            $description='删除支付通道ID：'.$id;
            $this->add_admin_log($description);
            //删除操作
            $del = DB::table('payment_channel')->where('id',$id)->delete();
        }
        if($del){
            echo 1;exit;
        }else{
            echo 2;exit;
        }

    }

    /**
     * !!删除安全转账设置!!
     * @author wjb
     * @param Request $request
     */
    public function delete_settings(Request $request){
        //检查权限
        $this->check_permissin($this->route);

        $id = intval($request->input('id'));
        if($id){
            //添加日志
            $description='删除安全转账设置ID：'.$id;
            $this->add_admin_log($description);
            //删除操作
            $del = DB::table('transfer_settings')->where('id',$id)->delete();
        }
        if($del){
            echo 1;exit;
        }else{
            echo 2;exit;
        }
    }
    /**
     * 获取编辑支付设置信息
     * @author
     * @param Request $request
     * @return array
     */
    public function edit_channel(Request $request){
        //检查权限
        $this->check_permissin($this->route);

        $id = intval($request->input('id'));
        $datas = DB::table('payment_channel')->where('id',$id)->get();
        $data = array();
        foreach ($datas as $item){
            $data['auth_key']=$item->auth_key;
            $data['auth_password']=$item->auth_password;
            $data['auth_username']=$item->auth_username;
            $data['id']=$item->id;
            $data['limit']=$item->limit;
            $data['max_pay']=$item->max_pay;
            $data['min_pay']=$item->min_pay;
            $data['name']=$item->name;
            $data['payment_id']=$item->payment_id;
            $data['remark']=$item->remark;
            $data['reseller_id']=$item->reseller_id;
            $data['status']=$item->status;
            $data['type']=$item->type;
            $data['website']=$item->website;

        }
        if($data){
            return $data;
        }else{
            echo 2;exit;
        }
    }

    /**
     * 修改操作支付通道
     * @author wjb
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function doedit_channel(Request $request){
        //检查权限
        $this->check_permissin($this->route);

        $user = Auth::user();
        $auth_key = '888888';
        $id = $request->input('id');
        $update = array(
            'reseller_id'=> $user->id,
            'payment_id'=>$request->input('payment_id'),
            'name'=>$request->input('name'),
            'auth_key'=>$auth_key,
            'auth_username'=>$request->input('auth_username'),
            'auth_password'=>$request->input('auth_password'),
            'type'=>$request->input('type'),
            'website'=>$request->input('website'),
            'min_pay'=>$request->input('min_pay'),
            'max_pay'=>$request->input('max_pay'),
            'limit'=>$request->input('limit'),
            'status'=>$request->input('status'),
            'remark'=>$request->input('remark'),
            'created_at'=>date("Y-m-d H:i:s",time()),
        );
        $res = DB::table("payment_channel")->where('id',$id)->update($update);
        if($res){
            //添加日志
            $description='修改支付通道ID：'.$request->input('id');
            $this->add_admin_log($description);
            //修改入库
            $response = [
                'status' => 1,
                'success' => '修改成功',
                'url' => '/index'
            ];
            return response()->json($response);
        }else{
            $response = [
                'status' => 2,
                'error' => '修改失败',
                'errorCode' => 'EC02'
            ];
            return response()->json($response);
        }
    }

    /**
     * !!获取安全转账设置!!
     * @param Request $request
     * @return array
     */
    public function edit_settings(Request $request){
        //检查权限
        $this->check_permissin($this->route);

        $id = intval($request->input('id'));
        $datas = DB::table('transfer_settings')->where('id',$id)->get();
        $data = array();
        foreach ($datas as $item){
            $admin_info = DB::table('admins')->where('isreseller',1)->where('id',$item->reseller_id)->select('username')->first();
            $data['id']=$item->id;
            $data['level_id']=$item->level_id;
            $data['bank_id']=$item->bank_id;
            $data['reseller_id']=$admin_info->username;
            $data['bank_account']=$item->bank_account;
            $data['min_pay']=$item->min_pay;
            $data['max_pay']=$item->max_pay;
            $data['limit']=$item->limit;
            $data['status']=$item->status;
            $data['remark']=$item->remark;
        }
        if($data){
            return $data;
        }else{
            echo 2;exit;
        }
    }

    /**
     * !!添加安全转账!!
     * @author wjb
     */
    public function add_transfer(Request $request){
        //检查权限
        $this->check_permissin($this->route);

        $add = array(
            'reseller_id'=>$request->input('reseller_id'),
            'level_id'=>$request->input('level_id'),
            'bank_id'=>$request->input('bank_id'),
            'bank_name'=>$request->input('bank_name'),
            'bank_account'=>$request->input('bank_account'),
            'bank_info'=>$request->input('bank_info'),
            'website'=>$request->input('website'),
            'max_pay'=>$request->input('max_pay'),
            'min_pay'=>$request->input('min_pay'),
            'limit'=>$request->input('limit'),
            'status'=>$request->input('status'),
            'remark'=>$request->input('remark'),
            'created_at'=>date("Y-m-d H:i:s",time()),
        );
        $res = DB::table('transfer_settings')->insert($add);
        if($res){
            $response = [
                'status' => 1,
                'success' => '添加成功',
                'url' => '/index'
            ];
            return response()->json($response);
        }else{
            $response = [
                'status' => 2,
                'error' => '添加失败',
                'errorCode' => 'EC02'
            ];
            return response()->json($response);
        }
    }

    /**
     * !!修改安全转账设置!!
     * @author wjb
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function doedit_settings(Request $request){
        //检查权限
        $this->check_permissin($this->route);

        $id = $request->input('ide');
        $update = array(
            'id'=>$request->input('ide'),
            'level_id'=>$request->input('level_id'),
            'bank_id'=>$request->input('bank_id'),
            'bank_account'=>$request->input('bank_account'),
            'min_pay'=>$request->input('min_paye'),
            'max_pay'=>$request->input('max_paye'),
            'limit'=>$request->input('limite'),
            'status'=>$request->input('statuse'),
            'remark'=>$request->input('remarke'),
            'created_at'=>date("Y-m-d H:i:s",time()),
        );
        $res = DB::table("transfer_settings")->where('id',$id)->update($update);
        if($res){
            //添加日志
            $description='修改安全转账设置ID：'.$request->input('id');
            $this->add_admin_log($description);
            //修改入库
            $response = [
                'status' => 1,
                'success' => '修改成功',
                'url' => '/index'
            ];
            return response()->json($response);
        }else{
            $response = [
                'status' => 2,
                'error' => '修改失败',
                'errorCode' => 'EC02'
            ];
            return response()->json($response);
        }
    }





}
