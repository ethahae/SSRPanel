<?php

namespace App\Http\Middleware;

use Closure;
use Redirect;
use Response;
use Cache;
class isCpsLogin
{
    /**
     * 校验是否已登录
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      $user_id = $request->header('token');
      $user = CpsUser::query()->firstWhere('id', $user_id);
      if (!$user_id || !user){
        return Response::json(['status' => 'fail', 'data' => '', 'message' => 'invalid token']);
      }
      return $next($request);
    }
}
?>