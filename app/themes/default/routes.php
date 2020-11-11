<?php

return [
    '/' => [
        'id' => 'homepage',
        'handler' => function($options, $response) {
            $response->setStatus(200)
            ->json($options)
            ->send();
        },
    ],
];