<?php

define('THEME_BASE', __DIR__ . '/');

return [
    // Meta Information
    'name'   => 'Default Theme',
    'domain' => 'demonicious_default',

    'author' => [
        'name'  => 'Demonicious',
        'email' => 'demoncious@gmail.com',
        'url'   => 'https://github.com/demonicious'
    ],

    'preview' => [
        'thumbnail' => '',
        'full'      => ''
    ],

    'content' => 'content/',
    'pages'    => "pages/",

    'settings_form' => require_once('settings.php'),
];