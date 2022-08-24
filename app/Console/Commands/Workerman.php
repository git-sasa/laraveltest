<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Workerman\Worker;

class Workerman extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'workerman:websocket {action} {--daemonize}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'workerman websocket';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        global $argv;
        $action = $this->argument('action');
        $argv[0] = 'workerman:websocket';
        $argv[1] = $action;
        $argv[2] = $this->option('daemonize') ? '-d':'';
        $ws_worker = new Worker('websocket://0.0.0.0:2000');
        $ws_worker->onMessage = function($connection,$data){
            $connection->send('laravel workerman hello world');
        };
        Worker::runAll();
//        return 0;
    }







}



















