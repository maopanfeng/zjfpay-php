<?php
require __DIR__.'/../deals/OrderDeal.php';

class OrderCtr
{
    protected $order;
    
    public function __construct()
    {
        $this->order = new \zjf\pay\apis\user\Order();
    }
    
    public function create($data = [])
    {
        $data = array_merge([
            'out_trade_no' => time(),
            'order_type' => 'charge',
            'device_info' => '123456',
            'subject' => '购买aaa商品',
            'member_id' => '9',
            'total_fee' => '100',
            'fee_type' => 'CNY',
            'body' => '购买aaa商品-找家纺',
            'detail' => '',
            'return_url' => 'http://localhost:8080/return.php',
            'client_ip' => '127.0.0.1',
            'time_expire' => strtotime('+10 min'),
            'discountable_amount' => 100,
            'promo_params' => json_encode([['name'=>'aaaa']], JSON_UNESCAPED_UNICODE),
            'attach' => json_encode(['name'=>'aaa'], JSON_UNESCAPED_UNICODE)
        ], $data);
        try {
            $result = $this->order->create($data);
            Log::info($data, $result);
            OrderDeal::create($result);
        } catch (\Exception $e) {
            Log::error($data, $e);
        }
    }
    
    public function query($data = [])
    {
        $data = array_merge([
            'trade_no' => '',
            'out_trade_no' => '123456',
        ], $data);
        try {
            $result = $this->order->query($data);
            Log::info($data, $result);
        } catch (\Exception $e) {
            Log::error($data, $e);
        }
    }
    
    public function cancel($data = [])
    {
        $data = array_merge([
            'member_id' => '',
            'out_trade_no' => '123456',
        ], $data);
        try {
            $result = $this->order->cancel($data);
            Log::info($data, $result);
        } catch (\Exception $e) {
            Log::error($data, $e);
        }
    }
    
    public function lists($data = [])
    {
        $data = array_merge([
            'page' => '1',
            'pagesize' => '2',
            'member_id' => '9',
            'refunded' => false,
            'canceled' => false,
            'paid' => false,
            'created' => ['st'=>'', 'et'=>''],
        ], $data);
        try {
            $result = $this->order->lists($data);
            Log::info($data, $result);
        } catch (\Exception $e) {
            Log::error($data, $e);
        }
    }
    
    public function pay($data = [])
    {
        $data = array_merge([
            'trade_no' => '',
            'channel' => 'ALIPAY',
            'trade_type' => 'WEB',
        ], $data);
        try {
            $result = $this->order->pay($data);
            Log::info($data, $result);
            OrderDeal::pay($result);
        } catch (\Exception $e) {
            Log::error($data, $e);
        }
    }
}