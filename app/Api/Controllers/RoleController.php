<?php

namespace App\Api\Controllers;

use App\Models\Admin;
use App\Models\Role;
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

class RoleController extends Controller
{
    /**
     * 权限组列表
     * @author wjb
     * @date 2016/12/12
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        //当面页数
        $page = $request->input('page');
        $page =isset($page)?$page:1;
        //每页显示几条数据
        $num =$request->input('num');
        $num =isset($num)?$num:10;

        $display_name = $request->input('display_name');
        $name = $request->input('name');

        $where =array();
        if($display_name !=''){
            $where['display_name']=$display_name;
        }
        if($name !=''){
            $where['name']=$name;
        }
        //获取管理员数据
        $count = Role::count();
        //获取管理员数据
        $datas = Role::where($where)->simplePaginate($num,['*'],'page', $page);

        $columns = getColumnList('admin_roles');
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
     * 新增权限组
     * @author wjb
     * @date 2016/12/12
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $allpermisson =$request->input('allpermisson');
        //检验提交数据合法性
        $rule = [
            'name' => 'required|string',
            'display_name' => 'required',
            'description' => 'required',
        ];
        $messages = [
            'name.required' => '请填写用户组标识符',
            'name.string' => '用户组标识符格式错误，只支持字符串',
            'display_name.required' => '请填写显示名',
            'description.required' => '请填写用户组说明',
        ];
        $validator = Validator::make($request->all(),$rule,$messages);
        if ($validator->fails())
        {
            $arr = array(
                'status'=>'0',
                'code'=>'510',
                'msg'=>$validator->errors()->first()
            );
            return response()->json($arr);
        }
        if(empty($allpermisson)){
            $arr = array(
                'status'=>'0',
                'code'=>'519',
                'msg'=>$this->error_code['519']
            );
            return response()->json($arr);
        }
        //插入数据
        $insert = [
            'name' => $request->input('name'),
            'display_name' => $request->input('display_name'),
            'description' => $request->input('description'),
            'reseller_id' => Auth::user()->reseller_id,
            'created_at' => Carbon::now()
        ];

        $roleid = $insert_id = \App\Models\AdminRole::insertGetId($insert);

        foreach ($allpermisson as $key=>$val){
            $add = [
                'role_id' => $roleid,
                'permission_id' =>  $val,
            ];
            $res =  DB::table('admin_permission_role')->insert($add);
        }

        if ($res)
        {
            //添加日志
            $description='添加用户组 : ' . $request->input('display_name') . ',ID : ' . $insert_id;
            $this->add_admin_log($description);

            //提示码
            $number = 108;
            //返回数组
            $array = array(
                'id'=>$insert_id,
            );
            $arr = $this->msg_success($number,$array);
            return response()->json($arr);
        }
        else{
            $number = 523;
            $arr = $this->msg_error($number);
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
     * 编辑角色方法
     * @author wjb
     * @date 2016/12/13
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $roleid= intval($id);
        $result = Role::where('id',$id)->first();
        if(!$result){
            $arr = array(
                'status'=>'0',
                'code'=>"521",
                'msg'=>$this->error_code['521']
            );
            return response()->json($arr);
        }
        $roledisplayname= $request->input('roledisplayname');
        $description= $request->input('description');
        $rolename= $request->input('rolename');
        $ischeck = $request->input('allpermisson');

        $rule = [
            'rolename' => 'required',
            'roledisplayname' => 'required',
            'description' => 'required',
            'allpermisson' => 'required',
        ];
        $messages = [
            'rolename.required' => '请填写用户组标识符',
            'roledisplayname.required' => '请填写用户组名称',
            'description.required' => '请填写用户组描述',
            'allpermisson.required' => '请选择用户组权限',
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
        $has_del = DB::table('admin_permission_role')->where('role_id','=',$roleid)->delete();
        if($has_del){
            foreach ($ischeck as $item) {
                $add = [
                    'role_id' => $roleid,
                    'permission_id' =>  $item,
                ];
                $res =  DB::table('admin_permission_role')->insert($add);
            }
        }
        $update_role = array(
            'name'=>$rolename,
            'display_name'=>$roledisplayname,
            'description'=>$description,
            'updated_at' => Carbon::now()
        );
        $res_update = DB::table('admin_roles')->where('id','=',$roleid)->update($update_role);


        if ($res || $res_update)
        {
            //添加日志
            $description='编辑用户组 : ' . $roledisplayname . ',ID : ' . $roleid;
            $this->add_admin_log($description);

            //{{
            //提示码
            $number = 110;
            $edit_arrs = Role::where('id',$id)->get();
            $columns = getColumnList('admin_roles');
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
     * 删除权限组
     * @author wjb
     * @date 2016/12/13
     * @param $id
     */
    public function destroy($id)
    {
        $result = Role::where('id',$id)->first();
        if(!$result){
            $arr = array(
                'status'=>'0',
                'code'=>"521",
                'msg'=>$this->error_code['521']
            );
            return response()->json($arr);
        }
        if (isset($id))
        {
            $display_name = DB::table('admin_roles')->where('id','=',$id)->value('display_name');
            $is_delete = DB::table('admin_roles')->where('id','=',$id)->delete();
            $ispermissin_delete = DB::table('admin_permission_role')->where('role_id','=',$id)->delete();
            if ($is_delete || $ispermissin_delete)
            {
                //添加日志
                $description= '删除用户组 : ' . $display_name . ',ID : ' . intval($id);
                $this->add_admin_log($description);

                //{{
                //提示码
                $number = 109;
                //返回数组
                $array = intval($id);
                $arr = $this->msg_success($number,$array);
                return response()->json($arr);
                //}}
            }
            else{
                //删除失败
                $arr = array(
                    'status'=>'0',
                    'code'=>"522",
                    'msg'=>$this->error_code['522']
                );
                return response()->json($arr);
            }
        }
        else{
            //删除失败
            $arr = array(
                'status'=>'0',
                'code'=>"522",
                'msg'=>$this->error_code['522']
            );
            return response()->json($arr);
        }
    }
}
