<?php

namespace App\Helpers;

if (! function_exists('env')) {
    function env($key, $default = null)
    {
        return Env::get($key, $default);
    }
}
