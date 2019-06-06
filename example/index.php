<?php

use zjf\pay\Pay;

require __DIR__.'/../vendor/autoload.php';
require __DIR__.'/../src/Init.php';

if (php_sapi_name() !== 'cli') {
    Init::checkEnv();
}

class Index
{
    public function __construct()
    {
        $config = include __DIR__.'/config/config-local.php';
        Pay::init($config);
    }
    
    /**
     *
     * @param string $action create,query,lists
     * @param $data
     */
    public function charge($action, $data)
    {
        var_dump(\zjf\pay\apis\base\Charge::{$action}($data));
    }
    /**
     *
     * @param string $action create,query,lists
     * @param $data
     */
    public function refund($action, $data)
    {
        var_dump(\zjf\pay\apis\base\Refund::{$action}($data));
    }
}
$params = [];
$data = [];
if (php_sapi_name() === 'cli') {
    $params = getopt('m:a:p:');
    $data = empty($params['p']) ? [] : json_decode($params['p'], true, 512,JSON_BIGINT_AS_STRING);
} else {
    $params = $_GET;
    $data = isset($_POST['data']) ? $_POST['data'] : (isset($_GET['data']) ? $_GET['data'] : []);
    !is_array($data) && $data = json_decode($data, true, 512,JSON_BIGINT_AS_STRING);
}
$params = php_sapi_name() === 'cli' ? getopt('m:a:') : $_GET;

$method = empty($params['m']) ? '' : $params['m'];
$action = empty($params['a']) ? '' : $params['a'];

if (empty($method) || empty($action)) {
    exit('parameters error');
}
$index = new Index();
if (!method_exists($index, $method)) {
    exit("{$method} not found");
}
$index->{$method}($action, $data);