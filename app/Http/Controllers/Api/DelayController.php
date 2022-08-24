<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class DelayController extends Controller
{
    /**
     * 业务场景
     * 订单一直处于未支付状态时，如何及时的关闭订单，并退还库存？
     * 如何定期检查处于退款状态的订单是否已经退款成功？
     *
     * 设计细节
     * 如何快速消费zing：delay_queue:queue
     * 最简单的实现方式就是使用定时器进行秒级扫描，为了保证消息执行的时效性，可以设置每1s请求Redis一次，判断队列中是否有待消费的JOB。
     * 如果queue中一直没有可消费的JOB，就会导致频繁无意义的扫描，造成资源浪费，幸好List那个有一个BLPOP阻塞语句，
     * 使用BLPOP可以实现，list中有数据就会立马返回，没有数据就会一直阻塞在那里，直到有数据返回，可以设置阻塞的超时时间，超时会返回Null
     *
     */
    /**
     * photo
     */


}
