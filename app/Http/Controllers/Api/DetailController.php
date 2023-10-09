<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Models\Detail;

class DetailController extends Controller
{
    //
    public $detail;
    public function __construct(){
        $this->detail = new Detail();
    }

    public function getDetail(){

        $this->detail->getDetail();
    }

    public function getImage(){
        $image = new Image();
        $image->getImage();
    }
}
