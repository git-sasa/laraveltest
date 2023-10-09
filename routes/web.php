<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
//    $nbMaxDecimals = 2;
//    $min = 0;
//    $max = 10;
//    if ($min > $max) {
//        throw new \LogicException('Invalid coordinates boundaries');
//    }
//    for($i=0;$i<20;$i++){
//        dump(round($min + mt_rand() / mt_getrandmax() * ($max - $min), $nbMaxDecimals));
//    }
//    die;
    return view('welcome');


});
