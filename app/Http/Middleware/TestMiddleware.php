<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TestMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $time = microtime(true);
        $response = $next($request);
//        echo "处理逻辑";
//        echo "
//                中间件都能实现那些功能？
//                指定某些路由
//                设置HTTP响应头
//                记录请求
//                过滤请求的参数
//                决定是否启用站点维护模式
//                响应前后做一些必要的操作
//            ".$time;

//        $session = app('session');//获取登录后的session中的数据
        $time2 = microtime(true);

        return $response;
    }
}
