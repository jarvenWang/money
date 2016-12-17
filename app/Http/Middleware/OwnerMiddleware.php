<?php

namespace App\Http\Middleware;

use App\Models\Admin;
use App\Models\AdminRole;
use DB;
use App\Http\Controllers\Controller;
use App\Models\Role;
use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Cache;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
class OwnerMiddleware
{
    //用到资源型路由的控制器
    protected $owner_arr = array(
        'admin','permission','role','transfer'
    );
    /**
     * 判断权限
     * @authr wjb
     * @date 2016/12/8
     * @param Request $request
     * @param Closure $next
     * @return \Illuminate\Http\JsonResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $input = $request->all();
        $user = JWTAuth::toUser($input['token']);
        $admin_exist = DB::table("admins")->where('id', '=', $user->id)->first();
        if($admin_exist){
            //管理员存在
            $role_exist = DB::table("role_admin")->where('admin_id',$admin_exist->id)->first();
            if($role_exist){
                //权限组存在
                $permission_exist = DB::table("admin_permission_role")->where('role_id',$role_exist->role_id)->first();
                if($permission_exist){
                    $admins = Admin::find($user->id)->belongsToManyAdminRole()->get();
                    foreach ($admins as $admin) {
                        $role_id = $admin->id;
                    }
                    $permissions =AdminRole::find($role_id)->belongsToManyAdminRolePermission()->get();
                    foreach ($permissions as $permission) {
                        $permission_arr[] = $permission->name;
                    }
                    $route = substr($request->path(),3);
                    $a = explode('/',$route);
                    $count =max(array_flip($a));
                    $ajax_type = $_SERVER['REQUEST_METHOD'];

                    $route_exist=substr($route,1);
                    //判断控制器的post请求是否在规则数组中
                    if(in_array($route_exist,$this->owner_arr)){
                        //存在数组中，则进行路由重构
                        if($ajax_type=='POST'){
                            $route = $route.'/post';
                        }
                        if(!in_array($route,$permission_arr)){
                            $arr = array(
                                'status'=>'error',
                                'code'=>'509',
                                'msg'=>'没有权限'
                            );
                            return response()->json($arr);
                        }
                    }
                    if(is_numeric($a[$count])){
                        if($ajax_type=='PUT'){
                            $re_route = str_replace($a[$count],'*/put',$route);
                        }else if($ajax_type=='DELETE'){
                            $re_route = str_replace($a[$count],'*/delete',$route);
                        }
                        if(!in_array($re_route,$permission_arr)){
                            $arr = array(
                                'status'=>'error',
                                'code'=>'509',
                                'msg'=>'没有权限'
                            );
                            return response()->json($arr);
                        }
                    }else if(!in_array($route,$permission_arr)){
                        $arr = array(
                            'status'=>'error',
                            'code'=>'509',
                            'msg'=>'没有权限'
                        );
                        return response()->json($arr);
                    }
                    return $next($request);
                }else{
                    //权限组拥有的权限不存在
                    $arr = array(
                        'status'=>'0',
                        'code'=>"509",
                        'msg'=>'权限组拥有的权限不存在'
                    );
                    return response()->json($arr);
                }
            }else{
                //所属权限组不存在
                $arr = array(
                    'status'=>'0',
                    'code'=>"509",
                    'msg'=>'所属权限组不存在'
                );
                return response()->json($arr);
            }
        }else{
            //管理员不存在
            $arr = array(
                'status'=>'0',
                'code'=>"509",
                'msg'=>'管理员不存在'
            );
            return response()->json($arr);
        }
    }
}
