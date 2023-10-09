<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Phone extends Model
{
    use HasFactory;
    public $table = 'phone';

    public function getPhone(){
//       1对1   通过用户id获取对应用户的Phone的信息
//        $phone = User::find(1)->phone1;//hasOne 一次获取一个

//       1对多  通过用户id获取对应用户的Phone的信息
        $phone = User::find(1)->phones->where("phone","12345678909");//hasMany  一次获取多个
        dump($phone->toArray());die;
        return $phone;
    }


    public function user(){
//        user作为主表，副表存储外键信息
        return $this->belongsTo('App\Models\User','user_id','id');
    }
}
