<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;


class AfterMiddleware
{
    /**
     * Handle an incoming request.
     * 后置中间件
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        $datetime = strtotime('2022-10-12');
        if(time() > $datetime){
            return date('Y-m-d',time()).'>'.date('Y-m-d',$datetime);
        }
        return $response;
    }
}
