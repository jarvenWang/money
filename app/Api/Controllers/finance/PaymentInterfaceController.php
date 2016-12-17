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

class PaymentInterfaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        echo 123123;exit;
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
