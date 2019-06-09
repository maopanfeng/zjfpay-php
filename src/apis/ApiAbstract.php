<?php

namespace zjf\pay\apis;

use Inhere\Validate\Validation;
use mxhei\helpers\Str;
use mxhei\signature\Signature;
use zjf\pay\contracts\ApiInterface;
use zjf\pay\exceptions\ParamsException;
use zjf\pay\libs\Http;
use zjf\pay\Pay;

abstract class ApiAbstract implements ApiInterface
{
    public function __construct()
    {
    }
    
    protected function sendRequest($endpoint, $data =[], $method = 'POST', $options = [])
    {
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
        $sign = new Signature();
        $data['Sign'] = $sign->setData($data)->make();
        
        return $data;
    }
    
    /**
     * @param       $data
     * @param       $rules
     * @param       $message
     *
     * @throws ParamsException
     */
    protected function validate($data, $rules, $message = [])
    {
        $validator = Validation::make($data, $rules)->setMessages($message);
        
        if (!$validator->validate($data)) {
            throw new ParamsException('参数错误', $validator->getMessages());
        }
    }
}