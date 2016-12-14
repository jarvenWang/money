<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class MemberListController extends Controller {
    //
    public function index() {
//        Users::where()
        return view('layouts/master')->with('age', 19);
    }

    public function main() {

        return view('main');
    }

    //更改用户状态为关闭
    public function delid(Request $request) {
        $delid = $request->input('delid');

        $res = DB::table('users')
            ->where('reseller_id', \Auth::user()->reseller_id)
            ->where('id', $delid)
            ->update(['status' => 0]);

//        $res=Users::where('id',$delid)->update(['status'=>0]);
        $resArr = ['status' => 0];
        if ($res) {
            $resArr['status'] = 1;
        }

        return json_encode($resArr);

    }


    public function member_list(Request $request, $p = 1, $limit = 15) {

        //接收查询条件
        $limit = $request->input('limit', 15);
        $startTime = $request->input('start_time', '');
        $endTime = $request->input('end_time', '');
        $userName = $request->input('user_name', '');
        //接收页码
        $pp = $request->input('p', 1);
        //是否为首页
        $first = $request->input('first');
        // 计算跳过条数
        $skip = ($pp - 1) * $limit;
        //按条件获取数据
//        $data=Users::skip($skip)->take($limit)->orderBy('id','desc')->get();

        $with['startTime'] = $startTime;
        $with['endTime'] = $endTime;
        $with['userName'] = $userName;
        $data = [];
//        添加查询条件
        $where = [
            ['reseller_id', '=', \Auth::user()->reseller_id],
            ['agent_id', '=', '0']
            ];
        if ($startTime != '') {
            $where[] = ['updated_at', '>', $startTime];
        }
        if ($endTime != '') {
            $where[] = ['updated_at', '<', $endTime];
        }
        if ($userName != '') {
            $where[] = ['username', '=', $userName];
        }
        $data = DB::table('users')
            ->where($where)
            ->skip($skip)->take($limit)->orderBy('id', 'desc')->get();
        //计算总数
//        $counts=Users::count();
        $counts = DB::table('users')
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
        return view('member.member_list', $viewdata)->with($with);
    }

//    ajax获取用户信息
    public function selectUser(Request $request) {
        $id = $request->input('editid');
        $data = DB::table('users')
            ->where('reseller_id', \Auth::user()->reseller_id)
            ->find($id);
        return json_encode($data);
    }

//    更改用户信息
    public function changeUser(Request $request) {

        $json = $request->input('data');
        $arr = json_decode($json, true);
        $id = $arr['id'];
        unset($arr['id']);
//        dd($arr);
        $arr['updated_at'] = Carbon::now();
        $res = DB::table('users')
            ->where('reseller_id', \Auth::user()->reseller_id)
            ->where('id', $id)->update($arr);

        if ($res) {
            return ['status' => 1, 'id' => $id];
//            $arr['status']=1;
//            $arr['id']=$id;
//            return json_encode($arr);
        } else {
            return ['status' => 0];
//            $_arr['status']=0;
//            return json_encode($_arr);
        }

    }

    public function addUser(Request $request) {
        $json = $request->input('data');
        $arr = json_decode($json, true);

        $rule = [
            'name' => 'required',
            'password' => 'required',
            'username' => 'required'
        ];
        $messages = [
            'name.required' => '会员名不能为空',
            'password.required' => '密码不能为空',
            'username.required' => '用户名不能为空',
        ];

        $validator = Validator::make($arr, $rule, $messages);

        if ($validator->fails()) {
            $response = ['message' => $validator->errors()->first(), 'status' => 2, 'url' => ''];
            return json_encode($response);
        }
//        dd($arr);
        $arr['amount_hongli'] = 0;
        $arr['remember_token'] = 0;
        $arr['number'] = 0;
        $arr['total_cash'] = 0;
        $arr['total_members'] = 0;
        $arr['total_agents'] = 0;
        $arr['self_members'] = 0;
        $arr['self_agents'] = 0;
        $arr['max_members'] = 999;
        $arr['max_agents'] = 999;
        $arr['status'] = 1;
        $arr['fandian'] = 0.0;
        $arr['online'] = 0;
        $arr['balance'] = 0;
        $arr['frozen_balance'] = 0;
        $arr['temp_password'] = 0;
        $arr['grade_id'] = 0;
        $arr['level_id'] = 0;
        $arr['agent_id'] = 0;
        $arr['parent_id'] = 0;

        $arr['updated_at'] = Carbon::now();
        $arr['created_at'] = Carbon::now();

        $arr['created_ip'] = get_client_ip();
        $arr['reseller_id'] = \Auth::user()->reseller_id;
        $res = DB::table('users')->insert($arr);
        if ($res) {
            $arr2['status'] = 1;
            return json_encode($arr2);
        } else {
            $_arr2['status'] = 0;
            return json_encode($_arr2);
        }

    }


    //-----会员层级-------level
    public function selectLevel(Request $request) {
        $id = $request->input('editid');
        $data = DB::table('level')
            ->where('reseller_id', \Auth::user()->reseller_id)
            ->find($id);
        return json_encode($data);
    }

    public function member_level(Request $request, $p = 1, $limit = 15) {
        //接收页码
        $pp = $request->input('p', '1');
        //接收查询条件
        $limit = $request->input('limit', 15);
        $startTime = $request->input('start_time', '');
        $endTime = $request->input('end_time', '');
        $userName = $request->input('user_name', '');

        $with['startTime'] = $startTime;
        $with['endTime'] = $endTime;
        $with['userName'] = $userName;
        //是否为首页
        $first = $request->input('first');
        // 计算跳过条数
        $skip = ($pp - 1) * $limit;
        //按条件获取数据
//        $data=Users::skip($skip)->take($limit)->orderBy('id','desc')->get();

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
        $data = DB::table('level')
            ->where($where)
            ->skip($skip)->take($limit)->orderBy('id', 'desc')->get();
        //计算总数
//        $counts=Users::count();
        $counts = DB::table('level')->where($where)->count();
        $pageCounts = $counts / $limit;
//        echo $pageCounts;
        $count = ceil($pageCounts);
//        $count=5;
        //分配模版变量
//        dd($data);
        $viewdata = ['count' => $count, 'counts' => $counts, 'data' => $data, 'page' => $pp];
        if (!empty($first)) {
            $viewdata['first'] = 1;
        }
        $viewdata['level'] = '_member-level';
//        dd($viewdata);

        return view('member.level_list', $viewdata)->with($with);
    }

    public function changeLevel(Request $request) {

        $json = $id = $request->input('data');
        $arr = json_decode($json, true);
        $id = $arr['id'];
        unset($arr['id']);
        ($arr['fencheng'] != '') ?: $arr['fencheng'] = '0.0';
        $arr['updated_at'] = Carbon::now();
        $res = DB::table('level')
            ->where('reseller_id', \Auth::user()->reseller_id)
            ->where('id', $id)->update($arr);

        if ($res) {
            $arr['status'] = 1;
            $arr['id'] = $id;
            $arr['updated_at'] = date('Y-m-d H:i:s');

            return json_encode($arr);
        } else {
            $_arr['status'] = 0;
            return json_encode($_arr);
        }

    }

    public function addLevel(Request $request) {
        $json = $request->input('data');
        $arr = json_decode($json, true);
        $arr['created_by'] = \Auth::user()->name;
        $arr['reseller_id'] = \Auth::user()->reseller_id;
        $arr['created_at'] = Carbon::now();
        $arr['updated_at'] = Carbon::now();

//        dd($arr);

        $rule = [
            'name' => 'required',
            'type' => 'required',
//            'username' => 'required'
        ];
        /*        $messages = [
                    'name.required' => '会员名不能为空',
                    'password.required' => '密码不能为空',
                    'username.required' => '用户名不能为空',
                ];*/

        $validator = Validator::make($arr, $rule);

        if ($validator->fails()) {
            $response = ['message' => $validator->errors()->first(), 'status' => 2, 'url' => ''];
            return json_encode($response);
        }
        $res = DB::table('level')->insert($arr);
        if ($res) {
            $arr2['status'] = 1;
            return json_encode($arr2);
        } else {
            $_arr2['status'] = 0;
            return json_encode($_arr2);
        }

    }

    //------代理层级------agent_level
    public function selectAgentLevel(Request $request) {
        $id = $request->input('editid');
        $data = DB::table('agent_level')
            ->where('reseller_id', \Auth::user()->reseller_id)
            ->find($id);
        return json_encode($data);
    }

    public function member_agent_level(Request $request, $p = 1, $limit = 15) {
        //接收页码
        $pp = $request->input('p');
        //是否为首页
        $first = $request->input('first');
        // 计算跳过条数
        $skip = ($pp - 1) * $limit;
        //按条件获取数据
//        $data=Users::skip($skip)->take($limit)->orderBy('id','desc')->get();
        $data = DB::table('agent_level')
            ->where('reseller_id', \Auth::user()->reseller_id)
            ->skip($skip)->take($limit)->orderBy('id', 'desc')->get();
        //计算总数
//        $counts=Users::count();
        $counts = DB::table('agent_level')->count();
        $pageCounts = $counts / $limit;
//        echo $pageCounts;
        $count = ceil($pageCounts);
//        $count=5;
        //分配模版变量
//        dd($data);
        $viewdata = ['count' => $count, 'data' => $data, 'page' => $pp];
        if (!empty($first)) {
            $viewdata['first'] = 1;
        }
        $viewdata['level'] = '_member-agent-level';
        return view('member.agent_level_list', $viewdata);
    }

    public function changeAgentLevel(Request $request) {

        $json = $id = $request->input('data');
        $arr = json_decode($json, true);
        $id = $arr['id'];
        unset($arr['id']);
        ($arr['fencheng'] != '') ?: $arr['fencheng'] = '0.0';
        $arr['updated_at'] = Carbon::now();
        $res = DB::table('agent_level')->where('reseller_id', \Auth::user()->reseller_id)->where('id', $id)->update($arr);

        if ($res) {
            $arr['status'] = 1;
            $arr['id'] = $id;
            $arr['updated_at'] = date('Y-m-d H:i:s');

            return json_encode($arr);
        } else {
            $_arr['status'] = 0;
            return json_encode($_arr);
        }

    }

    public function addAgentLevel(Request $request) {
        $json = $request->input('data');
        $arr = json_decode($json, true);
        $arr['created_by'] = \Auth::user()->name;
        $arr['reseller_id'] = \Auth::user()->reseller_id;
        $arr['created_at'] = Carbon::now();
        $arr['updated_at'] = Carbon::now();

//        dd($arr);

        $rule = [
            'name' => 'required',
            'type' => 'required',
//            'username' => 'required'
        ];
        /*        $messages = [
                    'name.required' => '会员名不能为空',
                    'password.required' => '密码不能为空',
                    'username.required' => '用户名不能为空',
                ];*/

        $validator = Validator::make($arr, $rule);

        if ($validator->fails()) {
            $response = ['message' => $validator->errors()->first(), 'status' => 2, 'url' => ''];
            return json_encode($response);
        }
        $res = DB::table('agent_level')->insert($arr);
        if ($res) {
            $arr2['status'] = 1;
            return json_encode($arr2);
        } else {
            $_arr2['status'] = 0;
            return json_encode($_arr2);
        }

    }

    //-----会员等级
    public function member_grade(Request $request, $p = 1, $limit = 15) {
        //接收查询条件
        $limit = $request->input('limit', 15);
        $startTime = $request->input('start_time', '');
        $endTime = $request->input('end_time', '');
        $userName = $request->input('user_name', '');
        //接收页码
        $pp = $request->input('p', 1);
        //是否为首页
        $first = $request->input('first');
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
        return view('member.grade_list', $viewdata)->with($with);
    }

    public function selectGrade(Request $request) {
        $id = $request->input('editid');
        $data = DB::table('grade')
            ->where('reseller_id', \Auth::user()->reseller_id)
            ->find($id);

//        dd($data);
        return view('member.edit.edit_grade',['data'=>$data]);

//        return json_encode($data);
    }

    public function changeGrade(Request $request) {

        $form = $id = $request->input('data');
//        $arr = json_decode($json, true);
        $id = $form['id'];
        unset($form['id']);
        $form['updated_at'] = Carbon::now();
        $res = DB::table('grade')->where('id', $id)->update($form);

        if ($res) {
            $arr['status'] = 1;
            $arr['id'] = $id;
            $arr['updated_at'] = date('Y-m-d H:i:s');
            return $arr;
        } else {
            return ['status'=>0];
        }

    }

    public function addGrade(Request $request) {
        $arr = $request->input('data');
        $arr['created_at'] = Carbon::now();
        $arr['updated_at'] = Carbon::now();
        $arr['reseller_id'] = \Auth::user()->reseller_id;
        $rule = [
            'name' => 'required',
//            'type' => 'required',
//            'username' => 'required'
        ];
        /*        $messages = [
                    'name.required' => '会员名不能为空',
                    'password.required' => '密码不能为空',
                    'username.required' => '用户名不能为空',
                ];*/

        $validator = Validator::make($arr, $rule);

        if ($validator->fails()) {
            return ['message' => $validator->errors()->first(), 'status' => 2, 'url' => ''];
        }
        $res = DB::table('grade')->insert($arr);
        if ($res) {
            return ['status' => 1];
        } else {
            return ['status' => 0];
        }

    }


    //    更改用户信息agent-list
    public function agentList(Request $request, $p = 1, $limit = 15) {
        //接收查询条件
        $limit = $request->input('limit', 15);
        $startTime = $request->input('start_time', '');
        $endTime = $request->input('end_time', '');
        $userName = $request->input('user_name', '');
        //接收页码
        $pp = $request->input('p', 1);
        //是否为首页
        $first = $request->input('first');
        // 计算跳过条数
        $skip = ($pp - 1) * $limit;
        //按条件获取数据
//        $data=Users::skip($skip)->take($limit)->orderBy('id','desc')->get();

        $with['startTime'] = $startTime;
        $with['endTime'] = $endTime;
        $with['userName'] = $userName;
        $data = [];
//        添加查询条件
        $where = [
            ['reseller_id', '=', \Auth::user()->reseller_id],
            ['agent_id', '!=', '0']

        ];
        if ($startTime != '') {
            $where[] = ['updated_at', '>=', $startTime];
        }
        if ($endTime != '') {
            $where[] = ['updated_at', '<', $endTime];
        }
        if ($userName != '') {
            $where[] = ['username', '=', $userName];
        }
        $data = DB::table('users')
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
        return view('member.member_list', $viewdata)->with($with);
    }

    public function selectAgent(Request $request) {
        $id = $request->input('editid');
        $data = DB::table('users')
            ->where('reseller_id', \Auth::user()->reseller_id)
            ->find($id);
        return json_encode($data);
    }

    public function changAgent(Request $request) {

        $json = $request->input('data');
        $arr = json_decode($json, true);
        $id = $arr['id'];
        unset($arr['id']);
//        dd($arr);
        $arr['updated_at'] = Carbon::now();
        $res = DB::table('users')
            ->where('reseller_id', \Auth::user()->reseller_id)
            ->where('id', $id)->update($arr);

        if ($res) {
            return ['status' => 1, 'id' => $id];
//            $arr['status']=1;
//            $arr['id']=$id;
//            return json_encode($arr);
        } else {
            return ['status' => 0];
//            $_arr['status']=0;
//            return json_encode($_arr);
        }

    }

    public function addAgent(Request $request) {
        $json = $request->input('data');
        $arr = json_decode($json, true);

        $rule = [
            'name' => 'required',
            'password' => 'required',
            'username' => 'required'
        ];
        $messages = [
            'name.required' => '会员名不能为空',
            'password.required' => '密码不能为空',
            'username.required' => '用户名不能为空',
        ];

        $validator = Validator::make($arr, $rule, $messages);

        if ($validator->fails()) {
            $response = ['message' => $validator->errors()->first(), 'status' => 2, 'url' => ''];
            return json_encode($response);
        }
//        dd($arr);
        $arr['amount_hongli'] = 0;
        $arr['remember_token'] = 0;
        $arr['number'] = 0;
        $arr['total_cash'] = 0;
        $arr['total_members'] = 0;
        $arr['total_agents'] = 0;
        $arr['self_members'] = 0;
        $arr['self_agents'] = 0;
        $arr['max_members'] = 999;
        $arr['max_agents'] = 999;
        $arr['status'] = 1;
        $arr['fandian'] = 0.0;
        $arr['online'] = 0;
        $arr['balance'] = 0;
        $arr['frozen_balance'] = 0;
        $arr['temp_password'] = 0;
        $arr['grade_id'] = 0;
        $arr['level_id'] = 0;
        $arr['agent_id'] = 0;
        $arr['parent_id'] = 0;

        $arr['updated_at'] = Carbon::now();
        $arr['created_at'] = Carbon::now();

        $arr['created_ip'] = get_client_ip();
        $arr['reseller_id'] = \Auth::user()->reseller_id;
        $res = DB::table('users')->insert($arr);
        if ($res) {
            $arr2['status'] = 1;
            return json_encode($arr2);
        } else {
            $_arr2['status'] = 0;
            return json_encode($_arr2);
        }

    }
}
