<?php

namespace zjf\pay\apis\balance;

use zjf\pay\apis\ApiAbstract;
use zjf\pay\apis\Endpoint;

class ReCharge extends ApiAbstract
{
    public function create($data, $options = [])
    {
        return $this->sendRequest(Endpoint::BALANCE_RECHARGE_CREATE, $data, 'POST', $options);
    }
    
    public function query($data, $options = [])
    {
        return $this->sendRequest(Endpoint::BALANCE_RECHARGE_QUERY, $data, 'POST', $options);
    }
    
    public function lists($data, $options = [])
    {
        return $this->sendRequest(Endpoint::BALANCE_RECHARGE_LISTS, $data, 'POST', $options);
    }
    
    public function pay($data, $options = [])
    {
        return $this->sendRequest(Endpoint::BALANCE_RECHARGE_PAY, $data, 'POST', $options);
    }
    
    public function cancel($data, $options = [])
    {
        return $this->sendRequest(Endpoint::BALANCE_RECHARGE_CANCEL, $data, 'POST', $options);
    }
}