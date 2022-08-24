<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class MemberSignInController extends Controller
{
    //

    /**
     * BitMap是什么？
     * 就是通过一个bit“位”表示信息的最小单位，用来表示某个未定的值或者状态，其中的key就是对饮元素本身。
     * 其中8个bit可以组成一个byte，所以bitmap本身会极大的节省储存空间。
     *
     */
    /**
     * Redis中的BitMap？
     * Redis从2.2版本增加了setbit,getbit,bitcount等几个bitMap相关命令。
     * setbit等命令只不过是在set上的扩展。
     *
     */
//    setbit key offset value
//    大概的空间占用计算公式是（$offset/8/1024/1024）MB

    /**
     * 用户签到
     *
     */
    public function set_sign_in(){
        $uid = 1;
        //记录有uid的key
        $cacheKey = sprintf("sign_%d",$uid);
//        Redis::del($cacheKey);

        //开始统计签到时间
        $startDate = '2022-04-01';
        //签到时间
        $todayDate = '2022-04-05';

        //计算offset
        $startTime = strtotime($startDate);
        $todayTime = strtotime($todayDate);
        //统计连续签到天数
        $offset = floor(($todayTime - $startTime)/86400);

        echo "今天是第 $offset 天".PHP_EOL;
        //标记连续签到
//        Redis::setBit($cacheKey,$offset,1);
        //查询签到情况
        $bitstatus = Redis::getBit($cacheKey,$offset);

        for($offset;$offset>=0;$offset--){
            dump("第".$offset.'天状态：'.Redis::getBit($cacheKey,$offset));
        }

        echo 1 == $bitstatus ? '今天已经签到' : "还没有签到</br>";

        //计算签到次数
        echo Redis::bitCount($cacheKey).PHP_EOL;
    }

    /**
     * 统计活跃用户
     * BITOP命令支持AND、OR、NOT、XOR 这四种操作中的任意一种参数
     */
    public function lively(){
        $data = array(
            '2017-01-10' => array(1,2,3,4,5,6,7,8,9,10),
            '2017-01-11' => array(1,2,3,4,5,6,7,8),
            '2017-01-12' => array(1,2,3,4,5,6),
            '2017-01-13' => array(1,2,3,4),
            '2017-01-14' => array(1,2)
        );

        foreach($data as $date=>$uids){
//            dump(sprintf("stat_%s",$date));

            $number = 12;
            dump(sprintf("%1.2f",$number));die;
            $cacheKey = sprintf("stat_%s",$date);
            foreach($uids as $uid){
                Redis::setBit($cacheKey,$uid,1);
            }
        }
        //bitOp获取交集
        Redis::bitOp('AND','stat','stat_2017-01-10','stat_2017-01-11','stat_2017-01-12').PHP_EOL;
        echo "总活跃用户",Redis::bitCount('stat').PHP_EOL;
        Redis::bitOp('AND', 'stat1','stat_2017-01-10','stat_2017-01-11','stat_2017-01-14').PHP_EOL;
        echo "总活跃用户",Redis::bitCount('stat1').PHP_EOL;
        Redis::bitOp('AND','stat2','stat_2017-01-10','stat_2017-01-11').PHP_EOL;
        echo "总活跃用户：",Redis::bitCount('stat2').PHP_EOL;
    }

    /**
     * 用户在线状态、统计活跃用户
     *
     */
    public function online_status(){
        //range 生成1到5000 包含1,5000的数组
        $uids = range(1,10);
        foreach($uids as $uid){
            $status = $uid % 2;
            //rand() 与 mt_rand()
            /**
             * rand()与mt_rand()的随机数发生器不同，rand()的发生器具有一些不确定性和未知的特性而且效率很低；mt_rand()的随机数发生器的平均速度比rand()快四倍。
             */
//            $status = mt_rand(0,1);
            Redis::setBit('online1',$uid,$status);
            Redis::setBit('online2',$uid,mt_rand(0,1));
            Redis::setBit('online3',$uid,mt_rand(0,1));
        }
        /**
         * microtime(get_as_float)
         * microtime函数返回当前Unix时间戳的微秒数，默认返回微秒数字符串
         * get_as_float 可选 设置为True时返回浮点类型float而不是字符串，单位为秒，默认为FALSE，返回字符串
         *
         **/
//        $startTime = microtime(true);
        $str1 = $str2 = $str3 = '';
        foreach($uids as $uid){
//            dump("用户 $uid 的状态：".Redis::getBit('online1',$uid));
            $str1  .=Redis::getBit('online1',$uid).',';
            $str2 .= Redis::getBit('online2',$uid).',';
            $str3 .= Redis::getBit('online3',$uid).',';
        }

//         统计在线用户量bitCount统计为1的个数
        //bitop operation destkey key [key...]
        //对一个或多个保存二进制位的字符串key进行位元操作，并将结果保存到destkey上
        //bitop命令支持AND、OR、NOT、XOR这四种操作中的任意一种参数
        dump(Redis::bitop('AND','dest','online1','online2','online3'));
        dump(Redis::bitCount('dest'));
        die;
//        $endTime = microtime(true);
//        echo "total:".($endTime - $startTime).'s';

    }































}
