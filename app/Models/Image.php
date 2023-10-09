<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    public $table = 'images';

    public function imageable(){

//        获取拥有此图片的模型
        return $this->morphTo();

    }

    public function getImage(){
        $image =Image::find(1);
        $imageable = $image->imageable;
        dump($imageable->toArray());die;
    }

}
