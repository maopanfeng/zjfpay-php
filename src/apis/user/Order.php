<?php

namespace zjf\pay\apis\user;

use zjf\pay\apis\ApiAbstract;
use zjf\pay\apis\Endpoint;

class Order extends ApiAbstract
{
    /**
     * @param       $data
     * member_id
     * out_order_sn
     * total_fee
     * fee_type
     * client_ip
     * subject
     * body
     * time_expire
     * detail
     * device_info
     * discountable_amount
     * promo_params
     * attach
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
     * trade_no： 二选一 优先
     * out_trade_no: 二选一
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
     * member_id
     * refunded
     * canceled
     * paid
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
    
    /**
     * @param       $data
     * trade_no
     * trade_type
     * channel
     * time_expire
     * extra
     * return_url
     *
     * @param array $options
     *
     * @return bool|string
     * @throws \Exception
     */
    public function pay($data, $options = [])
    {
        return $this->sendRequest(Endpoint::USER_ORDER_PAY, $data, 'POST', $options);
    }

    /**
     * @param       $data
     * out_trade_no
     * member_id
     * @param array $options
     *
     * @return bool|string
     * @throws \Exception
     */
    public function cancel($data, $options = [])
    {
        return $this->sendRequest(Endpoint::USER_ORDER_CANCEL, $data, 'POST', $options);
    }
}