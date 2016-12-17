<?php

namespace App\Api\Controllers\member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;

class LevelRestController extends BaseController {

    protected $table_name = 'level';

    public function __construct() {
        parent::__construct();

    }

    public function agent_level() {
        if (!$this->user) {
            return _error();
        }
        $reseller_id = $this->user->reseller_id;
//        $reseller_id = 1;

        //接收查询条件
        $request = request();

//        添加查询条件
        $where = [
            ['agent_level' . '.reseller_id', '=', $reseller_id]
        ];

        $res = DB::table('agent_level')
            ->where($where)
            ->get()->toArray();


        $data = ['list' => $res];
        return _success($data);
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
        $reseller_id = $this->user->reseller_id;

        //接收查询条件
        $request = request();
        //接收页码
        $pp = $request->input('page', 1);
        $limit = $request->input('num', 12);
        $level_name = $request->input('level_name');
        $agentName = $request->input('agent_name');


        // 计算跳过条数
        $skip = ($pp - 1) * $limit;

//        添加查询条件
        $where = [
            [$this->table_name . '.reseller_id', '=', $reseller_id]
        ];

        if ($agentName != '') {

            $where[] = ['agents.name', '=', $agentName];
        }

        if ($level_name != '') {

            $where[] = ['agents.level_id', '=', $level_name];

        }

        $res = DB::table($this->table_name)
            ->where($where)
            ->skip($skip)->take($limit)->orderBy('id', 'desc')
            ->get()->toArray();

        $count = DB::table($this->table_name)
            ->where($where)
            ->count();

        $data = ['list' => $res, 'count' => $count];
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
            [$this->table_name . '.id', '=', $id],
            [$this->table_name . '.reseller_id', '=', $reseller_id]
        ];
        $res = DB::table($this->table_name)
            ->where($where)
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
        $res = DB::table($this->table_name)
            ->where($this->table_name . '.id', '=', $id)
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
