<?php
/**
+------------------------------------------------------------------------------
 * 后台公告控制器
+------------------------------------------------------------------------------
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use Carbon\Carbon;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\BaseController as BaseController;
use App\Models\NoticeModel;
use App\Models\AdminActionLogModel;
class NoticeController extends BaseController
{
    /**
     * @abstract 公告列表
     * @param object $request 请求的参数
     * @param int  $p   页数
     * @param int  $limit   每页条数
     * @return  void  无返回
     * @author  ttao
     * @version [2016-11-16]
     */
    public function noticeList(Request $request ,$p=1,$limit=15) {
        //接收查询条件
        $limit=$request->input('limit',15 );
        $startTime=$request->input('start_time','');
        $endTime=$request->input('end_time','');
        $title=$request->input('title','');
        $order=$request->input('order','id');

        //接收页码
        $pp=$request->input('p',1);
        //是否为首页
        $first=$request->input('first');
        // 计算跳过条数
        $skip=($pp-1)*$limit;

        $with['startTime']=$startTime;
        $with['endTime']=$endTime;
        $with['title']=$title;
        $with['order']=$order;
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
        if($title!=''){
            $where[]=['title','=',$title];
        }
        $data = DB::table('notice')
            ->where($where)->skip($skip)->take($limit)->orderBy($order,'desc')->get();
        //计算总数
        $counts=DB::table('notice')->count();
        $pageCounts=$counts/$limit;
        $count=ceil($pageCounts);
        $where_json='';
        if(count($where)>1){
            $where_json=(string)json_encode($where);
        }

        $model = new NoticeModel();
        //获取设备类型
        $display_where = $model->display_where;
        //获取显示方式
        $display_type = $model->display_type;
        //分配模版变量
        $viewdata=['count'=>$count,'data'=>$data,'page'=>$pp,'counts'=>$counts,'where'=>$where_json,'display_where'=>$display_where,'display_type'=>$display_type];
        if(!empty($first)){
            $viewdata['first']=1;
        }
        return view('notice.notice_list',$viewdata)->with($with);
    }

    /**
     * @abstract 更改公告信息
     * @param object $request 请求的参数
     * @return  json  status:1成功 0失败   id:该记录id
     * @author  ttao
     * @version [2016-11-16]
     */
    public function changeNotice(Request $request) {

        $json=$id=$request->input('data');
        $arr=json_decode($json,true);
        $id=$arr['id'];
        unset($arr['id']);
        $res=DB::table('notice')->where('id',$id)->update($arr);
        if($res){
            $model = new NoticeModel();
            //获取设备类型
            $display_where = $model->display_where;
            //获取显示方式
            $display_type = $model->display_type;
            $arr['display_where'] = $display_where[$arr['display_where']];
            $arr['display_type'] = $display_type[$arr['display_type']];
            //写入日志
            $log = "更新了公告，ID：".$id;
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

    /**
     * @abstract 分页列表
     * @param int $p 页数
     * @param int $limit 煤业条数
     * @return  void 无返回
     * @author  ttao
     * @version [2016-11-16]
     */
    public function listpage($p=1,$limit=15) {
        $data=DB::table('notice')->skip($limit*$p)->take($limit)->get();
        $count=DB::table('notice')->count();
    }

    /**
     * @abstract 添加公告
     * @param obj Request 请求参数
     * @return  json status:1成功 0失败
     * @author  ttao
     * @version [2016-11-16]
     */
    public function addNotice(Request $request) {
        $json=$request->input('data');
        $arr=json_decode($json,true);
        $rule = [
            'title' => 'required',
            'content' => 'required',
            'deleted_at' => 'required'
        ];
        $messages = [
            'title.required' => '标题不能为空',
            'content.required' => '内容不能为空',
            'deleted_at.required' => '删除时间不能为空',
        ];
        $validator=Validator::make($arr,$rule,$messages);
        $arr['reseller_id']=\Auth::user()->reseller_id;
        $arr['created_by']=\Auth::user()->username;
        $arr['created_at']=date('Y-m-d H:i:s');
        $arr['updated_at']=date('Y-m-d H:i:s');
        if ($validator->fails())
        {
            $response = ['message'=>$validator->errors()->first(),'status'=>2,'url'=>''];
            return json_encode($response);
        }
        $res=DB::table('notice')->insert($arr);
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

    /**
     * @abstract 删除公告
     * @param object $request 请求的参数
     * @return  json  status 0:失败  1：成功
     * @author  ttao
     * @version [2016-11-16]
     */
    public function delNotice(Request $request) {
        $delid=$request->input('delid');
        $res=DB::table('notice')
            ->where('id', $delid)
            ->delete();
        $resArr=['status'=>0];
        if($res){
            //写入日志
            $log = "删除了公告，ID：".$delid;
            $adminlogModel = new AdminActionLogModel();
            $adminlogModel->description = $log;
            $adminlogModel->insertAdminLog();
            $resArr['status']=1;
        }
        return json_encode($resArr);
    }

    /**
     * @abstract 编辑公告
     * @param object $request 请求的参数
     * @return  json  data 结果集
     * @author  ttao
     * @version [2016-11-16]
     */
    public function selectNotice(Request $request) {
        $id=$request->input('editid');
        $data=DB::table('notice')->find($id);
        return json_encode($data);
    }

}
