<?php

namespace zjf\pay;

use mxhei\helpers\Collection;
use mxhei\helpers\Event;

class Pay
{
    /**
     * SDK版本
     */
    const VERSION = '1.0.03';
    /**
     * @var string $mchId 商户ID
     */
    protected static $mchId = '';
    /**
     * @var string $appId 应用APPID
     */
    protected static $appId = '';
    /**
     * @var string $appSecret 应用密钥
     */
    protected static $appSecret = '';
    /**
     * @var string $apiVersion 接口版本
     */
    protected static $apiVersion = 'v1';
    /**
     * @var string $baseUri 接口地址
     */
    protected static $baseUri = '';
    /**
     * @var bool $sandbox 是否是沙箱测试
     */
    protected static $sandbox = false;
    /**
     * @var array $apiUrls 接口地址
     */
    protected static $apiUrls = [
        'prod' => 'https://pay.zhaojiafang.com/api/', // 正式地址
        'dev' => 'https://test.pay.zhaojiafang.com/api/', // 测试地址，沙箱环境
    ];
    /**
     * @var Collection
     */
    public static $config;
    
    public static function init($config = [])
    {
        self::setConfig($config);
    }
    
    /**
     * @return string
     */
    public static function getMchId()
    {
        return self::$mchId;
    }
    
    /**
     * @param string $mchId
     */
    public static function setMchId($mchId)
    {
        self::$mchId = $mchId;
    }
    
    /**
     * @return string
     */
    public static function getAppId()
    {
        return self::$appId;
    }
    
    /**
     * @param string $appId
     */
    public static function setAppId($appId)
    {
        self::$appId = $appId;
    }
    
    /**
     * @return string
     */
    public static function getAppSecret()
    {
        return self::$appSecret;
    }
    
    /**
     * @param string $appSecret
     */
    public static function setAppSecret($appSecret)
    {
        self::$appSecret = $appSecret;
    }
    
    /**
     * @return string
     */
    public static function getApiVersion()
    {
        return self::$apiVersion;
    }
    
    /**
     * @param string $apiVersion
     */
    public static function setApiVersion($apiVersion)
    {
        self::$apiVersion = $apiVersion;
    }
    
    /**
     * @return string
     */
    public static function getBaseUri()
    {
        return self::$baseUri;
    }
    
    /**
     * @param string $baseUri
     */
    public static function setBaseUri($baseUri)
    {
        self::$baseUri = $baseUri;
    }
    
    /**
     * @return bool
     */
    public static function isSandbox()
    {
        return self::$sandbox;
    }
    
    /**
     * @param bool $sandbox
     */
    public static function setSandbox($sandbox)
    {
        self::$sandbox = $sandbox;
        self::setBaseUri($sandbox ? self::$apiUrls['dev'] : self::$apiUrls['prod']);
    }
    
    /**
     * @param array $config
     */
    public static function setConfig($config)
    {
        if (empty(self::$config)) {
            self::$config = new Collection(include __DIR__.'/config.php');
        }
        !empty($config) && self::$config->merge((array)$config);
        self::resolveConfig();
    }
    
    /**
     * @param $name
     * @param $default
     * @return Collection|mixed
     */
    public static function getConfig($name=null, $default = null)
    {
        if (is_null($name)) {
            return self::$config;
        } else {
            return self::$config->get($name, $default);
        }
    }
    
    public static function resolveConfig()
    {
        self::$apiUrls = self::$config->get('api_urls');
        self::setApiVersion(self::$config->get('api_version', 'v1'));
        self::setSandbox(self::$config->get('sandbox', false));
        self::setMchId(self::$config->get('mch_id', ''));
        self::setAppId(self::$config->get('app_id', ''));
        self::setAppSecret(self::$config->get('app_secret', ''));
        if (!empty($events = self::$config->get('events'))) {
            Event::import($events);
        }
        self::$config->set('signature.secret.value', self::getAppSecret());
    }
}