<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use App\Http\Requests\LoginRequest;

class FirstController extends Controller
{

    public function login(LoginRequest $request){
        $params = $request->all();
        $token =Auth::guard('api')->attempt($params);
    }
    public function test_redis_string(){
        $result = $this->rank();
        dump($result);die;
        $result = min(60,(60-1)+ 60/60 * (50-40));
        dd($result);
//
//        $key_1 = 'user_num';
//        Redis::incr($key_1);
//        $num = Redis::get($key_1);
//        dump($num);
//        if($num >1){
//            dump(Redis::expire($key_1,60));
//            dump(Redis::get($key_1));
//            Redis::decr($key_1);
//            dump(Redis::get($key_1));
//            dump('不可重复领取'.Redis::get($key_1));
//        }
//        die;
//        Redis::del('key1');
//        dump(Redis::setnx('key1',3));
//        Redis::setnx('key1',1);
//        dump(Redis::getset('key1',2));
//        dd(Redis::get('key1'));
        //设置缓存  缓存时间永久
//        Redis::set('key1','v1');
//        Redis::set('fans_num',0);
        //自增1
//        Redis::incr('fans_num');
        //增加指定值
//        Redis::incrby('fans_num',2);
        //自减1
//        Redis::decr('fans_num');

        //减少指定值
//        Redis::decrby('fans_num',2);
//        dump(Redis::get('fans_num'));
        //设置缓存 缓存时间5秒
//        Redis::setex('key2',5,'v2');
//        //当键key3不存在时缓存设置成功
//        Redis::setnx('key3','v3');
//        //删除缓存
//        Redis::del('key1');
//        //获取缓存
//        dd(Redis::get('key2'));
    }

    public function test_redis_hash(){
        //生成购物车缓存
//        Redis::hset('cart_user_100',101,2);
//        Redis::hset('cart_user_100',103,1);
//        Redis::hset('cart_user_100',104,6);
//        Redis::hset('cart_user_100',105,2);
//        Redis::hset('cart_user_100',108,10);
//        //hash中没有自减的命令
//        Redis::hincrby('cart_user_100',101,3);
//        Redis::hincrby('cart_user_100',103,1);
//        Redis::hdel('cart_user_100',101);
//        dump(Redis::hlen('cart_user_100'));
//        dump(Redis::hgetall('cart_user_100'));

        for($i=7;$i>0;$i--){
            Redis::hset('product_'.$i,'id',$i);
            Redis::hset('product_'.$i,'name','商品名称'.$i);
            Redis::hset('product_'.$i,'img','图片链接'.$i);
            Redis::hset('product_'.$i,'price',213);
        }


        dump(Redis::hgetall('product_1'));
        dump(Redis::hgetall('product_2'));
        dump(Redis::hgetall('product_3'));
        dump(Redis::hgetall('product_4'));
        dump(Redis::hgetall('product_5'));
        dump(Redis::hgetall('product_6'));
        dump(Redis::hgetall('product_7'));
        die;

        //用来存储基本信息
        $arr = [
            'name'=>'张三',
            'age'=>12,
            'sex'=>'男',
            'other'=>[
                'aihao'=>'music'
            ]
        ];
//                                          hash
//        key             |————————————————————————————————————————|
//                        |     field                 value        |
//                        |    姓名标签               姓名数据       |
//       用户ID           |   姓名标签               姓名数据        |
//                        |    姓名标签               姓名数据       |
//                        |    姓名标签               姓名数据       |
    //                        |————————————————————————————————————————|
            Redis::hset('test1','k1','v1');
            Redis::hset('test1','k2','v2');
            Redis::hset('test_new','new_1','val_1');
        Redis::hset('test_new','new_2','val_2');
        Redis::hset('test_new','new_3','val_4');
        //删除指定键test 对应的filed 的值
//        Redis::hget('test_new','new_2');
//        //删除键test对应field的值
//        Redis::hdel('test_new','new_1');
//        //删除键test所对应的数据
//        Redis::del('test_new');
        //当键key4不存在的时候设置成功
//        dump(Redis::hsetnx('test','key4','v4'));
//        dump(Redis::hsetnx('test','key4','v5'));

        //批量存储hash数据 一维数组
        Redis::hmset('test', array('key5' => 'v5', 'key6' => 'v6'));
        //获取指定键test_arr 中的多个field
        dump(Redis::hmget('test_arr',array('name','sex','other')));
        Redis::hmget('test',array('key5'));
        //获取键中所有的field
//        dump(Redis::hkeys('test_arr'));
//        dump(Redis::hkeys('test_new'));
//        //获取指定键中所有的值
//        dump(Redis::hvals('test_arr'));
//        dump(Redis::hvals('test_new'));
//        //获取指定键中所有的field-value
//        dump(Redis::hgetall('test_arr'));
//        dump(Redis::hgetall('test_new'));
        //判断指定键key是否存在field
        if(Redis::hexists('test_arr','sex')){
            dump(Redis::hget('test_arr','sex'));
        }
        if(Redis::hexists('test_new','new_1')){
            dump(Redis::hget('test_new','new_1'));
        }

    }

    public function test_redis_list(){

//        Redis::rpush('p1','product_1');
//        Redis::rpush('p1','product_2');
//        Redis::rpush('p2','product_3');
//        Redis::rpush('p2','product_4');
//        Redis::rpush('p3','product_5');
//        Redis::rpush('p3','product_6');
//        Redis::rpush('p4','product_7');
//
//        Redis::rpush('jhs','p1');
//        Redis::rpush('jhs','p2');
//        Redis::rpush('jhs','p3');
//        Redis::rpush('jhs','p4');
        $result = Redis::lrange('jhs',0,2);
        dump($result);
        $product_list = [];
        foreach($result as $v){
            $p_list = Redis::lrange($v,0,-1);
            foreach($p_list as $p_val){
                $product_list[] = Redis::hgetall($p_val);
            }
        }
        dump($product_list);
        dump(Redis::lrange('jhs',3,-1));

        die;
        //lpush 在左侧（头）添加数据到list中 不存在时创建，返回list的长度
        //注：第一个为最先创建数据
//        dump(Redis::lpush('list',1));
        Redis::lpush('cart_user_100',2);
        Redis::lpush('list',3);
        Redis::lpush('list1',36);
        Redis::lpush('list1',34);
//        dump(Redis::blpop);
        dump(Redis::lrange('cart_user_100',0,-1));die;
//        Redis::lpush('list1',35);
        //lpushx 左添加 在左侧（头）添加数据到list1中，不存在时不创建 返回0
//        dump(Redis::lpushx('list1',3));
        //rpush 右添加 在右侧（尾部）添加数据的list中 不存在时创建 返回list的长度
//        Redis::rpush('list',4);
        //rpushx 右添加  在右侧（尾部）添加数据到list1中，不存在时不创建 返回0
//        Redis::rpushx('list1',3);
        //lpop 左取值 取出左侧第一个值并删除，返回取出的值
//        dump(Redis::lpop('list'));
        //rpop 右取值 取出右侧第一个值并删除，返回取出的值
//        dump(Redis::rpop('list'));
        //获取key为list的集合中 索引为0的数据
//        dump(Redis::lindex('list',0));
        //修改从左向右方向的键为0参数值为5
//        dump(Redis::lset('list',0,5));
        //获取list的长度
//        dump(Redis::llen('list'));
        //只保留索引0至索引2的value值，其余删除 返回true
//        dump(Redis::ltrim('list',0,2));
//        dump(Redis::ltrim('list1',0,2));
//        dump(Redis::lrange('list',0,-1));
//        dump(Redis::lrange('list1',0,-1));//die;
        //取到并删除list最右侧的参数，从左侧添加到list1中，list1不存在会创建，返回list中取到的参数
//        dump(Redis::rpoplpush('list','list1'));
//        //获取key中所有的数据 数据类型array
        dump(Redis::lrange('list',0,-1));
        dump(Redis::lrange('list1',0,-1));
        dump(Redis::rpoplpush('list','list1'));

    }


    public function test_redis_set(){
        //添加
        Redis::sadd('set',1);
        Redis::sadd('set',2);
        Redis::sadd('set',3);
        Redis::sadd('set1',2);
        Redis::sadd('set2',4);
        Redis::sadd('set2',5);
        //移除指定元素
        Redis::srem('set',2);
        //弹出添加的首个元素并删除
//        Redis::spop('set');
        //将set中2，移动到set1中，set1不存在自动创建 返回true
//        Redis::smove('set','set1',2);
        //判断键set中是否存在值2，存在true 不存在false
        dump(Redis::sismember('set',2));
//        //返回set集合中所有元素
//        dump(Redis::smembers('set'));
//        dump(Redis::smembers('set1'));
//        dump(Redis::smembers('set2'));
//        //交集
//        dump(Redis::sinter('set','set1'));
//        //并集
//        dump(Redis::sunion('set','set1'));
//        //补集(去除交集之外的)
//        dump(Redis::sdiff('set','set1'));

        //复制set2的数据覆盖set1表
//        Redis::sinterstore('set1','set2');
        //取set1与set表的交集覆盖set3
//        Redis::sinterstore('set3','set1','set');

    }

    /**
     * set有序
     *
     * */
    public function set_redis_set_order(){

        //Zunionstore 命令
        Redis::del('zset1');
        Redis::del('zset2');
        Redis::del('out');
        Redis::del('out1');
        Redis::del('out2');
        Redis::zadd('zset1',0,'one');
        Redis::zadd('zset1',4,'two');
        Redis::zadd('zset2',1,'one');
        Redis::zadd('zset2',2,'two');
        Redis::zadd('zset2',3,'three');
//        dump(Redis::zrange('zset1',0,-1));
//        dump(Redis::zrange('zset2',0,-1));
        Redis::zunionstore('out',['zset1','zset2'],['weights'=>[2,3]]);
        Redis::zunionstore('out1',['zset1','zset2'],['aggregate'=>'min']);//并集分数不相加，取最大值
        Redis::zunionstore('out2',['zset1','zset2']);//并集分数相加
        dump(Redis::zrange('out1',0,-1,true));
        dump(Redis::zrange('out2',0,-1,true));
//        foreach(Redis::zrevrange('out',0,-1) as $v){
////            dump(Redis::zscore('out',$v));
//        }
//        dump(Redis::zscore('out','three'));

        //返回key对应的value和score
        dd(Redis::zrange('out',0,-1,true));die;
//        Redis::del('zz');
//        for($i=1;$i<=10;$i++){
//            Redis::zadd('zz',10+$i,'member'.$i);
//        }
//        Redis::zadd('zz',11,'member12');
//        dump(Redis::zrange('zz',0,-1));
//        dd(Redis::zrevrange('zz',0,3));
        //	ZADD key score member
        //score 可重复使用
//        Redis::zadd('zset',1,1);
//        Redis::zadd('zset',2,2);
//        Redis::zadd('zset',3,3);
//        Redis::zadd('zset',4,4);
//        Redis::zadd('zset',5,5);//
        Redis::zadd('zset12',12,13);
//        //排序值1的位置为5
        Redis::zincrby('zset',5,1);
//        //移除值2的数据
////        Redis::zrem('zset',2);
        dump(Redis::zrange('zset',0,-1));
        dump(Redis::zcard('zset12'));
        dump(Redis::zrange('zset12',0,-1));die;
//        //返回有序集合的所有值
//        dump(Redis::zrange('zset',0,-1));
//        //返回有序集合的倒序所有值
//        zrevrange 递减排序，zrange 递增排序
//        dump(Redis::zrevrange('zset',0,5));

        //按顺序/降序返回表中指定索引区间的元素
        Redis::zadd('zset1', 1, serialize(array("key1"=>"value1")));
        Redis::zadd('zset1', 2, serialize(array("key2"=>"value2")));
        Redis::zadd('zset1', 3, serialize(array("key3"=>"value3")));
        Redis::zadd('zset1', 4, serialize(array("key4"=>"value4")));
//        dump(Redis::zrange('zset1',0,-1));
        //返回score1-3之间的元素
//        $result = Redis::zrangebyscore('zset1',1,3);

        //返回排序1-3之间的元素 及其排序值
        $result_val = Redis::zrangebyscore('zset1', 1, 3, array('withscores'=>true));
        dump($result_val);

        //返回索引1-3之间的元素，返回2条数据
        $result = Redis::zrangebyscore('zset1', 1, 3, array('withscores'=>true, "limit" => array(1,3)));
        dump($result);die;
        //统计一个索引区间的元素个数
        dump(Redis::zcount('zset1',1,10));
        dump(Redis::zcard('zset1'));
        //查询元素的索引
        dump(Redis::zscore('zset',2));
        //删除位置1-3的元素，返回删除的元素个数
        dump(Redis::zremrangebyrank('zset',1,3));
        dump(Redis::zrange('zset',0,-1));
//        dump($result);die;

    }


    /**
     * 排行榜
     */
    public function rank()
    {

        $cachekey = 'user';
        Redis::del($cachekey);

        $dataOne = [];
        for ($i=0; $i < 5; $i++) {

            // 生成随机数
            $num = rand(0,100);
            // 生成随机字符串
            $str = $this->get_random(6,'abcdefghijklmnopqrstuvwxyzABCDEFJHIJKLMNOPQRSTUVWXYZ');

            Redis::zadd($cachekey,$num,json_encode(['name'=>$str]));

            // 由大到小排序
            $dataOne = Redis::zrevrange($cachekey, 0, -1, true);

            // 由小到大排序
            $dataTow = Redis::zrange($cachekey, 0, -1, true);
        }

//        Redis::zrevrange($cachekey,0,-1,true);//降序排列
//        Redis::zrange($cachekey,0,-1,true); //升序排列

        echo "<pre>";
        print_r($dataOne);
        print_r($dataTow);

    }

    // 生成随机字符串
    public function get_random($len,$chars)
    {
        $hash = "";
        $max = strlen($chars) - 1;
        for ($i=0; $i < $len; $i++) {
            $hash .= $chars[mt_rand(0,$max)];
        }
        return $hash;
    }

    //微信抽奖小程序
    public function luck_draw(){
        Redis::del('choujiang');
        for($i=1;$i<=5;$i++){
            Redis::sadd('choujiang','user_'.$i);
        }

        dump(Redis::smembers('choujiang'));
        //抽出两名用户，用户不踢出抽奖集合
        dd(Redis::srandmember('choujiang',2));

        //随机抽出1名用户并踢出抽奖集合  不能一次抽出多个
//        dump(Redis::spop('choujiang'));
//        dd(Redis::smembers('choujiang'));
    }

    //公共的朋友
    public function common_friend(){
        Redis::del('zhangsan_friend');
        Redis::del('lisi_friend');
        for($i=1;$i<=5;$i++){
            Redis::sadd('zhangsan_friend','zs_friend_'.$i);
            Redis::sadd('lisi_friend','ls_friend_'.$i);
        }
        Redis::sadd('zhangsan_friend','lisi_friend');
        Redis::sadd('lisi_friend','zhangsan_friend');
        //公共认识的朋友ls_friend_2
        Redis::sadd('zhangsan_friend','ls_friend_2');
//        dump(Redis::smembers('zhangsan_friend'));
//        dump(Redis::smembers('lisi_friend'));

        //将张三和李四共同的好友放入common_friend中
        Redis::sinterstore("common_friend",'zhangsan_friend','lisi_friend');
        dd(Redis::smembers('common_friend'));

    }

    //可能认识的人
    public function guess_friend(){
        Redis::del('zhangsan_friend');
        Redis::del('lisi_friend');
        for($i=1;$i<=5;$i++){
            Redis::sadd('zhangsan_friend','zs_friend_'.$i);
            Redis::sadd('lisi_friend','ls_friend_'.$i);
        }
        Redis::sadd('zhangsan_friend','ls_friend_2');
        Redis::sadd('zhangsan_friend','lisi_friend');
        Redis::sadd('lisi_friend','zhangsan_friend');
//        dump(Redis::smembers('zhangsan_friend'));
//        dump(Redis::smembers('lisi_friend'));
        // sinter/sunion/sdiff 返回两个集合中 交集 / 并集 / 补集
        $list_ls_zs = Redis::sdiff('lisi_friend','zhangsan_friend');
        //张三可能认识的人
        foreach($list_ls_zs as $k=>$v){
            if($v == 'zhangsan_friend'){
                unset($list_ls_zs[$k]);
            }
        }
        dump($list_ls_zs);
        //李四可能认识的人
        $list_zs_ls = Redis::sdiff('zhangsan_friend','lisi_friend');
        foreach($list_zs_ls as $k=>$v){
            if($v == 'lisi_friend'){
                unset($list_zs_ls[$k]);
            }
        }
        dump($list_zs_ls);
    }








}
