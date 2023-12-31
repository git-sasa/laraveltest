<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Check If The Application Is Under Maintenance
|--------------------------------------------------------------------------
|
| If the application is in maintenance / demo mode via the "down" command
| we will load this file so that any pre-rendered content can be shown
| instead of starting the framework, which could cause an exception.
|
*/

if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| this application. We just need to utilize it! We'll simply require it
| into the script here so we don't need to manually load our classes.
| composer 自动加载设置
*/

require __DIR__.'/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request using
| the application's HTTP kernel. Then, we will send the response back
| to this client's browser, allowing them to enjoy our application.
| 检索laravel应用程序的实例
*/

$app = require_once __DIR__.'/../bootstrap/app.php';//tell speak talk
// tell 告诉 讲述 说 辨别
// speak 说话 演讲 陈述
// talk  说 交谈 谈话
//season 季节
//science 科学
//sport 体育运动
//exercise 运动、练习、运用、锻炼、使用

$kernel = $app->make(Kernel::class);//HTTP内核处理

//将请求发送给路由器
$response = $kernel->handle(
    $request = Request::capture()
)->send();
$kernel->terminate($request, $response);
