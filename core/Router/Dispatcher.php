<?php namespace Ignite\Router;

class Dispatcher {
    private $base_url;
    private $route_dispatcher;
    private $current;

    public function __construct($base_url = 'http://localhost/', $routes) {
        $this->base_url = $base_url;
        $this->route_dispatcher = \FastRoute\simpleDispatcher($routes);
    }

    private function decode_uri($uri) {
        if(strlen($uri) > 1)
            $uri = route_name($uri);
        if(false != $pos = strpos($uri, '?'))
            $uri = substr($uri, 0, $pos);

        return rawurldecode($uri);
    }

    public function dispatch($uri, $method) {
        $uri = $this->decode_uri($uri);

        $route_info = $this->route_dispatcher->dispatch($method, $uri);
        switch($route_info[0]) {
            case \FastRoute\Dispatcher::NOT_FOUND:
                return [
                    'code' => '404',
                    'msg'  => 'Not Found.'
                ];
            break;
            case \FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
                return [
                    'code' => '405',
                    'msg'  => 'Method not allowed.'
                ];
            break;
            case \FastRoute\Dispatcher::FOUND:
                return [
                    'code' => '200',
                    'msg'  => 'Found.',
                    'route_info' => $route_info[1],
                    'uri_params' => $route_info[2]
                ];
            break;
            default:
                return [
                    'code' => '400',
                    'msg' => 'Bad Request.',
                ];
        }
    }
}