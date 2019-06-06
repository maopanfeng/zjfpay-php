<?php

namespace zjf\pay\libs;

class Err
{
    const CODE_SUCCESS = 0;
    const CODE_FAILED = 100;
    const CODE_UNKNOWN = '9999';
    
    // 1xxx
    const CODE_ENV_ERROR = '1011';
    
    protected static $messages = [
        self::CODE_FAILED => 'Failed',
        self::CODE_UNKNOWN => 'Unknown Error',
    ];
    
    public static function get($code)
    {
        if (isset(self::$messages[$code])) {
            return self::$messages[$code];
        }
        
        return self::$messages[self::CODE_UNKNOWN];
    }
}