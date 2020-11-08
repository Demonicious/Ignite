<?php

define('THEME_ROOT', __DIR__ . '/');

return [
    // Meta Information
    'name'   => 'Default Theme',
    'domain' => 'demonicious_default',

    'author' => [
        'name'  => 'Demonicious',
        'email' => 'demoncious@gmail.com',
        'url'   => 'https://github.com/demonicious'
    ],

    'renderer' => 'default', // Alternatives: vue,react,svelte

    'assets'  => 'assets/',
    'preview' => [
        'thumbnail' => '',
        'full'      => ''
    ],

    'routes'   => require_once('routes.php'),
    'settings' => require_once('settings.php'),
];