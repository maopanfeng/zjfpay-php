<?php

namespace zjf\pay\apis\user;

use zjf\pay\apis\ApiAbstract;
use zjf\pay\apis\Endpoint;

class User extends ApiAbstract
{
    /**
     * @param       $data
     *  app_id
     *  mch_id
     *  member_id
     *  email
     *  mobile
     *  name
     *  extra: json, eg: {"avatar":"", "gender":"", "address":""}
     *
     * @param array $options
     *
     * @return bool|string
     * @throws \Exception
     */
    public function create($data, $options = [])
    {
        return $this->sendRequest(Endpoint::USER_USER_CREATE, $data, 'POST', $options);
    }
    
    /**
     * @param       $data
     * member_id
     * @param array $options
     *
     * @return bool|string
     * @throws \Exception
     */
    public function query($data, $options = [])
    {
        return $this->sendRequest(Endpoint::USER_USER_QUERY, $data, 'POST', $options);
    }
    
    /**
     * @param       $data
     * page
     * pagesize
     * disabled
     * member_type
     * email
     * name
     * phone
     * created: ['st', 'et']
     *
     * @param array $options
     *
     * @return bool|string
     * @throws \Exception
     */
    public function lists($data, $options = [])
    {
        return $this->sendRequest(Endpoint::USER_USER_LISTS, $data, 'POST', $options);
    }
    /**
     * @param       $data
     * member_id
     * email
     * mobile
     * name
     * extra: json, eg: {"avatar":"", "gender":"", "address":""}
     *
     * @param array $options
     *
     * @return bool|string
     * @throws \Exception
     */
    public function update($data, $options = [])
    {
        return $this->sendRequest(Endpoint::USER_USER_UPDATE, $data, 'POST', $options);
    }
}