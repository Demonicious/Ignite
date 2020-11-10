<?php

return [
    'id' => 'api-v1',


    'routes' => [
        '/users' => [
            'id' => 'api-v1-users',
            'method' => 'POST',
            'handler' => function($options, $response, $request) {
                $data = $request->input->post('user_id');

                $response->setStatus(200, 'OK')->json($data)->send();
            }
        ]
    ]
];