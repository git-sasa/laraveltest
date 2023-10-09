<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Roles extends Model
{
    use HasFactory;
    public $table ='roles';

    public function user(){
        return $this->belongsToMany('App\Models\User','roles_user','roles_id','user_id')->withPivot('email');
    }

    public function users(){
        return $this->belongsToMany('App\User')->using('App\RoleUser');
    }

    public function get_list_roles(){
        $arr = Roles::find(1)->user->toArray();
        foreach($arr as $k=>$v){
            dump($v['pivot']['email']);
        }
        die;
        return Roles::find(1)->user;
    }
}
