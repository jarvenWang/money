<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class BaseMemberController extends Controller
{
    public $view_data=[];
    public $need_request=[];
    public $request;

    public function __construct() {
        $this->request=app('request');
    }

    //
    public function _where($need_request=[]) {

        if(!count($need_request)){
            $need_request=['start_time','end_time','user_name'];
        }
        foreach ($need_request as $v) {
            $$v=$this->request->input($v,'');
        }
        $where=$with=[];
        if ($start_time != '') {
            $where[] = ['updated_at', '>', $start_time];
            $with['updated_at']=$start_time;
        }
        if ($end_time != '') {
            $where[] = ['end_time', '<', $end_time];
            $with['updated_at']=$end_time;

        }
        if ($user_name != '') {
            $where[] = ['username', '=', $user_name];
            $with['username']=$user_name;
        }
        $res['with']=$with;
        $res['where']=$where;
        return $res;

    }


    public  function _list() {

        $where=$this->_where();
        dd($where);

        //接收查询条件
        $limit = $this->request->input('limit', 15);
        //接收页码
        $pp = $this->request->input('p', 1);
        //是否为首页
        $first = $this->request->input('first');
        // 计算跳过条数
        $skip = ($pp - 1) * $limit;
        //按条件获取数据
//        $data=Users::skip($skip)->take($limit)->orderBy('id','desc')->get();

        $with['startTime'] = $startTime;
        $with['endTime'] = $endTime;
        $with['userName'] = $userName;
        $data = [];
//        添加查询条件
        $where = [['reseller_id', '=', \Auth::user()->reseller_id]];
        if ($startTime != '') {
            $where[] = ['updated_at', '>', $startTime];
        }
        if ($endTime != '') {
            $where[] = ['updated_at', '<', $endTime];
        }
        if ($userName != '') {
            $where[] = ['username', '=', $userName];
        }

        $data = DB::table('grade')
            ->where($where)
            ->skip($skip)->take($limit)->orderBy('id', 'desc')->get();
        //计算总数
//        $counts=Users::count();
        $counts = DB::table('grade')
            ->where('reseller_id', \Auth::user()->reseller_id)
            ->count();
        $pageCounts = $counts / $limit;
//        echo $pageCounts;
        $count = ceil($pageCounts);
//        $count=5;
        $where_json = '';
        if (count($where) > 1) {
            $where_json = (string)json_encode($where);
        }
        //分配模版变量
        $viewdata = ['count' => $count, 'data' => $data, 'page' => $pp, 'counts' => $counts, 'where' => $where_json];
        if (!empty($first)) {
            $viewdata['first'] = 1;
        }
//        dd($viewdata);
//        return view('member.grade_list', $viewdata)->with($with);
    }
}
