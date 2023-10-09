<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CORSHttpMiddleware
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
//        允许的域名集
        $allow_origin = [
            'http://www.123.com',
        ];
        $response = $next($request);
        $origin = $request->server('HTTP_ORIGIN') ? $request->server('HTTP_ORIGIN') : '';
        $headers = [
            'Access-Control-Allow-Origin' => $origin,
            'Access-Control-Allow_Headers' => 'Origin, Content-Type, Cookie, X-CSRF-TOKEN, Accept, Authorization, X-XSRF-TOKEN',
            'Access-Control-Expose-Headers' => 'Authorization,authenticated',
            'Access-Control-Allow-Methods' => 'GET,POST,PATCH,PUT,OPTIONS',
            'Access-Control-Allow-Credentials' => 'false',
        ];
        if(in_array($origin,$allow_origin)){
            foreach($headers as $key => $value) $response->header($key,$value);
        }
        return $response;
    }
}
