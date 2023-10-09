<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Jobs\Demo;

class TestController extends Controller
{
    //
    public function test(){
        $num = rand(1000,9999);
        Demo::dispatch($num);
        return response()->json(['code'=>1,'data'=>[]]);
    }
}
