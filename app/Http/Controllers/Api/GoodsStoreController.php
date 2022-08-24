<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class GoodsStoreController extends Controller
{
    //

    public function goods_store(){
        $store=20;
        $res=Redis::llen('goods_store');
        $count=$store-$res;
        for($i=0;$i<$count;$i++){
            Redis::lpush('goods_store',1);
        }
        dump(Redis::lrange('goods_store',0,-1));
    }

    //生成唯一订单号
    function build_order_no(){
        return date('ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
    }
    //记录日志
    function insertLog($event,$type=0){
        global $conn;
        $sql="insert into ih_log(event,type) values('$event','$type')";
        mysql_query($sql,$conn);
    }
    public function create_order(){
        $price=10; $user_id=1; $goods_id=1; $sku_id=11; $number=1;
        //生成订单
        //模拟下单操作
        //下单前判断redis队列库存量
        $redis=new Redis();
        $result=$redis->connect('127.0.0.1',6379);
        $count=$redis->lpop('goods_store');
        if(!$count){
            insertLog('error:no store redis'); return;
        }
        //生成订单
        $order_sn=build_order_no();
        $sql="insert into ih_order(order_sn,user_id,goods_id,sku_id,price) values('$order_sn','$user_id','$goods_id','$sku_id','$price')";
        $order_rs=mysql_query($sql,$conn);
        //库存减少
         $sql="update ih_store set number=number-{$number} where sku_id='$sku_id'";
         $store_rs=mysql_query($sql,$conn);
         if(mysql_affected_rows()){
             insertLog('库存减少成功');
         }else{
             insertLog('库存减少失败');
         }
    }
}
