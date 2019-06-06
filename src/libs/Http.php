<?php

namespace zjf\pay\libs;

class Http
{
    protected $options = [
        CURLOPT_TIMEOUT => 10,
        CURLOPT_HEADER => false,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_RETURNTRANSFER => true,
    ];
    
    public function __construct($options = [])
    {
    }
    
    public function get($url, $data = [], $options = [])
    {
    }
    
    public function post($url, $data = [], $options = [])
    {
    }
    
    public function send($url, $data = [], $method = 'POST', $options = [])
    {
    }
}