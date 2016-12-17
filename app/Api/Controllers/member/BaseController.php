<?php

namespace App\Api\Controllers\member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Tymon\JWTAuth\Exceptions\JWTException;


class BaseController extends Controller

{
    //
    protected $user;

    public function __construct(){
//        $this->user=(object)['reseller_id'=>110];
        try{
             $this->user = \Tymon\JWTAuth\Facades\JWTAuth::parseToken()->authenticate();
        }catch (JWTException $e) {

            return [
                'status' => 0,
                'msg' => '未登录'
            ];

        }


    }

}
