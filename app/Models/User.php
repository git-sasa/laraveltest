<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
//use App\Models\Phone;
//use App\Models\Roles;
//use App\Models\Image;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
//    protected $fillable = [
//        'name',
//        'email',
//        'password',
//    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
//    protected $hidden = [
//        'password',
//        'remember_token',
//    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
//    protected $casts = [
//        'email_verified_at' => 'datetime',
//    ];

    public $table="users";
//
//    public function phone1(){
//        return $this->hasOne('App\Models\Phone');
//    }
//
//    public function phones(){
//        return $this->hasMany('App\Models\Phone');
//    }
//
//
//    public function get_userinfo(){
////      1对1  通过phone的主键查到对应的用户信息
////      1对多  通过phone的主键查到对应的用户信息  但返回的依旧是一条数据信息
////       dump(Phone::find(1)->user->toArray());die;
////        dump(Phone::find(1)->user->toArray());die;
//
////       多对多
////        $user = User::find(2);
////        foreach($user->roles->toArray() as $v){
////            dump($v);
////        }
//        return User::find(1);
//    }
//
////    用户拥有的角色
//    public function roles(){
//        return $this->belongsToMany('App\Models\Roles');
//    }
//
//
////    获取用户图片
//    public function image(){
//        return $this->morphOne('App\Models\Image','imageable_id');
//    }

}
