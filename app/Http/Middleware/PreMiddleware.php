<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PreMiddleware
{
    /**
     * Handle an incoming request.
     * 测试前置中间件
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->id < 200){
            return $request->id;
        }
        return $next($request);
    }
}
