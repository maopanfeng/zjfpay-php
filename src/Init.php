<?php

class Init
{
    protected static $namespaces = [];
    /**
     * @var string $minPhpVersion php最小版本
     */
    protected static $minPhpVersion = '5.6';
    /**
     * @var array $functions 需要的php 函数
     */
    protected static $functions = [
        'json_encode' => 'JSON extension not enabled. Please enable JSON extension or implement json_encode and json_decode method.',
        'mb_detect_encoding' => 'mb_string extension not enabled. Please enable mb_string extension or implement mb_detect_encoding method.',
    ];
    
    public static function register()
    {
        // 注册自动加载
        spl_autoload_register('Init::autoload', true, true);
    }
    
    /**
     * @param $class
     */
    public static function autoload($class)
    {
        if (isset(static::$namespaces[$class])) {
            $file = static::$namespaces[$class];
        } elseif (strpos($class, '\\') !== false) {
            if (substr($class, 0, 7) === 'zjf\\pay') {
                $file = str_replace('\\', DIRECTORY_SEPARATOR ,__DIR__.substr($class, 7).'.php');
                static::$namespaces[$class] = $file;
            }
        }
        if (!empty($file) && file_exists($file)) {
            include $file;
        }
    }
    
    /**
     * @throws \zjf\pay\exceptions\InitException
     */
    public static function checkEnv()
    {
        static::checkPhpVersion();
        static::checkFunctions();
    }
    
    /**
     * @throws \zjf\pay\exceptions\InitException
     */
    public static function checkPhpVersion()
    {
        $version = phpversion();
        if (version_compare($version, static::$minPhpVersion, '<')) {
            throw new \zjf\pay\exceptions\InitException(
                sprintf(
                    'PHP version is too low. Your server is running PHP version %1$s but the program needs at least %2$s version.',
                    $version,
                    static::$minPhpVersion
                ),
                [],
                \zjf\pay\libs\Err::CODE_ENV_ERROR
            );
        }
    }
    
    public static function checkFunctions()
    {
        foreach(static::$functions as $func => $message) {
            if (!function_exists($func)) {
                throw new \zjf\pay\exceptions\InitException(
                    $message,
                    [],
                    \zjf\pay\libs\Err::CODE_ENV_ERROR
                );
            }
        }
    }
}

// 环境检查
if (php_sapi_name() === 'cli') {
    try {
        autoload::checkEnv();
    } catch (\Exception $e) {
        exit($e->getMessage());
    }
}
