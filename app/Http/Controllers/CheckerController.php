<?php

namespace App\Http\Controllers;

use DB;
use Cache;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Mail;

class CheckerController extends Controller
{
    //
    public function index(Request $request){

        Mail::send('admin.email_get_password',[],function($m)use($request){
            $m->from('13796192381@163.com','博顺科技');
//            $m->to($request->input('email'),'ye hugh')->subject('重置密码');
            $m->to('156775640@qq.com','ye hugh')->subject('重置密码');

        });

        //endregion
        /*$from_time = Carbon::create(2016,9,23,0,0,0);
        $to_time = Carbon::create(2016,9,23,23,59,59);
        $datas = DB::table('user_account_change_partion')->where('reseller_id','=',1)->whereBetween('created_at',[$from_time,$to_time])->orderBy('id','desc')->paginate(20);

        return view('checker',['datas'=>$datas]);*/
    }
}
