<?php

namespace App\Http\Middleware;

use Closure;

use JWTAuth;
use Carbon\Carbon;
use Cache;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class AuthJWT
{
    /**
     * Handle an incoming request.qq
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        try {

            if (! JWTAuth::parseToken()->authenticate()) {
                return response()->json([
                    'status' => 0,
                    'msg' => '用户不存在'
                ]);
            }

        } catch (TokenExpiredException $e) {
            return response()->json([
                'status' => 0,
                'msg' => '登陆超时,请重新登陆'
            ], $e->getStatusCode());

        } catch (TokenInvalidException $e) {
            return response()->json([
                'status' => 0,
                'msg' => '安全令牌无效'
            ], $e->getStatusCode());

        } catch (JWTException $e) {
            return response()->json([
                'status' => 0,
                'msg' => '安全令牌丢失'
            ], $e->getStatusCode());

        }
        return $next($request);
    }
}
