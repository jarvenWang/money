<?php

namespace App\Api\Controllers\member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserRestController extends BaseController {

    public function __construct() {
        parent::__construct();

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index() {

        if (!$this->user) {
            return _error();
        }
        $title_arr = [
            0 => '所属上级', 1 => '会员层级', 2 => '会员等级', 3 => '真实姓名',
            4 => '登陆用户名', 5 => '登陆密码', 6 => '邮箱', 7 => '手机号码',
            8 => '帐户余额', 9 => '帐户被冻结金额', 10 => '帐户状态',
            11 => '在线状态', 12 => '创建时IP地址', 13 => '最后登陆IP地址',
            14 => '最后登陆时间', 15 => '最后登陆所在地'
        ];
        $reseller_id = $this->user->reseller_id;


        //接收查询条件
        $request = request();

        $limit = $request->input('num', 12);

        $title = $request->input('th');

        $get_title = !empty($title) ? explode(',', $title) : [0, 1, 2, 3, 4];

        $tarr = collect($get_title)->map(function ($item) use ($title_arr) {
            return $title_arr[$item];
        });
        $tarr->push('状态');
        $tarr->push('操作');
//        dd($tarr->toArray());


        $level_name = $request->input('level_name');

        $superior_name = $request->input('superior_name');

        $grade_name = $request->input('grade_name');

        $userName = $request->input('user_name', '');
        //接收页码
        $pp = $request->input('page', 1);

        // 计算跳过条数
        $skip = ($pp - 1) * $limit;
        //按条件获取数据

//        添加查询条件
        $where = [
            ['users.reseller_id', '=', $reseller_id]
        ];

        if ($userName != '') {

            $where[] = ['users.username', '=', $userName];
        }

        if ($level_name != '') {

            $where[] = ['users.level_id', '=', $level_name];

        }
        if ($grade_name != '') {

            $where[] = ['users.grade_id', '=', $grade_name];

        }
        if ($superior_name != '') {
            $agents = DB::table('agents')->where('name', $superior_name)->first();
            $where[] = ['users.agent_id', '=', $agents->id];
        }
        $res = DB::table('users')
            ->leftJoin('level', 'users.level_id', '=', 'level.id')
            ->leftJoin('grade', 'users.grade_id', '=', 'grade.id')
            ->leftJoin('agents', 'users.agent_id', '=', 'agents.id')
            ->where($where)
            ->select('users.*', 'level.name as level_name', 'grade.name as grade_name', 'agents.name as agents_name')
            ->skip($skip)->take($limit)->orderBy('id', 'desc')
            ->get()->toArray();


        $cate_level = DB::table('level')
            ->where('level.reseller_id', '=', $reseller_id)
            ->get()->toArray();
        $cate_grade = DB::table('grade')
            ->where('grade.reseller_id', '=', $reseller_id)
            ->get()->toArray();

        $count = DB::table('users')
            ->leftJoin('level', 'users.level_id', '=', 'level.id')
            ->leftJoin('grade', 'users.grade_id', '=', 'grade.id')
            ->leftJoin('agents', 'users.agent_id', '=', 'agents.id')
            ->where($where)
            ->count();


        // $data = ['list' => $res, 'level' => $cate_level, 'grade' => $cate_grade,'th'=>$tarr, 'count' => $count];
        $data = ['list' => $res, 'count' => $count];
        return _success($data);
    }

    public function fanshui() {

        $arr=[
         ['name'=>'zhan2014','betting'=>'4555.66','return_money'=>'40'],
         ['name'=>'zhan2011','betting'=>'456.66','return_money'=>'41'],
         ['name'=>'zhan2012','betting'=>'789.66','return_money'=>'55'],
         ['name'=>'zhan2013','betting'=>'4539.66','return_money'=>'8'],
         ['name'=>'zhan2019','betting'=>'789.66','return_money'=>'45'],
         ['name'=>'zhan2018','betting'=>'456.66','return_money'=>'45'],
         ['name'=>'zhan2017','betting'=>'89.66','return_money'=>'98'],
         ['name'=>'zhan2015','betting'=>'3112.66','return_money'=>'9'],
        ];

        return _success($arr);

    }
    public function fanshui_history() {

        $arr=[
         ['fanshui_time'=>'2019-11-25','num'=>'66','effective_betting'=>'5','betting'=>'55.66','operation_time'=>'2016-11-26'],
         ['fanshui_time'=>'2019-11-24','num'=>'64','effective_betting'=>'4','betting'=>'54.33','operation_time'=>'2016-11-25'],
         ['fanshui_time'=>'2019-11-23','num'=>'63','effective_betting'=>'3','betting'=>'75.16','operation_time'=>'2016-11-24'],
         ['fanshui_time'=>'2019-11-22','num'=>'62','effective_betting'=>'5','betting'=>'51.56','operation_time'=>'2016-11-23'],
         ['fanshui_time'=>'2019-11-21','num'=>'61','effective_betting'=>'1','betting'=>'75.66','operation_time'=>'2016-11-22'],

        ];

        return _success($arr);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        if (!$this->user) {
            return _error();
        }
        $reseller_id = $this->user->reseller_id;

        $where = [
            ['users.id', '=', $id],
            ['resellerid', '=', $reseller_id]
        ];
        $res = DB::table('users')
            ->where($where)
            ->leftJoin('level', 'users.level_id', '=', 'level.id')
            ->leftJoin('grade', 'users.grade_id', '=', 'grade.id')
            ->leftJoin('agents', 'users.agent_id', '=', 'agents.id')
            ->select('users.*', 'level.name as level_name', 'grade.name as grade_name', 'agents.name as agents_name')
            ->first();
        $res = (array)$res;
        return _success($res);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
        $data = $request->all();
        $dataArr = json_decode($data, true)['data'];
        $res = DB::table('users')
            ->where('users.id', '=', $id)
            ->update($dataArr);
        if ($res) {
            return _success($res);
        } else {
            return _error($res);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }
}
