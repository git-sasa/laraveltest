<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class TokenbucketController extends Controller
{

    /**
     * 漏桶算法
     *  漏桶算法会限制请求的速度。漏桶算法，可以保证接口会以一个匀速速率来处理请求。所以漏桶算法不会出现临界问题。
     */
    protected $minNum;
    protected $dayNum;
    public function __construct()
    {
        //按天算、按分钟算
        $this->minNum = 3;
        $this->dayNum = 1000;
    }

    public function set_userid(Request $request){

            $minNumKey = $request->input('uid').'_minNum';
            $dayNumKey = $request->input('uid').'_dayNum';
            $min = $this->redis_bucket($minNumKey,$this->minNum,60);
            $day = $this->redis_bucket($dayNumKey,$this->dayNum,86400);
            if($min['status'] || $day['status']){
                exit($min['msg'].$day['msg']);
            }
    }

    /**
     * @param $key      键名
     * @param $initNum  初始化数量 （60/m、100/m、120/m）
     * @param $expire   时间
     * @return array
     */
    public function redis_bucket($key,$initNum,$expire){

        $newtime = time();
        $result = ['status'=>true,'msg'=>'无'];
        //Redis watch 命令用于监视 一个（或多个）key，如果在事务执行之前这个（或这些）key 被其他命令所改动，那么事务将被打断
        Redis::watch($key);
        $initVal = Redis::get($key);
        if($initVal){
            $initVal = json_decode($initVal,true);
            // 指定时间内 时间/每分钟给的令牌数 * 时间
            $newNum = min($initNum,($initVal['num'] - 1) +(($initNum / $expire) * ($newtime - $initVal['time'])));
            if($newNum > 0){
                $redisVal = json(['num'=>$newNum,'time'=>$newtime]);
            }else{
                return ['status'=>false,'msg'=>'当前令牌已用完，请稍后再试！'];
            }
        }else{
            $redisVal = json_encode(['num'=>$initNum,'time'=>time()]);
        }
        //Redis Multi 命令用于标记一个事务块的开始
        Redis::multi();
        Redis::set('data',$redisVal);
        //Redis exec 命令用于执行所有事务块的命令
        $rob_result = Redis::exec();
        if($rob_result){
            return ['status'=>true,'msg'=>'访问剩余'.$redisVal];
        }else{
            return ['status'=>false,'msg'=>'访问次数过多！'];
        }
    }


}
