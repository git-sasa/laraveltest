<?php


namespace App\Lib;


class ApiCode
{
    const OK = 20000;
    const FAILED_PARAMES = 40001;
    const FAILED = 50000;
    const FAILED_NO_EXIST = 50001;
    const FAILED_AUTH_EXPIRED = 50002;
    const FAILED_HTTP = 50003;
    public static $messageMapper = [
        self::OK => '成功',
        self::FAILED => '失败',
        self::FAILED_PARAMES => '请求参数有误',
        self::FAILED_HTTP => 'HTTP请求异常',
        self::FAILED_NO_EXIST => '授权码不存在',
        self::FAILED_AUTH_EXPIRED => '授权码过期',
    ];

    /**
     * Get code message
     * @param $code
     * @return string
     */
    public static function getMessage($code){

        return self::$messageMapper[$code] ?? '服务器未知错误';
    }
}
