<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\Demo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\User;
use App\Events\OrderShipped;

//laravel的facade 和 辅助函数 提供了一种利用 Laravel 服务的简单方法，无需类型提示并可以从服务容器找那个解析Contract.
//在大多数情况下，每个Facade都有一个等效的Contract.
//队列 + 事件
//

//Contract允许为类定义显示依赖关系。
//Facade更加便利。

class MemcachedController extends Controller
{
    public function memcachedInfo(){
//        将users数据写入Cache缓存中
//        Cache::forever('mykey1','val1');
//        Cache::add('mykey4',123);
//        Cache::increment('mykey4');
//       dump(Cache::put('mykey2','val2',60));
//        Cache::put('mykey3','val3',1);
//        Cache::set('mykey5',12);
//        Cache::increment('mykey5',5);
//        Cache::decrement('mykey5');
////        Cache::rememberForever('users',function(){
////            return User::get();
////        });
//
//        dump('mykey5=>'.Cache::get('mykey5'));
//        dump('mykey4=>'.Cache::get('mykey4'));
//        dump(Cache::get('mykey2'));
//        dump('mykey3=>'.Cache::get('mykey3'));
//        Cache::forget('mykey1');
//        $arr = Cache::get('mykey1');
//        dump(Cache::get('mykey1'));
//        dump('mykey1=>'.$arr);
        Cache::set('mykey2',123);
//        Cache::flush();
//        dump(Cache::pull('mykey2'));
//        dump(Cache::get('mykey2'));
        Cache::tags(['people','singer'])->set('name','张三');
        Cache::tags(['people','singer1'])->set('name','李四');
//        Cache::tags(['people','singer1'])->pull('name');
        Cache::set('name','王五');

        $res = Cache::tags(['people','singer1'])->get('name');
        dump($res);
        dump('name=>'.Cache::get('name'));
        die;
//        $arr = Cache::get('users')->toArray();
//////        pull 获取数据
//        $users = Cache::pull('users');
//        $users_2 = Cache::pull('users');
//        dump($users->toArray());
//        dump($users_2);
//        put在缓存中存储数据
//        Cache::put('key_3','val_3',10);
//        $a = Cache::add('key_5','val_5',30);
//        dump($a);
//        dump(Cache::get('key_5'));
//        $val5 = Cache::get('key_5');
//        dump($val5);

//        $a = Cache::add('key_3','val_3',30);
//        dump($a);
//        dump(Cache::get('key_3'));
////        cache辅助参数
//        cache(['key_4'=>'val_4']);
//        dump(cache('key_4'));
////        清空缓存
//        Cache::flush();
        return response()->json([
            'status'=>'200',
           'data'=>[],
        ]);
    }
}
