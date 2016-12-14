<?php

namespace App\Http\Controllers\Api\Chenze;

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
        $title_arr=[
            '所属上级','会员层级','会员等级','真实姓名',
            '登陆用户名','登陆密码','邮箱','手机号码',
            '帐户余额','帐户被冻结金额','帐户状态',
            '在线状态','创建时IP地址','最后登陆IP地址',
            '最后登陆时间','最后登陆所在地'
        ];
        $reseller_id = $this->user->reseller_id;

        //接收查询条件
        $request = request();

        $limit = $request->input('num', 12);

        $level_name = $request->input('level_name');

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
            $where[] = ['level.name', '=', $level_name];
        }
        if ($grade_name != '') {
            $where[] = ['grade.name', '=', $grade_name];
        }
        $res = DB::table('users')
            ->leftJoin('level', 'users.level_id', '=', 'level.id')
            ->leftJoin('grade', 'users.grade_id', '=', 'grade.id')
            ->leftJoin('agents', 'users.agent_id', '=', 'agents.id')
            ->where($where)
            ->select('users.*', 'level.name as level_name', 'grade.name as grade_name', 'agents.name as agents_name')
            ->skip($skip)->take($limit)->orderBy('id', 'desc')
            ->get()->toArray();

//        DB::table('users')->paginate(10);
//        return reponse()->json($result);
        $cate_level = DB::table('level')
            ->where('level.reseller_id', '=', $reseller_id)
            ->get()->toArray();

        $count = DB::table('users')
            ->leftJoin('level', 'users.level_id', '=', 'level.id')
            ->leftJoin('grade', 'users.grade_id', '=', 'grade.id')
            ->leftJoin('agents', 'users.agent_id', '=', 'agents.id')
            ->where($where)
            ->count();


        $data = ['list' => $res, 'level' => $cate_level, 'count' => $count];
        return _success($data);
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
