<?php

namespace zjf\pay\apis;

class Endpoint
{
    /**
     * 获取支付渠道
     */
    const CHANNELS = 'pay/channels';
    // 创建
    const CHARGE_CREATE = 'pay/charge';
    // 关闭订单
    const CHARGE_CLOSE = 'pay/charge/close';
    // 查询订单
    const CHARGE_QUERY = 'pay/charge/query';
    // 订单列表
    const CHARGE_LISTS = 'pay/charge/lists';
    
    const USER_ORDER_CHARGE = 'pay/user/charge';
    const USER_ORDER_QUERY = 'pay/user/charge/query';
    const USER_ORDER_LISTS = 'pay/user/charge/lists';
    const USER_ORDER_UPDATE = 'pay/user/charge/update';
    const USER_ORDER_PAY = 'pay/user/charge/pay';
    const USER_ORDER_CANCEL = 'pay/user/charge/cancel';
    
    const USER_USER_CREATE = 'pay/user/create';
    const USER_USER_QUERY = 'pay/user/query';
    const USER_USER_LISTS = 'pay/user/lists';
    const USER_USER_UPDATE = 'pay/user/update';
    
    const USER_REFUND_CREATE = 'pay/user/refund/create';
    const USER_REFUND_QUERY = 'pay/user/refund/query';
    const USER_REFUND_LISTS = 'pay/user/refund/lists';
}