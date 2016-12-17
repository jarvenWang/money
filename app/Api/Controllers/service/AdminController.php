<?php

namespace App\Api\Controllers\service;

use App\Models\Admin;
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

class AdminController extends Controller
{

    /**
     * 编辑管理员方法
     * @author wjb
     * @date 2016/12/11
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $result = Admin::where('id',$id)->first();
        if(!$result){
            $arr = array(
                'status'=>'0',
                'code'=>"515",
                'msg'=>'准备编辑的管理员不存在'
            );
            return response()->json($arr);
        }
        //数据合法性检验
        $rule = [
            'username' => 'required|unique:admins,username,' . $id,
            'password' => 'min:6',
            //'email' => 'required|email|unique:admins,email,' . $id,
            'name' => 'required',
            //'remark' => 'required'
            'status'=>'required',
        ];
        $messages = [
            'username.required' => '请填写用户名',
            'username.unique' => '用户名已经存在',
            'password.min' => '密码长度不得小于6个字符',
            //'email.required' => '请填写邮箱',
            //'email.email' => '邮箱格式错误',
            'email.unique' => '邮箱已经存在',
            'name.required' => '请填写姓名',
            //'remark.required' => '请填写备注信息'
            'status.required' => '请选择是否允许登录',
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

        if(empty($request->input('role_id'))){
            $arr = array(
                'status'=>'0',
                'code'=>"516",
                'msg'=>$this->error_code['516']
            );
            return response()->json($arr);
        }

        $res_role = DB::table("admin_roles")->where('id','=',$request->input('role_id'))->find(1);

        if(empty($res_role)){
            $arr = array(
                'status'=>'0',
                'code'=>"517",
                'msg'=>$this->error_code['517']
            );
            return response()->json($arr);
        }
        //更新字段设置
        $update = [
            'name' => $request->input('name'),
            'username' => $request->input('username'),
            //'email' => $request->input('email'),
            'status'=>$request->input('status'),
            //'remark' => $request->input('remark'),
            'updated_at' => Carbon::now()
        ];
        if ($request->input('password'))
            $update['password'] = bcrypt($request->input('password'));
        if ($has_update = \App\Models\Admin::where('id','=',$id)->update($update))
        {
            //重新设置所属用户组(角色)
            if ($request->input('role_id',0))
            {
                DB::table('role_admin')->where('admin_id','=',$id)->delete();
                $role = [
                    'admin_id' => $id,
                    'role_id' => $request->input('role_id')
                ];
                DB::table('role_admin')->insert($role);
            }

            //添加日志
            $description='编辑管理员 : ' . $request->input('username') . ',ID : ' . $request->input('id');
            $this->add_admin_log($description);

            //{{
            //提示码
            $number = 107;
            $edit_arrs = Admin::where('id',$id)->get();
            $columns = getColumnList('admins');
            foreach ($edit_arrs  as $key=>$data){
                foreach ($columns as $column) {
                    $arr_admin[$key]["$column"]=$data->$column;
                };
            };
            //返回数组
            $array = $arr_admin;
            $arr = $this->msg_success($number,$array);
            return response()->json($arr);
            //}}
        }
        else{
            $number = 523;
            $arr = $this->msg_error($number);
            return response()->json($arr);
        }
    }

    /**
     * 制作验证码
     * @author wjb
     * @date 2016/12/7
     */
    public function makecode(Request $request){
        //生成验证码图片的Builder对象，配置相应属性
        $builder = new CaptchaBuilder;
        $builder->build($width = 100, $height = 30, $font = null);
        $phrase = $builder->getPhrase();
        $filename=time().'.jpg';
        //生成图片
        $builder->save("images/".$filename);
        //{{
        //提示码
        $number = 103;
        //返回数组
        $array = array(
            'backcode'=>$phrase,
            "url"=>"http://".$_SERVER['SERVER_ADDR']."/images/".$filename,
            "type"=>'get',
        );

        $arr = $this->msg_success($number,$array);
        //}}
        return response()->json($arr);
    }

    /**
     * 管理员列表
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request){
        //当面页数
        $page = $request->input('page');
        $page =isset($page)?$page:1;
        //每页显示几条数据
        $num =$request->input('num');
        $num =isset($num)?$num:10;

        $username = $request->input('username');
        $name = $request->input('name');

        $status = $request->input('status');
        $where =array();
        if($username !=''){
            $where['username']=$username;
        }
        if($name !=''){
            $where['name']=$name;
        }
        if($status!=''){
            $where['status']=$status;
        }

        //获取管理员数据
        $count = Admin::where($where)->count();
        //获取管理员数据
        $datas = Admin::where($where)->simplePaginate($num,['*'],'page', $page);
        //print_r($datas);exit;
        $columns = getColumnList('admins');
        foreach ($datas as $key=>$data){
            foreach ($columns as $column) {
                $arr_admin[$key]["$column"]=$data->$column;
            };
            $res = DB::table("role_admin")->where("admin_id",$data->id)->leftjoin('admin_roles','role_admin.role_id','=','admin_roles.id')->select('admin_roles.id','admin_roles.display_name')->get();
            //print_r($res);
            foreach ($res as $k=>$v){
                $arr_admin[$key]["role_name"]=$v->display_name;
                $arr_admin[$key]["role_id"]=$v->id;
            }
        };
        //$arr_admin['count']=$count;
        //提示码
        $number = 104;
        //返回数组
        $array = $arr_admin;
        $arr = $this->msg_success($number,$array,$count);
        return response()->json($arr);

    }
    /**
     * 新增管理员
     * @author wjb
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {

        $rule = [
            'username' => 'required|max:30|unique:admins,username',
            'password' => 'required|min:6',
            'name' => 'required',
            //'remark'=>'required',
            'status'=>'required',
        ];
        $rule_error = [
            'username.required' => '请填写用户名',
            'username.max' => '用户名长度不得超过30个字符',
            'username.unique' => '用户名已经存在',
            'password.required' => '请填写密码',
            'password.min' => '密码长度不得小于6个字符',
            'name.required' => '请填写姓名',
            //'remark.required' => '请填写备注信息',
            'status.required' => '请选择是否允许登录',
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
        $admin = JWTAuth::toUser($request->input('token'));
        //选择角色的id
        $role_id = $request->input('role_id');
        if(empty($role_id)){
            $arr = array(
                'status'=>'0',
                'code'=>'511',
                'msg'=>$this->error_code['511']
            );
            return response()->json($arr);
        }
        $level = $admin->level+1;
        $insert = [
            'name' => $request->input('name'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            //'remark' => 1,
            'created_at' => Carbon::now(),
            'level' => $level,
            'website_status'=>1,
            'remember_token'=>1,
            'domains'=>'www.pangu.com',
            'isreseller'=>0,
            'reseller_id'=>$admin->id,
            'status'=>$request->input('status'),
        ];

        if ($insert_id = DB::table('admins')->insertGetId($insert))
        {
            if ($request->input('role_id',0))
            {
                $role = [
                    'admin_id' => $insert_id,
                    'role_id' => $request->input('role_id')
                ];
                $res=DB::table('role_admin')->insert($role);
            }
            //添加操作日志
            $description='添加管理员 : ' . $request->input('username') . ',ID : ' . $insert_id;
            $this->add_admin_log($description);
            if($res){
                //提示码
                $number = 105;
                //返回数组
                $array = array(
                    'id'=>$insert_id,
                );
                $arr = $this->msg_success($number,$array);
                return response()->json($arr);
            }

        }
        else{
            $number = 512;
            $arr = $this->msg_error($number);
            return response()->json($arr);
        }
    }

    /**
     * 登陆
     * @author wjb
     * @date 2016/12/7
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $code = $request->input(['code']);
        if(empty($code)){
            $number = 501;
            $arr = $this->msg_error($number);
            return response()->json($arr);
        }else{
            $input = $request->all();
            unset($input['code']);
            if (!$token = JWTAuth::attempt($input)) {
                $number = 503;
                $arr = $this->msg_error($number);
                return response()->json($arr);
            }else{
                //{{
                //提示码
                $number = 101;
                //返回数组
                $array = array(
                    'token'=>$token,
                );
                $arr = $this->msg_success($number,$array);
                return response()->json($arr);
                //}}
            }
        }


    }




    /**
     * 删除管理员
     * @author wjb
     * @date 2016/12/11
     * @param Request $request
     */
    public function destroy(Request $request,$id)
    {
        if (isset($id))
        {
            $result = Admin::where('id',$id)->first();
            if(!$result){
                $arr = array(
                    'status'=>'0',
                    'code'=>"514",
                    'msg'=>'准备删除的管理员不存在'
                );
                return response()->json($arr);
            }
            $is_deleted = DB::table('admins')->where('id','=',$id)->delete();
            $isrole_deleted = DB::table('role_admin')->where('admin_id','=',$id)->delete();
            if ($is_deleted || $isrole_deleted)
            {
                //添加日志
                $description='删除管理员 : ' . $result['username'] . ',ID : ' . intval($id);
                $this->add_admin_log($description);
                //{{
                //提示码
                $number = 106;
                //返回数组
                $array = array(
                    'id'=>$id,
                );
                $arr = $this->msg_success($number,$array);
                return response()->json($arr);
                //}}
            }
            else{
                $number = 513;
                $arr = $this->msg_error($number);
                return response()->json($arr);
            }
        }
        else{
            $number = 513;
            $arr = $this->msg_error($number);
            return response()->json($arr);
        }
    }


}