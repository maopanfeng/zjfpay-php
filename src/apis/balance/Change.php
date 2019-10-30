<?php

namespace zjf\pay\apis\balance;

use zjf\pay\apis\ApiAbstract;
use zjf\pay\apis\Endpoint;

class Change extends ApiAbstract
{
    public function create($data, $options = [])
    {
        return $this->sendRequest(Endpoint::BALANCE_CHANGE_CREATE, $data, 'POST', $options);
    }
    
    public function change($data, $options = [])
    {
        return $this->sendRequest(Endpoint::BALANCE_CHANGE_MUL, $data, 'POST', $options);
    }
}