<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Image;
use Illuminate\Support\Facades\DB;

class Detail extends Model
{
    use HasFactory;

    public $table ="details";

    public function image(){
        return $this->morphOne('App\Models\Image','imageable');
    }

    public function getDetail(){
        $detail = Detail::find(1);
        DB::connection()->enableQueryLog();
        $image = $detail->image;
        dump($image->toArray());
        dump(DB::getQueryLog());die;
        dump($image);
    }
}
