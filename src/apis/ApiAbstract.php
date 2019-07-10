<?php

namespace zjf\pay\apis;

use mxhei\helpers\Str;
use zjf\pay\contracts\ApiInterface;
use zjf\pay\exceptions\OffException;
use zjf\pay\libs\Http;
use zjf\pay\libs\Sign;
use zjf\pay\Pay;

abstract class ApiAbstract implements ApiInterface
{
    protected function sendRequest($endpoint, $data =[], $method = 'POST', $options = [])
    {
        if (!Pay::isOn()) {
            throw new OffException('Zjfpay未启用');
        }
        try {
            $data = $this->mergeData($data);
            $url = $this->getUrl($endpoint);
            $data = $this->makeSign($data);
            
            $result = Http::inst()->send($url, $data, $method, $options);
            
            return $result;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }
    
    /**
     * @param $data
     *
     * @return array
     * @throws \Exception
     */
    protected function mergeData($data)
    {
        $payload = [
            'mch_id' => Pay::getMchId(),
            'app_id' => Pay::getAppId(),
            'version' => Pay::VERSION,
            'nonce_str' => Str::random(),
            'sign_type' => 'md5',
        ];
        
        return array_merge($payload, $data);
    }
    
    /**
     * @param $endpoint
     *
     * @return string
     */
    protected function getUrl($endpoint)
    {
        $url = rtrim(Pay::getBaseUri(), '/').'/'.$endpoint;
        
        return $url;
    }
    
    protected function makeSign($data)
    {
        $sign = new Sign();
        $data['Sign'] = $sign->make($data);
        //error_log("\n".json_encode($data, JSON_UNESCAPED_UNICODE), 3, __DIR__.'/log.log');
        return $data;
    }
}