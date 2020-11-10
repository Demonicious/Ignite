<?php

define('THEME_ROOT', __DIR__ . '/');

return [
    'name'   => 'Default Theme',
    'domain' => 'demonicious_default', // MUST BE UNIQUE FOR ALL THEMES.

    'author' => [
        'name'  => 'Demonicious',
        'email' => 'demoncious@gmail.com',
        'url'   => 'https://github.com/demonicious'
    ],

    'routes'   => require_once('routes.php'),
    'settings' => require_once('settings.php'),
];