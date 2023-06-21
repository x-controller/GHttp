<?php
/**
 * Created by PhpStorm.
 * User: Jaeger <JaegerCode@gmail.com>
 * Date: 18/12/11
 * Time: 下午6:39
 */

namespace Jaeger;

class Cache extends GHttp
{
    private static $cache_data = [];

    public static function remember($name, $arguments)
    {
        $k = static::getCacheKey($name, $arguments);
        $data = static::$cache_data[$k] ?? false;
        if (!$data) {
            $data = self::$name(...$arguments);
            static::$cache_data[$k] = $data;
        }
        return $data;
    }

    protected static function getCacheKey($name, $arguments)
    {
        return md5($name . '_' . json_encode($arguments));
    }
}
