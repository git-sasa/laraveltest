<?php
namespace App\Listeners;


class UserEventSubscriber
{
    //    处理用户登录事件
    public function handleUserLogin($event){
        dump($event);
        die;
    }

    //    处理用户注销事件
    public function handleUserLogout($event){
        dump(1111111111);
        dump($event);
        die;
    }

    //    为事件订阅者注册监听器
    public function subscribe($events){
        $events->listen(
            'Illuminate\Auth\Events\Login',
            'App\Listeners\UserEventSubscriber@handleUserLogin',
        );
        $events->listen(
            'Illuminate\Auth\Events\Logout',
            'App\Listeners\UserEventsSubscriber@handleUserLogout',
        );

    }

}
