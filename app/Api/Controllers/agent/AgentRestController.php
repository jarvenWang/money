<?php


namespace App\Api\Controllers\agent;


use App\Api\Controllers\member\BaseController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;

class AgentRestController extends BaseController {

    protected $table_name = 'agents';


    public function __construct() {
        parent::__construct();

    }

    public function commission_settlement() {


        //接收查询条件
        $request = request();

        $name = $request->input('name');

        $start_time= $request->input('start_time');
        $end_time = $request->input('end_time');

        if ($start_time != '') {

            $where[] = [$this->table_name . '.application_time', '>', $start_time];
        }
        if ($end_time != '') {

            $where[] = [$this->table_name . '.application_time', '<', $end_time];
        }


        //status 0 开始处理 1 处理中 2 处理完成
        $arr=[
            ['agent_name'=>'代理账号1','sports'=>'3345.36','lottery'=>'6689.14','video'=>'9754.57','computer_game'=>'9652.57','total'=>'29441.64','status'=>'0'],
            ['agent_name'=>'代理账号2','sports'=>'3345.36','lottery'=>'6689.14','video'=>'9754.57','computer_game'=>'9652.57','total'=>'29441.64','status'=>'1'],
            ['agent_name'=>'代理账号3','sports'=>'3345.36','lottery'=>'6689.14','video'=>'9754.57','computer_game'=>'9652.57','total'=>'29441.64','status'=>'0'],
            ['agent_name'=>'代理账号4','sports'=>'3345.36','lottery'=>'6689.14','video'=>'9754.57','computer_game'=>'9652.57','total'=>'29441.64','status'=>'1'],
            ['agent_name'=>'代理账号5','sports'=>'3345.36','lottery'=>'6689.14','video'=>'9754.57','computer_game'=>'9652.57','total'=>'29441.64','status'=>'0'],
            ['agent_name'=>'代理账号6','sports'=>'3345.36','lottery'=>'6689.14','video'=>'9754.57','computer_game'=>'9652.57','total'=>'29441.64','status'=>'1'],
            ['agent_name'=>'代理账号7','sports'=>'3345.36','lottery'=>'6689.14','video'=>'9754.57','computer_game'=>'9652.57','total'=>'29441.64','status'=>'0'],
            ['agent_name'=>'代理账号8','sports'=>'3345.36','lottery'=>'6689.14','video'=>'9754.57','computer_game'=>'9652.57','total'=>'29441.64','status'=>'0'],
            ['agent_name'=>'代理账号9','sports'=>'3345.36','lottery'=>'6689.14','video'=>'9754.57','computer_game'=>'9652.57','total'=>'29441.64','status'=>'1'],
            ['agent_name'=>'代理账号10','sports'=>'3345.36','lottery'=>'6689.14','video'=>'9754.57','computer_game'=>'9652.57','total'=>'29441.64','status'=>'01'],
            ['agent_name'=>'代理账号11','sports'=>'3345.36','lottery'=>'6689.14','video'=>'9754.57','computer_game'=>'9652.57','total'=>'29441.64','status'=>'1'],
            ['agent_name'=>'代理账号12','sports'=>'3345.36','lottery'=>'6689.14','video'=>'9754.57','computer_game'=>'9652.57','total'=>'29441.64','status'=>'0'],
            ['agent_name'=>'代理账号13','sports'=>'3345.36','lottery'=>'6689.14','video'=>'9754.57','computer_game'=>'9652.57','total'=>'29441.64','status'=>'1'],
            ['agent_name'=>'代理账号14','sports'=>'3345.36','lottery'=>'6689.14','video'=>'9754.57','computer_game'=>'9652.57','total'=>'29441.64','status'=>'1'],
            ['agent_name'=>'代理账号15','sports'=>'3345.36','lottery'=>'6689.14','video'=>'9754.57','computer_game'=>'9652.57','total'=>'29441.64','status'=>'1'],
            ['agent_name'=>'代理账号16','sports'=>'3345.36','lottery'=>'6689.14','video'=>'9754.57','computer_game'=>'9652.57','total'=>'29441.64','status'=>'0'],
            ['agent_name'=>'代理账号17','sports'=>'3345.36','lottery'=>'6689.14','video'=>'9754.57','computer_game'=>'9652.57','total'=>'29441.64','status'=>'0'],
        ];
        $data=['list'=>$arr,'count'=>count($arr)];
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
//        $reseller_id = 1;
        //接收查询条件
        $request = request();

        $name = $request->input('name');
        $level_name = $request->input('level_name');
        //上级层级
        $superior_name = $request->input('superior_name');

        //接收页码
        $pp = $request->input('page', 1);

        $limit = $request->input('num', 12);


        // 计算跳过条数
        $skip = ($pp - 1) * $limit;


//        添加查询条件
        $where = [
            [$this->table_name . '.reseller_id', '=', $reseller_id]
        ];


        if ($name != '') {

            $where[] = [$this->table_name . '.name', '=', $name];
        }

        if ($level_name != '') {

            $where[] = [$this->table_name . '.level_id', '=', $level_name];

        }
        if ($superior_name != '') {
            $ress = DB::table($this->table_name)->where('name',$superior_name)->first();
            if(!$ress){

                $data = ['list' => []];
                return _success($data,'没有对应上级名字数据');

            }

            $where[] = [$this->table_name . '.parent_id', '=', $ress->id];

        }


        $res = DB::table($this->table_name)
            ->leftJoin('agent_level', $this->table_name . '.level_id', '=', 'agent_level.id')
            ->where($where)
            ->select($this->table_name . '.*', 'agent_level.name as level_name')
            ->skip($skip)->take($limit)->orderBy('id', 'desc')
            ->get()->toArray();

        foreach ($res as $k => $v) {

            if (!empty($v->parent_id)) {

                $ress = DB::table($this->table_name)->where('parent_id', $v->parent_id)->first();
                $res[$k]->superior_name = !empty($ress->name) ? $ress->name : '无';

            } else {
                $res[$k]->superior_name = '无';
            }

        }

        $data = ['list' => $res, 'count' => count($res)];
        return _success($data);
    }

    public function verify_agent() {

//        today yesterday_day this_week last_week this_month last_month

        $type=['未通过','通过','待审核'];

        if (!$this->user) {
            return _error();
        }
        $reseller_id = $this->user->reseller_id;
//       $reseller_id = 1;
        //接收查询条件
        $request = request();

        $name = $request->input('name');

        $start_time= $request->input('start_time');
        $end_time = $request->input('end_time');


        //接收页码
        $pp = $request->input('page', 1);

        $limit = $request->input('num', 12);


        // 计算跳过条数
        $skip = ($pp - 1) * $limit;


//        添加查询条件
        $where = [
            [$this->table_name . '.reseller_id', '=', $reseller_id]
        ];


        if ($name != '') {

            $where[] = [$this->table_name . '.name', '=', $name];
        }
        if ($start_time != '') {

            $where[] = [$this->table_name . '.application_time', '>', $start_time];
        }
        if ($end_time != '') {

            $where[] = [$this->table_name . '.application_time', '<', $end_time];
        }


        $res = DB::table($this->table_name)
            ->where($where)
            ->select($this->table_name . '.*')
            ->skip($skip)->take($limit)->orderBy('id', 'desc')
            ->get()->toArray();

        $count = DB::table($this->table_name)
            ->where($where)
            ->count();

        foreach ($res as $k => $v) {

                $res[$k]->verify_name = $type[$v->approved];

        }

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
        $res = DB::table($this->table_name)
            ->where($this->table_name . '.id', '=', $id)
            ->update($data);
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
