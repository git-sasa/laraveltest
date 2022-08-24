<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LdyPhoneWechat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class WeiboController extends Controller
{
    /**
     * 微博发布（发布微博）
     */
    public function publish(){


        //随机查询一条数据
        $query = "select * from 'table' order by rand() limit 1";
        $ar = [
            1,2,3,1,4
        ];
        $result = array_unique($ar);
        dump($result);
        dump($ar);die;
        $content = 'content';
        if(!$content){
            error('内容不能够为空');
        }
        $user = [
            'userid'=>100,
            'username'=>'张三'
        ];
//        $user = $this->isLogin();
//        if($user==false){
//            header("location:index.PHP");
//            exit();
//        }
//        $r = redis_connect();
        $postid = Redis::incr('global:postid');

        //Redis::set("post:postid:".$postid.":time",time());
        //Redis::set("post:postid:".$postid.":userid",$user['userid']);
        //Redis::set("post:postid:".$postid.":conten t",$content);
        Redis::hmset("post:postid:".$postid,array('userid'=>$user['userid'],'username'=>$user['username'],'time'=>time(),'content'=>$content));
        //把微博推给自己的粉丝
        $fans = Redis::smembers("followed:".$user['userid']);
        //拿到自己的粉丝列表 循环将新微博对应的id插入到每个粉丝用户微博接收站后再将新微博对应的id插入到自己的微博接收站
        $fans[] = $user['userid'];
        foreach($fans as $fansid){
            Redis::lpush('recivepost:'.$fansid,$postid);
        }
        //单独累计个人发布的信息
        Redis::lpush('userpostid:'.$user['userid'],$postid);
        dump(Redis::lrange('userpostid:'.$user['userid'],0,-1));
        header("location:home.PHP");
        exit;
        include("bottom.PHP");

        //发微博一个是自己的数据中有，还要展现在关注我的人的微博列表中
//        文章id是自增的
        //把文章的内容存储为hset哈希类型的数据 (文章hash的取名规则 hmset(post:postid:文章id,array()))
//        循环关注我的好友信息将文章插入到以用户id为命名方式的list数据类型中（lpush(recivepost:关注用户id，post:postid:文章id)）
//        将hash存储的数据key存储到以用户id为命名方式的list数据类型中（lpush（userpostid:本人id，post:postid:文章id））
    }

    public function isLogin(){

    }

    /**
     * 微博关注
     */
    public function follow_user(){

//        if($this->isLogin()==false){
//            header("location:index.PHP");
//            exit;
//        }
//        $user = $this->isLogin();
//        $uid = trim($_GET['uid']);
//        $f = trim($_GET['f']);
//        $r = redis_connect();
        $user = [
            'userid'=>100,
            'username'=>'张三'
        ];
        $uid  = 10086;
        $f = 0;
        if($f==0){
            //将关注与被关注的数据结构存入redis set集合中
            Redis::sadd("following:".$user['userid'],$uid);
            Redis::sadd("followed:".$uid,$user['userid']);
        }else{
            //取消关注
            Redis::srem("following:".$user['userid'],$uid);
            Redis::srem("followed:".$uid,$user['userid']);
        }
//根据传递过来的userid查找username
        $uname = Redis::get("user:userid:".$uid.":username");
        dump($uname);
//        header("location:profile.PHP?u=".$uname);
//        include("bottom.PHP");
    }



    public function test_sql(LdyPhoneWechat $ldy_phone_wechat_copy1){

        $query = "select * from ldy_phone_wechat_copy1 order by RAND() limit 1";


//        select id from ldy_phone_wechat_copy1 RAND() limit 50
//        select * from ldy_phone_wechat_copy1 where ceil(RAND * (id < MAX(id) and id>Min(id) + Min(id))
//        $query = "select * from ldy_phone_wechat_copy1  as a join (select id from ldy_phone_wechat_copy1 RAND() limit 50) as b"





        //第一种 随机查询一条数据  随机获取5条数据
        $query = "select * from ldy_phone_wechat_copy1 order by RAND() limit 5";
        //第二种 随机查询一条数据
        /**
         * SELECT MAX(id) from ldy_phone_wechat_copy1  查找表中的最大值
         * select floor(RAND() * (SELECT MAX(id) from ldy_phone_wechat_copy1))    获取小于最大值范围以内的一个整数值
         */
        $query = "select * from ldy_phone_wechat_copy1 where id >=(select floor(RAND() * (select MAX(id) from ldy_phone_wechat_copy1))) limit 1";
        $query ="select * from ldy_phone_wechat_copy1 where id>=(select floor(RAND() * (SELECT MAX(id) from ldy_phone_wechat_copy1))) order by id limit 1";
        //第三种
        /**
         * 避免非0开始的id自增数据 例如从10000开始增加数据
         * select MAX(id) from ldy_phone_wechat_copy1 查找表中的最大值
         * select MIN(id) from ldy_phone_wechat_copy1 查找表中的最小值
         * select MIN(id) from ldy_phone_wechat_copy1
         */
        $query = "select * from ldy_phone_wechat_copy1
                  where
                       id>=(select floor(RAND() * ((select MAX(id) from ldy_phone_wechat_copy1) - (select MIN(id) from ldy_phone_wechat_copy1)) + (select MIN(id) from ldy_phone_wechat_copy1)))
                  order by id Limit 5";
        //第四种
        /**
         * 在表中随机获取一个数字作为新表 select ROUND(RAND() * ((select MAX(id) from ldy_phone_wechat_copy1)-(select MIN(id) from ldy_phone_wechat_copy1)) + (select MIN(id) from ldy_phone_wechat_copy1)) AS id
         * 两张表取交集并且t1.id >= 随机获取的id
         * 减少随机的一部分数据 最后 正序排列 取出第一个值。
         */
        $query = "select * from ldy_phone_wechat_copy1 as t1
                  Join (
                        select ROUND(RAND() * ((select MAX(id) from ldy_phone_wechat_copy1)-(select MIN(id) from ldy_phone_wechat_copy1)) + (select MIN(id) from ldy_phone_wechat_copy1)) AS id_2
                      ) AS t2
                  where
                        t1.id >= t2.id_2
                  order by
                        t1.id limit 5";





//
        $t2 = "";
        $query = "select * from ldy_phone_wechat_copy1 as t1
                            join (
                                select ROUND(
                                    RAND() * ((select MAX(id) from ldy_phone_wechat_copy1) - (select MIN(id) from ldy_phone_wechat_copy)) + (select MIN(id) from ldy_phone_wechat_copy1)) as uid
                                ) as t2
                           where t1.id>= t2._uid order by id limit 1";

        $result = $ldy_phone_wechat_copy1->test_sql($query);
        dump($result);
        dump($result[0]->id);
        die;
    }
}
