<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Roles;
use App\Models\Supplier;
use App\Models\Countries;
class UserController extends Controller
{
    //

    public function get_userinfo(){
        $user_mode = new User();
        $user_mode->get_userinfo();
    }


    public function get_list_roles(){
        $roles = new Roles();
        $roles->get_list_roles();
    }

//获取用户history
    public function gethistory(){
        $supplier = new Supplier();
        $supplier->gethistory();
    }

    public function getuserPosts(){
        $countries = new Countries();
        $countries->getuserPosts();
    }
}
