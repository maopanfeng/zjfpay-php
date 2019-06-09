<?php

namespace zjf\pay\apis\base;

use zjf\pay\apis\ApiAbstract;
use zjf\pay\apis\Endpoint;
use zjf\pay\exceptions\ParamsException;

class Charge extends ApiAbstract
{
    /**
     * @param       $data
     * out_order_no: 商户订单号,必须在商户的系统内唯一
     * channel: 支付使用的第三方支付渠道
     * total_fee: 订单总金额（必须大于 0), 单位元， 0.01 - 100000000
     * fee_type: 货币类型：默认 CNY:人民币 。 3 位 ISO 货币代码
     * client_ip: 客户端IP， 支持ipv4 ipv6
     * subject： 商品标题
     * body:    商品描述信息，该参数最长为 128 个 Unicode 字符
     * extra:   特定渠道发起交易时需要的额外参数，以及部分渠道支付成功返回的额外参数
     * attach: 附加数据，不做处理，原样返回， json
     * time_expire： 订单失效时间的 Unix 时间戳。时间范围在订单创建后的 1 分钟到 15 天，默认为 1 天
     * detail： 订单详情，json格式
     * @param array $options
     *
     * @throws ParamsException
     */
    public function create($data, $options = [])
    {
        // 检查参数
        $rules = [
            ['out_order_no,channel,total_fee,client_ip,subject', 'required'],
            ['out_order_no', 'length', 'min'=>0, 'max'=>64],
            ['total_fee', 'size', 'min'=>0.01, 'max'=>100000000],
            ['client_ip', 'ip'],
            ['subject', 'length', 'min'=>0, 'max'=>255]
        ];
        $message = [
            'out_order_no.required' => '订单号不能为空',
            'out_order_no.length' => '订单号长度超过限制',
            'channel.required' => '支付渠道不能为空',
            'total_fee.required' => '订单金额不能为空',
            'total_fee.min' => '订单金额最小为0.01',
            'total_fee.max' => '订单金额最大为100000000',
            'client_ip.required' => 'IP不能为空',
            'client_ip.ip' => 'IP地址错误',
            'subject.required' => '订单标题不能为空',
            'subject.length' => '订单标题长度超过限制',
        ];
        $this->validate($data,$rules, $message);
        // 处理数据
        return $this->sendRequest(Endpoint::CHARGE_CREATE, $data, 'POST', $options);
    }
    
    /**
     * 接口支持对于未成功付款的订单进行撤销，则关闭交易。调用此接口后用户后期不能支付成功。
     * 对于成功付款的订单请使用 退款 接口进行退款处理
     *
     * @param       $data
     * out_trade_no: 外部订单号
     * @param array $options
     *
     * @throws ParamsException
     */
    public function close($data, $options = [])
    {
        // 检查参数
        $rules = [
            ['out_order_no', 'required|length:1,64'],
        ];
        $message = [
            'out_order_no.required' => '订单号不能为空',
            'out_order_no.length' => '订单号长度超过限制',
        ];
        $this->validate($data,$rules, $message);

        return $this->sendRequest(Endpoint::CHARGE_CLOSE, $data, 'POST', $options);
    }
    
    /**
     * @param       $data
     * trade_no: 交易订单号, 二选一，优先
     * out_trade_no： 商户订单号，二选一
     * @param array $options
     *
     * @throws ParamsException
     */
    public function query($data, $options = [])
    {
        // 检查参数
        if (empty($data['trade_no']) && empty($data['out_trade_no'])) {
            throw new ParamsException('参数错误', []);
        }
        // 检查参数
        $rules = [
            ['trade_no', 'requiredWithout:out_trade_no'],
            ['out_trade_no', 'requiredWithout:trade_no'],
        ];
        $message = [
            'trade_no.requiredWithout' => '支付订单号和订单号不能同时为空',
            'out_trade_no.requiredWithout' => '支付订单号和订单号不能同时为空',
        ];
        $this->validate($data,$rules, $message);
        // 处理数据
        return self::sendRequest(Endpoint::CHARGE_QUERY, $data, 'POST', $options);
    }
    
    /**
     * @param       $data
     * page: 页码
     * pagesize: 每页条数，默认 12
     * channel：支付渠道: 筛选条件
     * is_pay: 是否已付款：0,1
     * is_refund: 是否存在退款记录，不管有没有退款成功
     * is_close: 是否已关闭
     * created: json, 创建时间 ['op'=>'lt', 'st'=>'', 'et'=>'']
     * @param array $options
     */
    public function lists($data, $options = [])
    {
        // 处理数据
        return $this->sendRequest(Endpoint::CHARGE_LISTS, $data, 'POST', $options);
    }
}