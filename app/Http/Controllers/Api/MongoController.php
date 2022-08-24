<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mongodb;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Date;
use MongoDB\BSON\UTCDateTime;

class MongoController extends Controller
{
    //
    public function test(Mongodb $mongodb){


        $mongodb->test_mongodb();
//        DB::connection("mongodb")       //选择使用mongodb数据库
//        ->collection("test")           //选择使用collection集合
//        ->insert([                          //插入数据
//            "name"  =>  "李四"
//        ]);
//        $dt = Carbon::now()->startOfDay();

//        $res = DB::connection("mongodb")->collection("test")->where('name','盛明兰')->select('name','created_at','updated_at')->first();

//        $result = DB::connection("mongodb")->collection("test")->where("_id", "62ff06ec3b69000065004714")->update(["name"=>"123"]);
//        dump($result);
        $res = DB::connection("mongodb")->collection("test1")->get();

        //这里的删除是删除所有符合条件的数据
//        $res = DB::connection('mongodb')->collection('test')->where('name','jerry')->delete();
        dd($res);
    }
}
