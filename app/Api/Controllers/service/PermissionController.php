<?php

namespace App\Api\Controllers\service;

use App\Models\AdminRolePermission;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Validator;
use Auth;

class PermissionController extends Controller
{
    /**
     * 权限列表
     * @author wjb
     * @date 2016/12/13
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
        $count = AdminRolePermission::where($where)->count();
        //获取管理员数据
        $datas = AdminRolePermission::where($where)->simplePaginate($num,['*'],'page', $page);
        $columns = getColumnList('admin_permissions');
        foreach ($datas as $key=>$data){
            foreach ($columns as $column) {
                $arr_admin[$key]["$column"]=$data->$column;
            };
            $arr_admin[$key]["status"]=0;
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
     * 权限添加
     * @author wjb
     * @date 2016/12/13
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $rule = [
            'name' => 'required|unique:admin_permissions|string',
            'display_name' => 'required|unique:admin_permissions',
            //'description'=>'required',
        ];
        $messages = [
            'name.required' => '请填写权限标识符',
            'name.unique' => '权限标识符已经存在',
            'name.string' => '权限标识符格式错误',
            'display_name.required' => '请填写名称',
            'display_name.unique' => '该名称已经存在',
            //'description.required' => '请填写权限标识符描述',
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
        $insert = [
            'name' => $request->input('name'),
            'display_name' => $request->input('display_name'),
            //'description' => $request->input('description'),
            'created_at' => Carbon::now()
        ];
        if ($insert_id = \App\Models\AdminRolePermission::where('id',19)->update($insert))
        {
            //添加日志
            $description='添加权限 : ' . $request->input('display_name') . ',ID : ' . $insert_id;
            $this->add_admin_log($description);

            //提示码
            $number = 111;
            //返回数组
            $array = $insert;
            $array['id'] = $insert_id;
            $arr = $this->msg_success($number,$array);
            return response()->json($arr);
        }
        else{
            $number = 524;
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
     * 权限编辑
     * @author wjb
     * @date 2016/12/13
     * @param Request $request
     * @param $id
     */
    public function update(Request $request, $id)
    {
        $rule = [
            'display_name' => 'required',
            'name' => 'required',
            //'description' => 'required',

        ];
        $messages = [
            'display_name.required' => '请填写名字',
            'name.required' => '请填写权限标识符',
            //'description.required' => '请填写描述',
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

        $update = [
            'name' => $request->input('name'),
            'display_name' => $request->input('display_name'),
            //'description' => $request->input('description'),
            'updated_at' => Carbon::now()
        ];

        if ($has_updated = \App\Models\AdminRolePermission::where('id',$id)->update($update))
        {
            //添加日志
            $description= '编辑权限 : ' . $request->input('display_name') . ',ID : ' . $id;
            $this->add_admin_log($description);
            //提示码
            $number = 112;
            //返回数组
            $array = array(
                'id'=>$id,
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
     * 删除权限
     * @author wjb
     * @date 2016/12/13
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $user = Auth::user();
        $admin_id = $user->id;
        if (isset($id))
        {
            $display_name = DB::table('admin_permissions')->where('id','=',$id)->value('display_name');
            if(!$display_name){
                $arr = array(
                    'status'=>'0',
                    'code'=>"525",
                    'msg'=>'删除的权限不存在'
                );
                return response()->json($arr);
            }
            $has_delete = DB::table('admin_permissions')->where('id','=',$id)->delete();
            $has_role_delete = DB::table('admin_permission_role')->where('role_id','=',$admin_id)->where('permission_id','=',$id)->delete();
            if ($has_delete || $has_role_delete)
            {

                //添加日志
                $description='删除权限 : ' . $display_name . ',ID : ' . $id;
                $this->add_admin_log($description);

                //{{
                //提示码
                $number = 109;
                //返回数组
                $array = array(
                    'id'=>$id,
                );
                $arr = $this->msg_success($number,$array);
                return response()->json($arr);
                //}}
            }
            else{
                $number = 522;
                $arr = $this->msg_error($number);
                return response()->json($arr);
            }
        }
        else{
            $number = 522;
            $arr = $this->msg_error($number);
            return response()->json($arr);
        }
    }
}
