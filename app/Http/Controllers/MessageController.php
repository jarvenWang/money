<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\BaseController as BaseController;
use App\Models\SmsModel;
use App\Models\AdminActionLogModel;
class MessageController extends BaseController
{
    /**
     * @abstract 消息列表
     * @param object $request 请求的参数
     * @return  json  status 0:失败  1：成功
     * @author  ttao
     * @version [2016-11-16]
     */
    public function messageList(Request $request ,$p=1,$limit=15) {
        //接收查询条件
        $limit=$request->input('limit',15 );
        $startTime=$request->input('start_time','');
        $endTime=$request->input('end_time','');
        $title=$request->input('title','');
        $type = $request->input('type','');
        $keywords = $request->input('keywords','');

        //接收页码
        $pp=$request->input('p',1);
        //是否为首页
        $first=$request->input('first');
        // 计算跳过条数
        $skip=($pp-1)*$limit;

        $with['startTime']=$startTime;
        $with['endTime']=$endTime;
        $with['title']=$title;
        $with['type']=$type;
        $with['keywords']=$keywords;
        $data=[];
        //按条件获取数据
        //添加查询条件
        $where=[['reseller_id','=',\Auth::user()->reseller_id]];
        if($startTime!=''){
            $where[]=['created_at','>=',$startTime];
        }
        if($endTime!=''){
            $where[]=['created_at','<=',$endTime];
        }
        if($type && $keywords){
            switch($type){
                case 'title':
                    $where[]=['title','=',$keywords];
                    break;
                case 'created_by':
                    $where[]=['created_by','=',$keywords];
                    break;
            }
        }
        $data = DB::table('sms')
            ->where($where)->skip($skip)->take($limit)->orderBy('id','desc')->get();
        //计算总数
        $counts=DB::table('sms')->count();
        $pageCounts=$counts/$limit;
        $count=ceil($pageCounts);
        $where_json='';
        if(count($where)>1){
            $where_json=(string)json_encode($where);
        }
        $smsModel = new SmsModel();
        $send_to_arr = $smsModel->send_to_arr;
        //分配模版变量
        $viewdata=['count'=>$count,'data'=>$data,'page'=>$pp,'counts'=>$counts,'where'=>$where_json,'send_to_arr'=>$send_to_arr];
        if(!empty($first)){
            $viewdata['first']=1;
        }
        return view('message.message_list',$viewdata)->with($with);
    }

    //    更改信息
    public function changeMessage(Request $request) {

        $json=$id=$request->input('data');
        $arr=json_decode($json,true);
        $id=$arr['id'];
        unset($arr['id']);
        $res=DB::table('sms')->where('id',$id)->update($arr);

        if($res){
            //写入日志
            $log = "更新了消息，ID：".$id;
            $adminlogModel = new AdminActionLogModel();
            $adminlogModel->description = $log;
            $adminlogModel->insertAdminLog();
            $arr['status']=1;
            $arr['id']=$id;
            return json_encode($arr);
        }else{
            $_arr['status']=0;
            return json_encode($_arr);
        }

    }

    public function listpage($p=1,$limit=15) {
        $data=DB::table('sms')->skip($limit*$p)->take($limit)->get();
        $count=DB::table('sms')->count();
    }

    public function addMessage(Request $request) {
        $json=$request->input('data');
        $arr=json_decode($json,true);
        $rule = [
            'title' => 'required',
            'content' => 'required',
        ];
        $messages = [
            'title.required' => '标题不能为空',
            'content.required' => '内容不能为空',
        ];
        $reseller_id = \Auth::user()->reseller_id;
        switch($arr['send_to']){
            case 'all':
                $arr['send_to_id'] = 0;
                break;
            case 'grade':
                $where['name'] = trim($arr['send_to_id']);
                $where['reseller_id'] = $reseller_id;
                $rs = DB::table('grade')->where($where)->find(1);
                $arr['send_to_id'] = $rs->id;
                break;
            case 'level':
                $where['name'] = trim($arr['send_to_id']);
                $where['reseller_id'] = $reseller_id;
                $rs = DB::table('level')->where($where)->find(1);
                $arr['send_to_id'] = $rs->id;
                break;
            case 'username':
                $where['username'] = trim($arr['send_to_id']);
                $where['reseller_id'] = $reseller_id;
                $rs = DB::table('users')->where($where)->find(1);
                $arr['send_to_id'] = $rs->id;
                break;
        }
        $validator=Validator::make($arr,$rule,$messages);
        $arr['reseller_id']=$reseller_id;
        $arr['created_by']=\Auth::user()->username;
        $arr['created_at']=date('Y-m-d H:i:s');
        $arr['updated_at']=date('Y-m-d H:i:s');
        if ($validator->fails())
        {
            $response = ['message'=>$validator->errors()->first(),'status'=>2,'url'=>''];
            return json_encode($response);
        }
        $res=DB::table('sms')->insert($arr);
        //获取插入的id
        $insert_id =  DB::getPdo()->lastInsertId();
        if($res){
            //写入日志
            $log = "添加了公告，ID：".$insert_id;
            $adminlogModel = new AdminActionLogModel();
            $adminlogModel->description = $log;
            $adminlogModel->insertAdminLog();
            $arr2['status']=1;
            return json_encode($arr2);
        }else{
            $_arr2['status']=0;
            return json_encode($_arr2);
        }
    }

    //删除消息
    public function delMessage(Request $request) {
        $delid=$request->input('delid');
        $res=DB::table('sms')
            ->where('id', $delid)
            ->delete();
        $resArr=['status'=>0];
        if($res){
            $resArr['status']=1;
        }
        return json_encode($resArr);
    }

//    ajax获取信息
    public function selectMessage(Request $request) {
        $id=$request->input('editid');
        $data=DB::table('sms')->find($id);
        return json_encode($data);
    }

}
