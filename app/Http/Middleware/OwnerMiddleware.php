<?php

namespace App\Http\Middleware;

use App\Models\Admin;
use App\Models\AdminRole;
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
        'admin','permission','role',
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
        $admins = Admin::where('id', '=', $user->id)->find(1)->belongsToManyAdminRole()->get();
        foreach ($admins as $admin) {
            $role_id = $admin->id;
        }
        $permissions =AdminRole::where('id', '=', $role_id)->find(1)->belongsToManyAdminRolePermission()->get();
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
    }
}
