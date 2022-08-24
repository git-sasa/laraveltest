<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Yansongda\LaravelPay\Facades\Pay;

class PayController extends Controller
{

    public function wechat_pay(){

        $order = [
            'out_trade_no' => time().'',
            'description' => 'subject-测试',
            'amount' => [
                'total' => 1,
            ],
            'payer' => [
                'openid' => 'onkVf1FjWS5SBxxxxxxxx',
            ],
        ];
        return Pay::wechat()->mp($order);
    }
}
