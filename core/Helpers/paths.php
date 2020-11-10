<?php

if(!function_exists('get_filename')) {
    function get_filename($name) {
        return explode('.php', $name)[0];
    }
}

if(!function_exists('configs_path')) {
    function configs_path($file) {
        return BASE_PATH . 'app/config/' . $file;
    }
}

if(!function_exists('detect_backend_path')) {
    function detect_backend_path($uri, $backend_path) {
        return substr(
            trim($uri, '\t\n\r\0\x0B/'),
            0,
            strlen($backend_path)
        ) == $backend_path;
    }
}

if(!function_exists('route_name')) {
    function route_name($name) {
        return '/' . trim($name, '/');
    }
}