<?php

namespace zjf\pay\apis\user;

use zjf\pay\apis\ApiAbstract;
use zjf\pay\apis\Endpoint;

class Refund extends ApiAbstract
{
    /**
     * @param       $data
     * trade_no
     * refund_fee
     * refund_mode: to_source, to_balance
     * subject
     * description
     * @param array $options
     *
     * @return bool|string
     * @throws \Exception
     */
    public function create($data, $options = [])
    {
        return $this->sendRequest(Endpoint::USER_ORDER_CHARGE, $data, 'POST', $options);
    }
    
    /**
     * @param       $data
     * trade_no
     * refund_no
     * @param array $options
     *
     * @return bool|string
     * @throws \Exception
     */
    public function query($data, $options = [])
    {
        return $this->sendRequest(Endpoint::USER_ORDER_QUERY, $data, 'POST', $options);
    }
    
    /**
     * @param       $data
     * page
     * pagesize
     * trade_no
     * created: ['st', 'et']
     *
     * @param array $options
     *
     * @return bool|string
     * @throws \Exception
     */
    public function lists($data, $options = [])
    {
        return $this->sendRequest(Endpoint::USER_ORDER_LISTS, $data, 'POST', $options);
    }
}