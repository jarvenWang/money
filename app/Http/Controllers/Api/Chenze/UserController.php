<?php

namespace App\Http\Controllers\Api\Chenze;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use JWTAuth;
use Carbon\Carbon;
use Tymon\JWTAuth\Exceptions\JWTException;
use DB;
use Closure;

use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class UserController extends Controller {

    protected $user;
    //
    public function login(Request $request) {

        $rule = [
            'username' => 'required',
            'password' => 'required|min:6'
        ];

        $validator = validator($request->only(['username', 'password']), $rule);
        if ($validator->fails()) {
            $response = [
                'info' => $validator->errors()->first(),
                'status' => 2
            ];
            return response()->json($response, 200);
        }
        $post = $request->only('username', 'password');
        try {

            if (!$token = JWTAuth::attempt($post)) {

                return response()->json(['info' => '用户名或密码错误', 'status' => 2]);

            }

        } catch (JWTException $e) {
            return response()->json(['info' => '创建令牌失败', 'status' => 2], 500);
        }

        return response()->json(compact('token'));
    }


}
