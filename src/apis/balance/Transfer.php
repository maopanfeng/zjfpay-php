<?php

namespace zjf\pay\apis\balance;

use zjf\pay\apis\ApiAbstract;
use zjf\pay\apis\Endpoint;

class Transfer extends ApiAbstract
{
    public function create($data, $options = [])
    {
        return $this->sendRequest(Endpoint::BALANCE_TRANSFER_CREATE, $data, 'POST', $options);
    }
    
    public function query($data, $options = [])
    {
        return $this->sendRequest(Endpoint::BALANCE_TRANSFER_QUERY, $data, 'POST', $options);
    }
    
    public function lists($data, $options = [])
    {
        return $this->sendRequest(Endpoint::BALANCE_TRANSFER_LISTS, $data, 'POST', $options);
    }
}