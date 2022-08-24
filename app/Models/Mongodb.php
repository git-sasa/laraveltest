<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;
use MongoDate;


class Mongodb extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'test1';
    protected $fillable = ["name","email",'created_at','updated_at'];

    public function test_mongodb(){
        $time = date('Y-m-d H:i:s');
        dump($time);die;
        $mongotime = new MongoDate(time());
        dump($mongotime);die;
//        $mongotime  = $mongotime - 3 hours;
        $user = array('name' => 'caleng', 'email' => 'admin@admin.com','created_at'=>$time,'updated_at'=>$time);
        Mongodb::insert($user);
//        $time = date('Y-m-d H:i:m',time());
//        Mongodb::create([
//            'name'=>"盛明兰",
//            'created_at'=>$time,
//            'updated_at'=>$time
//        ]);
        return true;
    }

}
