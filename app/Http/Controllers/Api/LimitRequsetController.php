<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redis;
//use Illuminate\Support\Facades\RateLimiter;
//use PHPUnit\Util\Exception;
//use App\Http\Middleware\TestMiddleware;

class LimitRequsetController extends Controller
{

//限流 ---令牌桶
    public function __construct()
    {
        $this->middleware('test')->except('minLimit');
        $this->middleware('limit')->only('minLimit');
    }
    //令牌桶的另一个好处是可以方便的改变速度。一旦需要提高速率，则按需提高放入桶中的令牌的速率。一般会定时（比如100ms）往桶中增加一定数量的令牌，有些变种算法则实时的计算应该增加的令牌的数量。
    /**
     *
     * @var int $minNum     单个用户每分钟访问数
     * @var int $dayNum     单个用户每天总的访问量
     *
     * 计算请求速率
     * 请求速率  = 访问次数/时间 * 过去了多少时间（s）
     *
     * 每次访问后补充的令牌个数计算方法
     * 获取上次访问的时间即上次存入令牌的时间，计算当前时间与上次访问的时间差，乘以速率等于此次需要补充的令牌个数，重点是补充令牌后总的令牌个数不能大于初始化的令牌个数，以补充数和初始化数的最小值为准。
     *
     *
     */
    private $minNum = 10;
    private $dayNum = 10000;

    public function getuid(Request $request){

        $result = $this->minLimit($request->input('uid'));
        return $result;

    }
    public function minLimit($uid)
    {
        $minNumKey = $uid . '_minNum';
        $dayNumKey = $uid . '_dayNum';

        $resMin    = $this->getRedis($minNumKey, $this->minNum, 60);
        $resDay    = $this->getRedis($dayNumKey, $this->dayNum, 86400);

        return Response()->success([
            'min'=>$resMin,
            'day'=>$resDay
        ]);
    }

    /**
     * @param $key      1_minNum     key
     * @param $initNum     60        初始化
     * @param $expire      60        失效
     * @return array
     */
    public function getRedis($key, $initNum, $expire)
    {
        $nowtime  = time();
        $result   = ['status' => true, 'msg' => ''];
        //Redis Watch 命令用于监视一个(或多个) key ，如果在事务执行之前这个(或这些) key 被其他命令所改动，那么事务将被打断
        Redis::watch($key);
        $limitVal = Redis::get($key);

        //判断是否缓存过
        if ($limitVal) {

            $limitVal = json_decode($limitVal, true);

            $newNum   = min($initNum, ($limitVal['num'] - 1) + (($initNum / $expire) * ($nowtime - $limitVal['time'])));
            if ($newNum > 0) {
                $redisVal = json_encode(['num' => $newNum, 'time' => time()]);
            } else {
                return ['status' => false, 'msg' => '当前时刻令牌消耗完！'];
            }
        } else {
            $redisVal = json_encode(['num' => $initNum, 'time' => time()]); //数据初始化
        }
        //Redis Multi 命令用于标记一个事务块的开始
        //事务块内的多条命令会按照先后顺序被放进一个队列当中，最后由 EXEC 命令原子性(atomic)地执行。
        Redis::multi();

        //命令内容
        Redis::set($key, $redisVal);

        //Redis Exec 命令用于执行所有事务块内的命令。
        $rob_result = Redis::exec();

        if (!$rob_result) {
            $result = ['status' => false, 'msg' => '访问频次过多！'];
        }else{
            $result = ['status'=>true,'msg'=>'访问剩余'.$redisVal];
        }
        return $result;
    }


    public function limit_data(Request $request){

        return response()->json(['status'=>200,'data'=>123123]);
//        try{
//
//            $err = 'try抛出异常错误';
//            throw new Exception($err,12312);
//        }catch(Exception $e){
//            return '捕获异常：'.$e->getMessage().'，错误代码：'.$e->getCode();
//        }
//        对于未设置的变量的判断
//        empty：变量为空
//        isset：变量未设置或变量为空


//        对于""(空字符串)的判断
//        empty：变量为空
//        isset：变量已设置且不为空


//        对于0（作为整数的0）的判断
//        empty：变量为空
//        isset：变量已设置且不为空


//        对于0.0(作为浮点数的0)的判断
//        empty：变量为空
//        isset：变量已设置且不为空


//        对于"0"(作为字符串的0)的判断
//        empty：变量为空
//        isset：变量已设置且不为空


//        对于NULL的判断
//        empty：变量为空
//        isset：变量未设置或变量为空


//        对于FALSE的判断
//        empty：变量为空
//        isset：变量已设置且不为空


//        对于array()(一个空数组)的判断
//        empty：变量为空
//        isset：变量已设置且不为空


//        isset 对于变量 未设置 和 NULL isset返回 "变量未设置或变量为空"
//        isset  对于变量设置为""，0,0.0,"0",false,array()说明变量存在


        $userid =12;
        $executed = RateLimiter::attempt(
                "send-message-".$userid,
                    $perMinute = 5,
                    function(){
                    //发送消息
                    }
        );
        if(!$executed){
            return 'Too many message sent!';
        }
    }





}
