<?php

namespace App\Api\Controllers\finance;

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

class TransferController extends Controller
{
    /**
     * 获取转账列表
     * @author wjb
     * @date 2016/12/17
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request){
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
            $number = 104;
            //返回数组
            $array = $res;
            $arr = $this->msg_success($number,$array);
            return response()->json($arr);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    /**
     * 添加转账
     * @author wjb
     * @date 2016/12/15
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request){
        $rule = [
            'name' => 'required',
            'style' => 'required',//（0银行 1其它）
            'website' => 'required',
            //'bank_id'=>'required',
            //'bank_account'=>'required',
            //'bank_info'=>'required',
            'min_pay'=>'required',
            'max_pay'=>'required',
            'limit'=>'required',
            'status'=>'required',
        ];
        $rule_error = [
            'name.required' =>'请填写备注名称',
            'style.required'=>'请选择支付类型',//（0银行 1其它）
            'website.required'=>'银行网址或二维码链接不为空',
            //'bank_id.required'=>'请选择支付银行',
            //'bank_account.required'=>'请选择支付类型',
            //'bank_info.required'=>'请选择支付类型',
            'min_pay.required'=>'请填写单笔最低金额',
            'max_pay.required'=>'请填写单笔最高金额',
            'limit.required'=>'请填写单日上限预警',
            'status.required'=>'请选择转账设置状态',
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
        $add = array(
            'name' => $request->input('name'),
            'style' => $request->input('style'),
            'website' => $request->input('website'),
            //'bank_id'=>'required',
            //'bank_account'=>'required',
            //'bank_info'=>'required',
            'min_pay'=>$request->input('min_pay'),
            'max_pay'=>$request->input('max_pay'),
            'limit'=>$request->input('limit'),
            'status'=>$request->input('status'),
            'created_at'=>date("Y-m-d H:i:s",time()),
        );
        if($request->input('style')==0){
            $rule = [
                'bank_id'=>'required',
                'bank_account'=>'required',
                'bank_info'=>'required',
            ];
            $rule_error = [
                'bank_id.required'=>'请选择支付银行',
                'bank_account.required'=>'请填写银行卡号',
                'bank_info.required'=>'请填写支行信息',
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
            $add['bank_id']=$request->input('bank_id');
            $add['bank_account']=$request->input('bank_account');
            $add['bank_info']=$request->input('bank_info');
        }
        $add['reseller_id']=Auth::user()->id;

        $res = DB::table('transfer_settings')->insert($add);
        if($res){
            $arr = array(
                'status'=>'1',
                'code'=>"114",
                'msg'=>"添加成功"
            );
            return response()->json($arr);
        }else{
            $arr = array(
                'status'=>'0',
                'code'=>"528",
                'msg'=>"添加失败"
            );
            return response()->json($arr);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $rule = [
            'name' => 'required',
            'style' => 'required',//（0银行 1其它）
            'website' => 'required',
            //'bank_id'=>'required',
            //'bank_account'=>'required',
            //'bank_info'=>'required',
            'min_pay'=>'required',
            'max_pay'=>'required',
            'limit'=>'required',
            'status'=>'required',
        ];
        $rule_error = [
            'name.required' =>'请填写备注名称',
            'style.required'=>'请选择支付类型',//（0银行 1其它）
            'website.required'=>'银行网址或二维码链接不为空',
            //'bank_id.required'=>'请选择支付银行',
            //'bank_account.required'=>'请选择支付类型',
            //'bank_info.required'=>'请选择支付类型',
            'min_pay.required'=>'请填写单笔最低金额',
            'max_pay.required'=>'请填写单笔最高金额',
            'limit.required'=>'请填写单日上限预警',
            'status.required'=>'请选择转账设置状态',
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

        $where = array();
        if(empty($id)){
            $arr = array(
                'status'=>'0',
                'code'=>"510",
                'msg'=>'请选择要编辑转账的id'
            );
            return response()->json($arr);
        }
        $where['id'] = $id;
        $update = array(
            'name' => $request->input('name'),
            'style' => $request->input('style'),
            'website' => $request->input('website'),
            //'bank_id'=>'required',
            //'bank_account'=>'required',
            //'bank_info'=>'required',
            'min_pay'=>$request->input('min_pay'),
            'max_pay'=>$request->input('max_pay'),
            'limit'=>$request->input('limit'),
            'status'=>$request->input('status'),
            'created_at'=>date("Y-m-d H:i:s",time()),
        );
        if($request->input('style')==0){
            $rule = [
                'bank_id'=>'required',
                'bank_account'=>'required',
                'bank_info'=>'required',
            ];
            $rule_error = [
                'bank_id.required'=>'请选择支付银行',
                'bank_account.required'=>'请填写银行卡号',
                'bank_info.required'=>'请填写支行信息',
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
            $update['bank_id']=$request->input('bank_id');
            $update['bank_account']=$request->input('bank_account');
            $update['bank_info']=$request->input('bank_info');
        }
        //$update['reseller_id']=Auth::user()->id;
        $res = TransferSettings::where($where)->update($update);
        if($res){
            $arr = array(
                'status'=>'1',
                'code'=>"112",
                'msg'=>"编辑成功"
            );
            return response()->json($arr);
        }else{
            $arr = array(
                'status'=>'0',
                'code'=>"523",
                'msg'=>"编辑失败"
            );
            return response()->json($arr);
        }
    }


    /**
     * 删除转账
     * @author wjb
     * @date 2016/12/17
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $where = array();
        if(empty($id)){
            $arr = array(
                'status'=>'0',
                'code'=>"510",
                'msg'=>'请选择要删除转账的id'
            );
            return response()->json($arr);
        }
        $where['id'] = $id;
        $res = TransferSettings::where($where)->delete();
        if($res){
            $arr = array(
                'status'=>'1',
                'code'=>"109",
                'msg'=>"删除成功"
            );
            return response()->json($arr);
        }else{
            $arr = array(
                'status'=>'0',
                'code'=>"522",
                'msg'=>"删除失败"
            );
            return response()->json($arr);
        }
    }
}
