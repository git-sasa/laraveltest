<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Countries extends Model
{
    use HasFactory;
    public $table ="countries";

    public function getCountries(){
        return $this->hasManyThrough('App\Models\Post','App\Models\User','country_id','user_id','id','id');
    }
    /*
     *
     * 通过找 countries_id 找到 user表中所有 countries_id为1的用户，再对应的找到所有用户对应的posts信息
     *
     * */
    public function getuserPosts(){
        $arr = Countries::find(1)->getCountries;
        dump($arr->toArray());die;
    }
}
