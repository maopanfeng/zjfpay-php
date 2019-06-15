<?php

namespace zjf\pay\apis\balance;

use zjf\pay\apis\ApiAbstract;
use zjf\pay\apis\Endpoint;

class Withdrawal extends ApiAbstract
{
    public function create($data, $options = [])
    {
        return $this->sendRequest(Endpoint::BALANCE_WITHDRAWAL_CREATE, $data, 'POST', $options);
    }
    
    public function query($data, $options = [])
    {
        return $this->sendRequest(Endpoint::BALANCE_WITHDRAWAL_QUERY, $data, 'POST', $options);
    }
    
    public function lists($data, $options = [])
    {
        return $this->sendRequest(Endpoint::BALANCE_WITHDRAWAL_LISTS, $data, 'POST', $options);
    }
    
    public function pay($data, $options = [])
    {
        return $this->sendRequest(Endpoint::BALANCE_WITHDRAWAL_PAY, $data, 'POST', $options);
    }
}