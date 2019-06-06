<?php

namespace zjf\pay\exceptions;

use Throwable;
use zjf\pay\libs\Err;

class Exception extends \Exception
{
    /**
     * @var array $raw 原始数据
     */
    protected $raw = [];
    
    public function __construct($message = "", $raw = [], $code = Err::CODE_FAILED)
    {
        if ($message === '') {
            $code = Err::CODE_UNKNOWN;
            $message = Err::get($code);
        }
        if ($code === Err::CODE_SUCCESS) {
            $code = Err::CODE_FAILED;
        }
        $this->raw = (array)$raw;
        
        parent::__construct($message, $code);
    }
    
    public function getRaw()
    {
        return $this->raw;
    }
}