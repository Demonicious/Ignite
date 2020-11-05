<?php

return [
    // Meta Information
    'name'   => 'Default Theme',
    'domain' => 'demonicious_default',

    'author' => [
        'name'  => 'Demonicious',
        'email' => 'demoncious@gmail.com',
        'url'   => 'https://github.com/demonicious'
    ],

    'static_dir' => 'static',
    'preview' => [
        'thumbnail' => '',
        'full'      => ''
    ],

    'settings' => require_once('settings.php'),
    'routes'   => require_once('routes.php')
];