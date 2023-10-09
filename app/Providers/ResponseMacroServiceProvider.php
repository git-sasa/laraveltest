<?php

namespace App\Providers;

use App\Lib\ApiCode;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class ResponseMacroServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('fail',function($err_code, $result = null,$msg = ''){
            if(is_null($result)){
                $result = [];
            }

            if($msg){
                $err_msg = $msg;
            }else{
                $err_msg = ApiCode::getMessage($err_code);
            }

            $response_data = [
                'code' => $err_code,
                'message' => $err_msg,
                'data'=>$result,
                'timestamp' =>getMillisecond(),
            ];
            app('log')->error(sprintf('params [%s] response [%s]',
                json_encode(request()->all(),JSON_UNESCAPED_UNICODE),
                json_encode($response_data,JSON_UNESCAPED_UNICODE)
            ));
            return Response::json($response_data);
        });

        Response::macro('success',function($result,$msg=''){
            $code = 20000;
            if(is_null($result)){
                $result = [];
            }
            if($msg){
                $err_msg = $msg;
            }else{
                $err_msg = ApiCode::getMessage($code);
            }
            $response_data = [
                'code' => $code,
                'message' => $err_msg,
                'data' => $result,
                'timestamp' => getMillisecond(),
            ];

            app('log')->debug(sprintf('params [%s] response [%s]',
                 json_encode(request()->all(),JSON_UNESCAPED_UNICODE),
                 json_encode($response_data,JSON_UNESCAPED_UNICODE)
            ));
            return Response::json($response_data);
        });

    }
}





















