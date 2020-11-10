<?php

return [
    '/' => [
        'id' => 'homepage',
        'dispatcher' => function($response) {
            $response->setStatus(200)
            ->json([ 'hi' => 'fellow' ])
            ->send();
        }
    ],
];