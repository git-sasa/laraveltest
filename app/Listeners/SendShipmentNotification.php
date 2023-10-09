<?php

namespace App\Listeners;

use App\Events\OrderShipped;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendShipmentNotification implements ShouldQueue
{
    use InteractsWithQueue;
    /**
     * Create the event listener.
     *
     * @return void
     */
//    任务被处理的延迟时间（秒）
    public $delay = 60;
//     任务被发送到队列的名称
    public $queue = 'SendShip';
//    任务被发送到链接的名称
    public $connection = 'sqs';
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\OrderShipped  $event
     * @return void
     */
    public function handle(OrderShipped $event)
    {
//        if(true){
//            $this->delete();
//        }
        dump($event->user->name);die;
    }
}
