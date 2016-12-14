<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use DB;
use Validator;
use Carbon\Carbon;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\BaseController as BaseController;

class UserController extends CommonController
{

    /**
     * 管理员列表
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request){
        //检查权限
        $this->check_permissin($this->route);

        //获取管理员数据
        $query = \App\Models\Admin::orderBy('id');
        if ($request->input('username'))
            $query->where('username','like','%'.$request->input('username').'%');
        $datas = $query->paginate(10);

        return view('users',['datas'=>$datas,'filter'=>$request->only(['username'])]);
    }

    /**
     * 添加管理员页面
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add(Request $request){
        //检查权限
        $this->check_permissin($this->route);

        $query = \App\Models\Admin::orderBy('id','desc');
//        if ($request->input('username'))
//            $query->where('username','like','%'.$request->input('username').'%');
//        $datas = $query->paginate(50);


        $datas = DB::table('admins')->where('admins.reseller_id',Auth::user()->id)->leftjoin('role_admin','role_admin.admin_id','=','admins.id')->leftjoin('admin_roles', 'role_admin.role_id', '=', 'admin_roles.id')->select("admins.*","admin_roles.display_name","admin_roles.id as roleid")->get();
        //dump($datas);exit;
        $model = new \App\Models\AdminRole();
        $roledata = $model->get();
        $role_arr = array();
        $permission_model = new \App\Models\AdminRolePermission();
        foreach ($roledata as $key=>$k){
            $midarrs = array();
            $role_arr[$key]['id'] =$k->id;
            $arrs =DB::table('admin_permission_role')->where('role_id', '=', intval($k->id))->select('permission_id')->get();
            foreach ($arrs as $arr){
                $midarrs[]=intval($arr->permission_id);
            }
            $role_arr[$key]['perm_arr'] = $midarrs;
            $role_arr[$key]['name'] =$k->name;
            $role_arr[$key]['display_name'] =$k->display_name;
            $role_arr[$key]['description'] =$k->description;
            $role_arr[$key]['reseller_id'] =$k->reseller_id;
        }
        $permission_data = $permission_model->get();

        $permission_modelmodel = new \App\Models\AdminRolePermission();
        $permission_all = $permission_modelmodel->get();

        return view('form-user',['datas'=>$datas,'filter'=>$request->only(['username']),'status'=>$roledata,'roledata'=>$role_arr,'page_name'=>'添加用户组','permission_data'=>$permission_data,'permission_all'=>$permission_all]);
    }

    /**
     * 添加管理员方法
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addHandle(Request $request){
        //检查权限
        $this->check_permissin($this->route);
        $rule = [
            'username' => 'required|max:30|unique:admins,username',
            'password' => 'required|min:6',
            'email' => 'required|email|unique:admins,email',
            'name' => 'required',
            'remark'=>'required',
            'status'=>'required',
        ];
        $rule_error = [
            'username.required' => '请填写用户名',
            'username.max' => '用户名长度不得超过30个字符',
            'username.unique' => '用户名已经存在',
            'password.required' => '请填写密码',
            'password.min' => '密码长度不得小于6个字符',
            'email.email' => '邮箱格式错误',
            'email.unique' => '邮箱已经存在',
            'email.required' => '请填写邮箱',
            'name.required' => '请填写姓名',
            'remark.required' => '请填写备注信息',
            'status.required' => '请选择是否允许登录',
        ];
        $validator = Validator::make($request->all(),$rule,$rule_error);

        if ($validator->fails())
        {
            $response = [
                'error' => $validator->errors()->first(),
                'status' => 2,
                'errorCode' => 'EC01'
            ];
            return response()->json($response);
        }
        $role_id = $request->input('role_id');
        if(empty($role_id)){
            $response = [
                'error' => '请选择权限组',
            ];
            return response()->json($response);
        }
        $level = Auth::user()->level+1;
        $insert = [
            'name' => $request->input('name'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'remark' => $request->input('remark'),
            'created_at' => Carbon::now(),
            'level' => $level,
            'website_status'=>$request->input('website_status'),
            'remember_token'=>$request->input('remember_token'),
            'domains'=>'www.pangu.com',
            'isreseller'=>0,
            'reseller_id'=>Auth::user()->id,
        ];
//        if (Auth::user()->id)
//            $insert['reseller_id'] = Auth::user()->reseller_id;
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
                $response = [
                    'success' => '管理员资料添加成功',
                    'status' => 1,
                    'url' => '/index'
                ];
                return response()->json($response);
            }

        }
        else{
            $response = [
                'error' => '管理员资料添加失败',
                'errorCode' => 'EC02',
                'status' => 2
            ];
            return response()->json($response);
        }
    }

    /**
     * 编辑管理员页面
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function edit(Request $request){
        //检查权限
        $this->check_permissin($this->route);

        //输入参数<验证>
        //数据合法性检验
        $rule = [
            'edit_username' => 'required',
            'edit_password' => 'min:6',
            'edit_name' => 'required',
        ];
        $messages = [
            'edit_username.required' => '请填写用户名',
//            'username.unique' => '用户名已经存在',
            'edit_password.min' => '密码长度不得小于6个字符',
            'edit_name.required' => '请填写姓名',
        ];
        $validator = Validator::make($request->all(),$rule,$messages);
        if ($validator->fails())
        {
            $response = [
                'error' => $validator->errors()->first(),
            ];
            return response()->json($response);
        }
        //操作<更新>
        $update = [
            'name' => $request->input('edit_name'),
            'username' => $request->input('edit_username'),
            'updated_at' => Carbon::now()
        ];
        if ($request->input('password')){
            $update['password'] = bcrypt($request->input('password'));
        }
        if ($has_update = \App\Models\Admin::where('id','=',$request->input('edit_id'))->update($update))
        {
            //添加日志
            $description= '编辑管理员 : ' . $request->input('edit_username') . ',ID : ' . $request->input('edit_id');
            $this->add_admin_log($description);
            return '管理员资料修改成功';
        }else{
/*            $response = [
                'error' => '管理员资料修改失败',
                'url' => '',
                'status' => 2
            ];*/
            return '管理员资料修改失败';
        }

        $id = intval($id);

        $data = \App\Models\Admin::find(intval($id));

        return view('edit-user',['data'=>$data]);
    }

    /**
     * 编辑管理员方法
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function editHandle(Request $request){
        //检查权限
        $this->check_permissin($this->route);

        //数据合法性检验
        $rule = [
            'username' => 'required|unique:admins,username,' . $request->input('id'),
            'password' => 'min:6',
            'email' => 'required|email|unique:admins,email,' . $request->input('id'),
            'name' => 'required',
            'remark' => 'required'
        ];
        $messages = [
            'username.required' => '请填写用户名',
            'username.unique' => '用户名已经存在',
            'password.min' => '密码长度不得小于6个字符',
            'email.required' => '请填写邮箱',
            'email.email' => '邮箱格式错误',
            'email.unique' => '邮箱已经存在',
            'name.required' => '请填写姓名',
            'remark.required' => '请填写备注信息'
        ];
        $validator = Validator::make($request->all(),$rule,$messages);
        if ($validator->fails())
        {
            $response = [
                'error' => $validator->errors()->first(),
                'status' => 2,
                'url' => ''
            ];
            return response()->json($response);
        }
        //更新字段设置
        $update = [
            'name' => $request->input('name'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'status' => $request->input('status',0),
            'remark' => $request->input('remark'),
            'updated_at' => Carbon::now()
        ];
        if ($request->input('password'))
            $update['password'] = bcrypt($request->input('password'));
        if ($has_update = \App\Models\Admin::where('id','=',$request->input('id'))->where('level','>',Auth::user()->level)->update($update))
        {
            //重新设置所属用户组(角色)
            if ($request->input('role_id',0))
            {
                DB::table('role_admin')->where('admin_id','=',$request->input('id'))->delete();
                $role = [
                    'admin_id' => $request->input('id'),
                    'role_id' => $request->input('role_id')
                ];
                DB::table('role_admin')->insert($role);
            }

            //添加日志
            $description='编辑管理员 : ' . $request->input('username') . ',ID : ' . $request->input('id');
            $this->add_admin_log($description);

            $response = [
                'success' => '管理员资料修改成功',
                'url' => '',
                'status' => 1
            ];
            return response()->json($response);
        }
        else{
            $response = [
                'error' => '管理员资料修改失败',
                'url' => '',
                'status' => 2
            ];
            return response()->json($response);
        }
    }

    /**
     * 删除管理员
     * @param Request $request
     */
    public function deleteHandle(Request $request){
        //检查权限
        $this->check_permissin($this->route);

        $id = intval($request->input('id'));
        if (isset($id))
        {
            $username = DB::table('admins')->where('id','=',$id)->value('username');
            $is_deleted = DB::table('admins')->where('id','=',$id)->delete();
            $isrole_deleted = DB::table('role_admin')->where('admin_id','=',$id)->delete();
            if ($is_deleted && $isrole_deleted)
            {

                //添加日志
                $description='删除管理员 : ' . $username . ',ID : ' . intval($id);
                $this->add_admin_log($description);

                echo '删除成功';
            }
            else{
                echo '删除失败';
            }
        }
        else{
           echo '删除失败';
        }

    }

    /**
     * 添加用户组(角色)视图
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function addRole(){
        //检查权限
        $this->check_permissin($this->route);

        $data = new \App\Models\AdminRole();
        return view('form-role',['data'=>$data,'page_name'=>'添加用户组']);
    }

    /**
     * 添加用户组(角色)操作
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addRoleHandle(Request $request){
        //检查权限
        $this->check_permissin($this->route);
        $allpermisson =$request->input('allpermisson');
        //dump($request);exit;
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
            $response = [
                'error' => $validator->errors()->first(),
            ];
            return response()->json($response);
        }
        if(empty($allpermisson)){
            $response = [
                'error' => '请选择权限',
            ];
            return response()->json($response);
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

            $response = [
                'success' => '用户组添加成功!',
                'status' => 1,
                'url' => '/index'
            ];
            return response()->json($response);

        }
        else{
            $response = [
                'error' => '用户组添加失败',
                'status' => 2,
                'errorCode' => 'EC03'
            ];
            return response()->json($response);
        }
    }

    /**
     * 编辑角色
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editRole($id){
        //检查权限
        $this->check_permissin($this->route);

        $data = \App\Models\AdminRole::find(intval($id));
        return view('edit-role',['data'=>$data]);
    }

    /**
     * 编辑角色方法
     * @param Request $request
     */
    public function editRoleHandle(Request $request){
        //检查权限
        $this->check_permissin('edit-role');

        $roleid= intval($request->input('roleid'));
        $roledisplayname= $request->input('roledisplayname');
        $description= $request->input('description');
        $rolename= $request->input('rolename');
        $ischeck = $request->input('arr');

        $rule = [
            'rolename' => 'required',
            'roledisplayname' => 'required',
            'description' => 'required',
            'arr' => 'required',
        ];
        $messages = [
            'rolename.required' => '请填写用户组标识符',
            'roledisplayname.required' => '请填写用户组名称',
            'description.required' => '请填写用户组描述',
            'arr.required' => '请选择用户组权限',
        ];
        $validator = Validator::make($request->all(),$rule,$messages);
        if ($validator->fails())
        {
            $response = [
                'error' => $validator->errors()->first(),
            ];
            return response()->json($response);
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

            echo '用户组编辑成功';
        }
        else{
            echo '用户组编辑失败';
        }
    }

    /**
     * 删除角色
     * @param Request $request
     */
    public function deleteRoleHandle(Request $request){
        //检查权限
        $this->check_permissin($this->route);

        $id= intval($request->input('id'));
        if (isset($id))
        {
            $display_name = DB::table('admin_roles')->where('id','=',$id)->value('display_name');
            $is_delete = DB::table('admin_roles')->where('id','=',$id)->delete();
            $ispermissin_delete = DB::table('admin_permission_role')->where('role_id','=',$id)->delete();
            if ($is_delete && $ispermissin_delete)
            {
                //添加日志
                $description= '删除用户组 : ' . $display_name . ',ID : ' . intval($id);
                $this->add_admin_log($description);

                echo '删除成功';exit;
            }
            else{
                echo '删除失败';exit;
            }
        }
        else{
           echo '删除失败';exit;
        }


    }

    /**
     * 权限列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function permissions(){
        //检查权限
        $this->check_permissin($this->route);

        $datas = \App\Models\AdminRolePermission::get();
        return view('permissions',['datas'=>$datas]);
    }

    /**
     * 添加权限节点视图
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addPermission(){
        //检查权限
        $this->check_permissin($this->route);

        $data = new \App\Models\AdminRolePermission();
        return view('form-permission',['data' => $data, 'page_name' => '添加权限']);
    }

    /**
     * 添加权限节点操作
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function addPermissionHandle(Request $request){
        //检查权限
        $this->check_permissin($this->route);

        $rule = [
            'name' => 'required|unique:admin_permissions|string',
            'display_name' => 'required|unique:admin_permissions',
            'description'=>'required',
        ];
        $messages = [
            'name.required' => '请填写权限标识符',
            'name.unique' => '权限标识符已经存在',
            'name.string' => '权限标识符格式错误',
            'display_name.required' => '请填写名称',
            'display_name.unique' => '该名称已经存在',
            'description.required' => '请填写权限标识符描述',
        ];
        $validator = Validator::make($request->all(),$rule,$messages);
        if ($validator->fails())
        {
            $response = [
                'error' => $validator->errors()->first(),
                'status' => 2,
                'url' => ''
            ];
            return response()->json($response);
        }
        $insert = [
            'name' => $request->input('name'),
            'display_name' => $request->input('display_name'),
            'description' => $request->input('description'),
            'created_at' => Carbon::now()
        ];
        if ($insert_id = \App\Models\AdminRolePermission::insertGetId($insert))
        {
            //添加日志
            $description='添加权限 : ' . $request->input('display_name') . ',ID : ' . $insert_id;
            $this->add_admin_log($description);

            $response = [
                'success' => '权限添加成功',
                'status' => 1,
                'url' => '/index',
            ];
            return $response;
        }
        else{
            $response = [
                'error' => '权限添加失败',
                'status' => 2,
                'url' => ''
            ];
            return response()->json($response);
        }
    }

    /**
     * 编辑权限
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function editPermission($id){
        //检查权限
        $this->check_permissin($this->route);

        $id = intval($id);
        if ($id == 0)
        {
            $response = [
                'error' => '参数错误',
                'status' => 2,
                'url' => '/permissions'
            ];
            return response()->json($response);
        }
        $data = \App\Models\AdminRolePermission::find(intval($id));
        return view('edit-permission',['data'=>$data]);
    }

    /**
     * 编辑权限方法
     * @param Request $request
     */
    public function editPermissionHandle(Request $request){
        //检查权限
        $this->check_permissin($this->route);

        $rule = [
            'permissiondisplayname' => 'required',
            'permissionname' => 'required',
            'permissiondescription' => 'required',

        ];
        $messages = [
            'permissiondisplayname.required' => '请填写名字',
            'permissionname.required' => '请填写权限标识符',
            'permissiondescription.required' => '请填写描述',
        ];
        $validator = Validator::make($request->all(),$rule,$messages);
        if ($validator->fails())
        {
            $response = [
                'error' => $validator->errors()->first(),
            ];
            return response()->json($response);
        }
        $update = [
            'name' => $request->input('permissionname'),
            'display_name' => $request->input('permissiondisplayname'),
            'description' => $request->input('permissiondescription'),
            'updated_at' => Carbon::now()
        ];
        if ($has_updated = \App\Models\AdminRolePermission::where('id','=',$request->input('permissionid'))->update($update))
        {
            //添加日志
            $description= '编辑权限 : ' . $request->input('display_name') . ',ID : ' . $request->input('id');
            $this->add_admin_log($description);

            echo "权限编辑成功";exit;

        }
        else{
            echo "权限编辑失败";exit;
        }

    }

    /**
     * 删除权限
     * @param Request $request
     */
    public function deletePermissionHandle(Request $request){
        //检查权限
        $this->check_permissin($this->route);

        $id = intval($request->input('id'));

        if (isset($id))
        {
            $display_name = DB::table('admin_permissions')->where('id','=',$id)->value('display_name');
            if ($has_delete = DB::table('admin_permissions')->where('id','=',$id)->delete())
            {

                //添加日志
                $description='删除权限 : ' . $display_name . ',ID : ' . $id;
                $this->add_admin_log($description);

                echo '删除成功';
            }
            else{
                echo '删除失败';
            }
        }
        else{
            echo '删除失败';
        }
    }

    /**
     * 注销帐号
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout(){
        Auth::logout();
        return redirect('/login');
    }

    /**
     * 登陆日志列表视图
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function loginLog(Request $request){
        //检查权限
        $this->check_permissin($this->route);

        $query = DB::table('admin_login_log')->where('isreseller','=',Auth::user()->isreseller)->orderBy('login_time','desc');
        if ($request->input('username'))
            $query->where('username','like','%'.$request->input('username').'%');
        $datas= $query->paginate(20);
        return view('user-login-log',['datas'=>$datas,'filter'=>$request->only(['username'])]);
    }

    /**
     * 操作日志列表视图
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function activeLog(Request $request){
        //检查权限
        $this->check_permissin($this->route);

        $query = DB::table('admin_active_log')->where('isreseller','=',Auth::user()->isreseller)->orderBy('created_at','desc');
        if ($request->input('username'))
            $query->where('username','like','%'.$request->input('username').'%');
        $datas= $query->paginate(20);
        return view('user-active-log',['datas'=>$datas,'filter'=>$request->only(['username'])]);
    }
}
