<?php

if (!function_exists('mix_path')) {
    /**
     * Добавление части пути для каталога разработки
     *
     * @param  string  $path
     * @return string
     */
    function mix_path($path = "")
    {
        return env('APP_ENV') == "local" ? $path : "";
    }
}
