<?php

class Log
{
    public static function info($data, $result)
    {
        self::write('info', $data, $result);
    }
    
    public static function error($data, $error)
    {
        $result = [
            'msg' => $error->getMessage(),
            'file' => $error->getFile(),
            'line' => $error->getLine(),
            'trace' => $error->getTrace(),
            'raw' => method_exists($error, 'getRaw') ? $error->getRaw() : '',
        ];
        self::write('error', $data, $result);
        echo $error->getMessage();
    }
    
    public static function write($type, $data, $result)
    {
        $file = __DIR__.'/logs/'.$type.'-'.date('Ymd').'.log';
        $msg = "----------请求数据---------\n";
        $msg .= var_export($data, true);
        $msg .= "\n--------------------------\n";
        
        $msg .= "\n----------结果---------\n";
        $msg .= var_export($result, true);
        $msg .= "\n--------------------------\n";
        
        error_log($msg, 3, $file);
    }
}