<?php

namespace zjf\pay\libs;

class Notify
{
    public function verify()
    {
        $data = $_POST;
        $sign = new Sign();
        
        return $sign->verify($data);
    }
    
    public function success()
    {
        exit('success');
    }
    
    public function failed()
    {
        exit('failed');
    }
}