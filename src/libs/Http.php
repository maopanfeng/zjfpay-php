<?php

namespace zjf\pay\libs;

use zjf\pay\exceptions\RequestException;
use zjf\pay\Pay;

class Http extends \mxhei\helpers\Http
{
    public function __construct($options = [])
    {
        parent::__construct($options);
        $ua = [
            'lang/php',
            'php_version/'.phpversion(). '('.php_uname().')',
            'version/'.Pay::VERSION,
        ];
        $this->headers[] = ['X-Zjf-Pay-User-Agent' => implode(' ', $ua)];
    }
    
    /**
     * @param        $url
     * @param array  $data
     * @param string $method
     * @param array  $options
     *
     * @return bool|string
     * @throws RequestException
     */
    public function send($url, $data = [], $method = 'POST', $options = [])
    {
        try {
            $result = parent::send($url, $data, $method, $options);
            if (empty($result)) {
                throw new \Exception('请求失败');
            }
            $result = json_decode($result, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \Exception('响应格式错误');
            }
            if (!isset($result['ResponseStatus']) || $result['ResponseStatus'] != 0) {
                $code = isset($result['ResponseStatus']) ? $result['ResponseStatus'] : 100;
                throw new \Exception(isset($result['ResponseMsg'])?$result['ResponseMsg']:'请求失败', $code);
            }
            
            return $result['datas'];
        } catch (\Exception $e) {
            throw new RequestException($e->getMessage(), $e->getTrace(), $e->getCode());
        }
    }
}