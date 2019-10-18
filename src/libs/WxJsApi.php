<?php

namespace zjf\pay\libs;

use mxhei\helpers\Str;
use zjf\pay\exceptions\Exception as PayException;

class WxJsApi
{
    const OAUTH_URL = 'https://open.weixin.qq.com/connect/oauth2/authorize';
    const ACCESS_TOKEN_URL = 'https://api.weixin.qq.com/sns/oauth2/access_token';
    
    protected $app_id = '';
    protected $mch_id = '';
    protected $secret = '';
    protected $key = '';
    protected $config = [];
    
    public function __construct($config = [])
    {
        $this->setConfig($config);
    }
    
    /**
     * @param array $config
     */
    public function setConfig($config)
    {
        $this->config = array_merge($this->config, $config);
        if (!empty($config['app_id'])) {
            $this->setAppId($config['app_id']);
        }
        if (!empty($config['mch_id'])) {
            $this->setMchId($config['mch_id']);
        }
        if (!empty($config['secret'])) {
            $this->setSecret($config['secret']);
        }
        if (!empty($config['key'])) {
            $this->setKey($config['key']);
        }
    }
    
    /**
     * @param string $app_id
     */
    public function setAppId($app_id)
    {
        $this->app_id = $app_id;
    }
    
    /**
     * @param string $mch_id
     */
    public function setMchId($mch_id)
    {
        $this->mch_id = $mch_id;
    }
    
    /**
     * @param string $secret
     */
    public function setSecret($secret)
    {
        $this->secret = $secret;
    }
    
    /**
     * @param string $key
     */
    public function setKey($key)
    {
        $this->key = $key;
    }
    
    public function redirectOauth($data = [], $callback = null)
    {
        if (isset($data['code']) && $data['code']) {
            $this->getOpenId($data);
        }
        /*$data += [
            'appid' => $this->app_id,
            'response_type' => 'code',
            'scope' => 'snsapi_base',
            'state' => Str::random(8),
        ];*/
        $params = [
            'appid' => $this->app_id,
            'redirect_uri' => $data['redirect_uri'],
            'response_type' => 'code',
            'scope' => 'snsapi_base',
            'state' => !empty($data['state']) ? $data['state'] : Str::random(8),
        ];
        $url = self::OAUTH_URL.'?'.http_build_query($params).'#wechat_redirect';
        if ($callback && is_callable($callback)) {
            return call_user_func_array($callback, ['url' => $url, 'data' => $data]);
        }
        
        return $this->buildOauthLocationForm($url, $data);
    }
    
    public function getOpenId($data = [])
    {
        $code = isset($data['code']) ? $data['code'] : '';//获取code
        if (!$code) {
            throw new PayException('获取授权失败', $data);
        }
        $param = ['appid' => $this->app_id, 'secret' => $this->secret, 'code' => $code, 'grant_type' => 'authorization_code'];
        
        $url = self::ACCESS_TOKEN_URL.'?'.http_build_query($param);
        $result = file_get_contents($url);//通过code换取网页授权access_token
        
        $result = json_decode($result, 1); //对JSON格式的字符串进行编码
        
        $openid = isset($result['openid']) ? $result['openid'] : 0;//输出openid
        $state = isset($data['state']) ? trim($data['state']) : '';
        if (!$openid || !$state) {
            throw new PayException('获取授权失败'.json_encode($result), ['data' => $data, 'result' => $result]);
        }
        
        return [
            'openid' => $openid,
            'state' => $state,
            'result' => $result,
            'data' => $data,
        ];
    }
    
    protected function buildOauthLocationForm($url, $data)
    {
        $encodeType = isset($data['encoding']) ? $data['encoding'] : 'UTF-8';
        $html = <<<EOF
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset={$encodeType}" />
</head>
<body onload="window.location.href='{$url}';" >

</body>
</html>
EOF;
        
        return $html;
    }
    
    public function createJsApiHtml($jsApiParameters, $callback = '')
    {
        $jsApiParameters = is_array($jsApiParameters) ? json_encode($jsApiParameters['data'], JSON_UNESCAPED_UNICODE) : $jsApiParameters;
        $html = <<<EOF
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <title>微信安全支付</title>

    <script type="text/javascript">

        //调用微信JS api 支付
        function jsApiCall()
        {
            WeixinJSBridge.invoke(
                'getBrandWCPayRequest',
                {$jsApiParameters},
                function(res){
                    //WeixinJSBridge.log(res.err_msg);
                    //alert(res.err_code+res.err_desc+res.err_msg);
                    {$callback}
                }
            )
        }

        function callpay()
        {
            if (typeof WeixinJSBridge == "undefined"){
                if( document.addEventListener ){
                    document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
                }else if (document.attachEvent){
                    document.attachEvent('WeixinJSBridgeReady', jsApiCall);
                    document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
                }
            }else{
                jsApiCall();
            }
        }
    </script>
</head>
<body onload='callpay();'>
    </br></br></br></br>
    <div align="center">
        <button style="width:210px; height:30px; background-color:#FE6714; border:0px #FE6714 solid; cursor: pointer;  color:white;  font-size:16px;" type="button" onclick="callpay()" >立即支付</button>
    </div>
</body>
</html>
EOF;
        
        return $html;
    }
}