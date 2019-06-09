<?php

namespace zjf\pay\apis\misc;

use zjf\pay\apis\ApiAbstract;
use zjf\pay\apis\Endpoint;

class Channel extends ApiAbstract
{
    /**
     * 获取所有支付渠道
     * @param array $data ['type'=>'balance.charge']
     * @param array $options
     */
    public static function lists($data = [], $options = [])
    {
        return self::sendRequest(Endpoint::CHANNELS, $data, 'GET', $options);
    }
}