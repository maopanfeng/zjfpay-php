<?php
require __DIR__.'/../deals/UserDeal.php';

class UserCtr
{
    protected $member;
    
    public function __construct()
    {
        $this->member = new \zjf\pay\apis\user\User();
    }
    
    public function query($data = [])
    {
        $data = [
            'member_id' => '9',
        ];
        try {
            $result = $this->member->query($data);
            $this->log($result, $data);
        } catch (\Exception $e) {
            $this->log([], [], $e);
        }
    }
    
    protected function log($result=[], $data=[], $error=[])
    {
        echo '<pre>';
        echo '----------请求数据---------<br>';
        echo var_export($data, true);
        echo '<br>--------------------------<br>';
        
        echo '----------响应数据---------<br>';
        echo var_export($result, true);
        echo '<br>--------------------------<br>';
        
        echo '----------错误信息---------<br>';
        echo var_export([
            'msg' => $error->getMessage(),
            'file' => $error->getFile(),
            'line' => $error->getLine(),
            'trace' => $error->getTrace(),
        ], true);
        echo '<br>--------------------------<br>';
    }
}