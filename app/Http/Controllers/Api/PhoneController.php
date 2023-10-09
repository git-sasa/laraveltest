<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Phone;

class PhoneController extends Controller
{
    //

    public function getPhone(){
        $phone = new Phone();
        return  $phone->getPhone();
    }
}
