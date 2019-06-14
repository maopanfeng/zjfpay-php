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
}