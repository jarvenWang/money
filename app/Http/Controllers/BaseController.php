<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

use App\Http\Requests;


class BaseController extends Controller
{
    /*
     * current_route : 当前请求的路由名称,用来进行权限判断
     * user : 当前用户对象
     * */
    protected $route;
    protected $user;
    public function __construct()
    {
        //获取当前路由
        $full = explode('/',str_replace('http://','',url()->current()));
        $len = count($full)-1;
        $this->route = $full[$len];
    }
}
