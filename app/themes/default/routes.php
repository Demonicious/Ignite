<?php

return [
    '/' => [
        'id' => 'homepage',
        'handler' => function($options, $response) {
            $response->setStatus(200)
            ->json($options)
            ->send();
        }
    ],

    '/api/v1' => require_once(THEME_ROOT . 'src/api/routes.php')
];