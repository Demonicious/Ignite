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

    '/test/{id}' => [
        'id' => 'Test',
        'handler' => function($options, $response) {
            $response->setStatus(200)
            ->json($options)
            ->send();
        }
    ]
];