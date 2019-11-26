<?php

namespace App\Http\Middleware\Api;

use Closure;
use Auth;
class PreordainCheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::guard('preordain')->user()->admin==1){
            return $next($request);
        }else{
            throw new \Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException('您没有权限进行该操作');
        }
    }
}
