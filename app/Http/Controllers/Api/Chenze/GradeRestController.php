<?php

namespace App\Http\Controllers\Api\Chenze;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;

class GradeRestController extends BaseController {
    
    protected $table_name='grade';


    public function __construct()
    {
        parent::__construct();

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index() {
        if(!$this->user){
            return _error();
        }
        $reseller_id=$this->user->reseller_id;
        //接收查询条件
        $request=request();

        //$reseller_id=1;
//        添加查询条件
        $where = [
            [$this->table_name.'.reseller_id', '=', $reseller_id]
        ];

        $res = DB::table($this->table_name)
            ->where($where)
            ->get()->toArray();

            $data=['list'=>$res,'count'=>count($res)];
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
        if(!$this->user){
            return _error();
        }
        $reseller_id=$this->user->reseller_id;

        $where=[
            [$this->table_name.'.id', '=', $id],
            [$this->table_name.'.reseller_id','=',$reseller_id]
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
        $dataArr=json_decode($data,true)['data'];
        $res = DB::table($this->table_name)
            ->where($this->table_name.'.id', '=', $id)
            ->update($dataArr);
        if($res){
            return _success($res);
        }else{
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
