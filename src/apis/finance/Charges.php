<?php

namespace zjf\pay\apis\finance;

use zjf\pay\apis\ApiAbstract;
use zjf\pay\apis\Endpoint;

class Charges extends ApiAbstract
{
    /**
     * @param       $data
     * @param array $options
     *
     * @return bool|string
     * @throws \Exception
     */
    public function add($data, $options = [])
    {
        return $this->sendRequest(Endpoint::FINANCE_CHARGES_ADD, $data, 'POST', $options);
    }
    
    /**
     * @param       $data
     * @param array $options
     *
     * @return bool|string
     * @throws \Exception
     */
    public function edit($data, $options = [])
    {
        return $this->sendRequest(Endpoint::FINANCE_CHARGES_EDIT, $data, 'POST', $options);
    }

    /**
     * @param       $data
     * @param array $options
     *
     * @return bool|string
     * @throws \Exception
     */
    public function info($data, $options = [])
    {
        return $this->sendRequest(Endpoint::FINANCE_CHARGES_INFO, $data, 'POST', $options);
    }
    
    /**
     * @param       $data
     *
     * @param array $options
     *
     * @return bool|string
     * @throws \Exception
     */
    public function lists($data, $options = [])
    {
        return $this->sendRequest(Endpoint::FINANCE_CHARGES_LISTS, $data, 'POST', $options);
    }
    /**
     * @param       $data
     *
     * @param array $options
     *
     * @return bool|string
     * @throws \Exception
     */
    public function export($data, $options = [])
    {
        return $this->sendRequest(Endpoint::FINANCE_CHARGES_EXPORT, $data, 'POST', $options);
    }
    /**
     * @param       $data
     *
     * @param array $options
     *
     * @return bool|string
     * @throws \Exception
     */
    public function types($data, $options = [])
    {
        return $this->sendRequest(Endpoint::FINANCE_CHARGES_TYPES, $data, 'POST', $options);
    }
}