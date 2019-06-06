<?php

namespace zjf\pay\libs;

class Notify
{
    protected $result = [];
    
    public function __construct($result)
    {
        $this->result = $result;
    }
    
    public function isSuccess()
    {
    }
    
    public function isPayed()
    {
    }
    
    public function success()
    {
    }
    
    public function failed()
    {
    }
}