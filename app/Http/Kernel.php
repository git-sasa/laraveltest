<?php

namespace App\Http;

use App\Http\Middleware\PreMiddleware;
use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *  全局中间件
     * These middleware are run during every request to your application.
     *
     * @var array<int, class-string|string>
     */
    protected $middleware = [
        // \App\Http\Middleware\TrustHosts::class,
        \App\Http\Middleware\TrustProxies::class,   //设置信任代理有关的中间件
        \Fruitcake\Cors\HandleCors::class,  //处理传入的请求
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class, //在维护期间阻止请求
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,// 验证 POST 数据大小
        \App\Http\Middleware\TrimStrings::class,//是对请求内容进行 前后空白字符清理
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,//关于空字符转成 null 一种处理
    ];

    /**
     * The application's route middleware groups.
     *  中间件组
     * @var array<string, array<int, class-string|string>>
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,             // 需要进行CSRF验证
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
//            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
//            \App\Http\Middleware\PreMiddleware::class,
//            \App\Http\Middleware\AfterMiddleware::class,
//            \App\Http\Middleware\CORSHttpMiddleware::class,


        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *  路由中间件
     * @var array<string, class-string|string>
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
//        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'throttle'=> \App\Http\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'test'=>\App\Http\Middleware\TestMiddleware::class,
        'limit'=>\App\Http\Middleware\LimitMiddleware::class,
        'role'=>\App\Http\Middleware\RoleMiddleware::class,
//        'pre' =>\App\Http\Middleware\PreMiddleware::class,
    ];
}
