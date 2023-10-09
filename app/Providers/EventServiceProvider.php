<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\OrderShipped;
use App\Listeners\SendShipmentNotification;



class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        OrderShipped::class=>[
            SendShipmentNotification::class,
        ],
    ];

    protected  $subscribe = [
//        'App\Listeners\UserEventSubscriber',
    ];

    /**
     * Register any events for your application.
     *php
     * @return void
     */
    public function boot()
    {
        Event::listen('events.*',function($eventName,array $data){

        });
    }


}
