<?php

return [
    'mch_id' => '', // 商户号
    'app_id' => '', // 应用ID
    'app_secret' => '', // 应用密钥
    'sandbox' => false, // 沙箱环境
    'api_urls' => [
        'prod' => 'https://pay.zhaojiafang.com/api/',
        'dev'  => 'https://test.pay.zhaojiafang.com/api/',
    ],
    'api_version' => 'v1', // 接口版本
    'events' => [
    ],
    'signature' => [
        'sign_type' => 'md5',
    ]
];