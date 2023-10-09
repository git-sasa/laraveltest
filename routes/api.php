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
//使用路由中间件
//Route::get('guess_friend','Api\FirstController@guess_friend')->middleware('pre');
Route::get('guess_friend','Api\FirstController@guess_friend');
//Route::get('try_catch_test','Api\FirstController@try_catch_test');
Route::post('try_catch_test','Api\FirstController@try_catch_test');
Route::get('common_friend','Api\FirstController@common_friend');
Route::get('luck_draw','Api\FirstController@luck_draw');
Route::get('rank','Api\FirstController@rank');
Route::get('test_redis_string','Api\FirstController@test_redis_string');
Route::get('test_redis_hash','Api\FirstController@test_redis_hash');
Route::get('test_redis_list','Api\FirstController@test_redis_list');
Route::get('test_redis_set','Api\FirstController@test_redis_set');
Route::get('text','Api\FirstController@text');
Route::get('test1','Api\FirstController@test1');



Route::get('set_redis_set_order','Api\FirstController@set_redis_set_order');

Route::get('getuid','Api\LimitRequsetController@getuid');

Route::get('set_userid','Api\TokenbucketController@set_userid');
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


Route::get("good_total",'Api\FirstController@good_total');
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
Route::get('role',[
    'middleware'=>'role:editor',
    'uses'=>'Api\LimitRequsetController@limit_data',
]);
//Route::get('wechat_pay',function(){
//    dump(341312);die;
//});



Route::get('get_phone','Api\PhoneController@getPhone');
Route::get('get_userinfo','Api\UserController@get_userinfo');
Route::get('get_list_roles','Api\UserController@get_list_roles');
Route::get('gethistory','Api\UserController@gethistory');
Route::get('getuserPosts','Api\UserController@getuserPosts');
Route::get('getDetail','Api\DetailController@getDetail');
Route::get('getImage','Api\DetailController@getImage');
Route::get('memcachedInfo','Api\MemcachedController@memcachedInfo');

Route::get('getfile','Api\FirstController@getfile');

Route::get("test123",function(){
    echo "1111111111";
});

Route::get('test_api','Api\TestController@test');
