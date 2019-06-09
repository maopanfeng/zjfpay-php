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
     * notify_url
     * return_url
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
     * @param array $options
     *
     * @return bool|string
     * @throws \Exception
     */
    public function update($data, $options = [])
    {
        return $this->sendRequest(Endpoint::USER_ORDER_UPDATE, $data, 'POST', $options);
    }
    /**
     * @param       $data
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