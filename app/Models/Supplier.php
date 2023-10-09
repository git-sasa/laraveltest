<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\History;

class Supplier extends Model
{
    use HasFactory;
    public $table = 'supplier';
//用户的记录
    public function userHistory(){
//        return $this->hasOneThrough('App\models\History','App\models\User','用户表中的供应商外键'，'用户日志表中的用户外键'，'供应商主键'，'用户主键');
        return $this->hasOneThrough('App\models\History','App\models\User');
    }

/*
 * user         id      supplier_id
 *
 * supplier     id
 *
 * history      id      user_id
 * 供应商想获取用户对应的历史记录，
 * supplier 可以通过 user 获取 history中的记录
 * 获取 供应商1 所对应的用户的历史记录
 *
 * */
    public function gethistory(){
        $arr = Supplier::find(2)->userHistory;
        dump($arr->toArray());die;
    }
}
