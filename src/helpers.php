<?php

if (!function_exists('dd')) {
    function dd(...$args): void
    {
        echo '<pre>';
        foreach ($args as $var) {
            var_dump($var);
        }
        echo '</pre>';
        die;
    }
}