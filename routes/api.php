<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('guess_friend','Api\FirstController@guess_friend');
Route::get('common_friend','Api\FirstController@common_friend');
Route::get('luck_draw','Api\FirstController@luck_draw');
Route::get('rank','Api\FirstController@rank');
Route::get('test_redis_string','Api\FirstController@test_redis_string');
Route::get('test_redis_hash','Api\FirstController@test_redis_hash');
Route::get('test_redis_list','Api\FirstController@test_redis_list');
Route::get('test_redis_set','Api\FirstController@test_redis_set');



Route::get('set_redis_set_order','Api\FirstController@set_redis_set_order');

Route::get('getuid','Api\LimitRequsetController@getuid');


Route::get('minLimit','Api\TokenbucketController@minLimit');
Route::get('test','Api\TokenbucketController@test');
Route::get('RateLimit','Api\TokenbucketController@RateLimit');
Route::get('reset','Api\TokenbucketController@reset');
Route::get('add','Api\TokenbucketController@add');

Route::group(['prefix'=>'api','middleware'=>'throttle:5,10'],function(){
    Route::get('users',function(){
        return \App\User::all();
    });
});

Route::get('limit_data','Api\LimitRequsetController@limit_data');

Route::get('set_sign_in','Api\MemberSignInController@set_sign_in');
Route::get('lively','Api\MemberSignInController@lively');
Route::get('online_status','Api\MemberSignInController@online_status');
Route::get('test1','Api\FirstController@test1');
Route::get('goods_store','Api\GoodsStoreController@goods_store');
Route::get('publish','Api\WeiboController@publish');
Route::get('follow_user','Api\WeiboController@follow_user');
Route::get('test_sql','Api\WeiboController@test_sql');
Route::get('mongo_test','Api\MongoController@test');
Route::get('wechat_pay','Api\PayController@wechat_pay');
//Route::get('wechat_pay',function(){
//    dump(341312);die;
//});



//Route::get('test_redis_hash','Api\FirstController@test_redis_hash');
