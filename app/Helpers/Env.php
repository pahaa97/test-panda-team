<?php

namespace App\Helpers;

class Env
{
    public static function get($key, $default = null)
    {
        return static::getKey($key,$default);
    }

    private static function getKey($key,$default) {
        $patch = static::getPatch();
        return $patch[strtolower($key)] ?? $patch[strtolower($default)] ?? null;
    }

    private static function getPatch()
    {
        $env = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/.env');
        return array_change_key_case(parse_ini_string($env),CASE_LOWER);
    }
}
