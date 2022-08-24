<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LdyPhoneWechat extends Model
{
    use HasFactory;
    protected $table = 'ldy_phone_wechat';


    public function test_sql($query){
        $result = DB::select($query);
        return $result;

    }
}
