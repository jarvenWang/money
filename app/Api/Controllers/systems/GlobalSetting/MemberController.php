<?php
namespace App\Api\Controllers\systems\globalSetting;


use App\Api\Controllers\member\BaseController;


class MemberController extends BaseController {

    //全局设置基本信息 查询接口
    public function basic_set() {

        if (!$this->user) {
            return _error();
        }
        $reseller_id = $this->user->reseller_id;
//        $reseller_id = 1;

        //接收查询条件
        $request = request();

//        添加查询条件
        $where = [
            ['config' . '.reseller_id', '=', $reseller_id]
        ];

        $res = \DB::table('config')
            ->where($where)
            ->get()->toArray();

        $data = ['list' => $res];
        return _success($data);
    }

    public function member_registration() {

        if (!$this->user) {
            return _error();
        }
        $reseller_id = $this->user->reseller_id;
//        $reseller_id = 1;

        //接收查询条件
        $request = request();

//        添加查询条件
        $where = [
            ['reseller_field_config' . '.reseller_id', '=', $reseller_id]
        ];

        $res = \DB::table('reseller_field_config')
            ->where($where)
            ->get()->toArray();

        $data = ['list' => $res];
        return _success($data);

    }

    public function member_grade() {

        if (!$this->user) {
            return _error();
        }
        $reseller_id = $this->user->reseller_id;
//        $reseller_id = 1;

        //接收查询条件
        $request = request();

//        添加查询条件
        $where = [
            ['reseller_id', '=', $reseller_id]
        ];

        $res = \DB::table('grade')
            ->where($where)
            ->get()->toArray();

        $data = ['list' => $res];
        return _success($data);

    }

    public function del_member_grade() {

        if (!$this->user) {
            return _error();
        }
        $reseller_id = $this->user->reseller_id;
//        $reseller_id = 1;

        //接收查询条件
        $request = request();
        $id = $request->input('id');
//        添加查询条件
        $where = [
            ['reseller_id', '=', $reseller_id],
            ['id', '=', $id]
        ];

        $res = \DB::table('grade')
            ->where($where)
            ->delete();

        if ($res) {
            return _success('');

        } else {
            return _error('删除失败');
        }

    }

    public function change_registration_field() {
        if (!$this->user) {
            return _error();
        }
        $reseller_id = $this->user->reseller_id;
//        $reseller_id = 1;
        $id = request()->input('id');
        $display = request()->input('display');
        $required = request()->input('required');


        //        添加查询条件
        $where = [
            ['reseller_field_config' . '.reseller_id', '=', $reseller_id],
            ['reseller_field_config' . '.id', '=', $id]
        ];
        $data = [];
        if ($display) {
            $data['display'] = $display;
        }
        if ($required) {
            $data['required'] = $required;
        }
        $res = \DB::table('reseller_field_config')
            ->where($where)
            ->update($data);
        if ($res) {
            return _success($data, '更新成功');

        } else {
            return _error('更新失败');

        }
    }

    public function member_points() {

        if (!$this->user) {
            return _error();
        }
        $reseller_id = $this->user->reseller_id;
//        $reseller_id = 1;


        //        添加查询条件
        $where = [
            ['reseller_id', '=', $reseller_id],
        ];
        /*        $data=[];
                if($display){
                    $data['display']=$display;
                }
                if($required){
                    $data['required']=$required;
                }*/
        $res = \DB::table('config')
            ->where($where)
            ->first();

        return _success($res);


    }

    public function change_member_points() {
        /*        if (!$this->user) {
                    return _error();
                }
                $reseller_id = $this->user->reseller_id;*/
        $reseller_id = 1;

        //        添加查询条件
        $where = [
            ['reseller_id', '=', $reseller_id],
        ];

        $request = request();
        $data = $request->all();


        $res = \DB::table('config')
            ->where($where)
            ->update($data);

        return _success([]);


    }


}