<?php

namespace zjf\pay\libs;

use mxhei\signature\Signature;
use zjf\pay\Pay;

class Sign
{
    protected $inst;
    
    public function __construct($config = [])
    {
        $config = array_merge(Pay::getConfig('signature', []), $config);
        $this->inst = new Signature($config);
    }
    
    public function verify($data)
    {
        return $this->inst->setData($data)->verify();
    }
    
    public function make($data)
    {
        $sign = $this->inst->setData($data)->make();
        
        return $sign;
    }
}