<?php

/**
 *  获取时间戳到毫秒
 * @return bool|string
 */

function getMillisecond(){
    list($msec,$sec) = explode(' ',microtime());
    $msectime = (float)sprintf('%.0f',(floatval($msec)+floatval($sec)) * 1000);
    return $msectimes = substr($msectime,0,13);
}
