<?php

class OrderDeal
{
    public static function create($result)
    {
        echo $result['trade_no'];
    }
    
    public static function pay($result)
    {
        switch($result['type']) {
            case 'link':
                echo $result['data']['url'];
                //header('Location:'.$result['data']['url']);
                break;
        }
    }
}