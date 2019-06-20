<?php

class RefundCtr
{
    protected $order;
    
    public function __construct()
    {
        $this->order = new \zjf\pay\apis\user\Refund();
    }
    
    public function create($data = [])
    {
        $data = array_merge([
            'trade_no' => '',
            'subject' => '购买aaa商品退款',
            'refund_fee' => '10',
            'refund_mode' => 'to_source',
            'detail' => '',
            'client_info' => '127.0.0.1',
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
    
    public function lists($data = [])
    {
        $data = array_merge([
            'page' => '1',
            'pagesize' => '2',
            'refunded' => false,
            'created' => ['st'=>'', 'et'=>''],
        ], $data);
        try {
            $result = $this->order->lists($data);
            Log::info($data, $result);
        } catch (\Exception $e) {
            Log::error($data, $e);
        }
    }
}