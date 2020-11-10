<?php namespace Ignite\Frontend;

class Application extends \Ignite\Base\Application {
    private $router;
    private $theme;

    public function init() {
        $this->theme    = \Ignite\Services\DataLoader::Theme();
        $this->renderer = \Ignite\Services\Renderers::Create($this->theme['config']['renderer'], THEME_ROOT);

        $this->create_routes();
    }

    private function recursive_route_mapper($router, $routes) {
        foreach($routes as $route => $options) {
            $resolver = [
                'id'         => null,
                'title'      => 'Page',
                'method'     => 'GET',
                'view'       => null,
                'layout'     => null,
                'dispatcher' => null,
                'data'       => [],
                'settings'   => [],
                'routes'     => [],
            ];

            foreach($options as $key => $value) {
                $resolver[$key] = $value;
            }

            if(!isset($options['id']))
                throw new \Exception('A Unique page ID must be supplied.');

            $router->addRoute($resolver['method'], route_name($route), $resolver);
            if(!empty($resolver['routes'])) {
                $router->addGroup(route_name($route), function($r) use($resolver) {
                    $this->recursive_route_mapper($r, $resolver['routes']);
                });
            }
        }
    }

    private function create_routes() {
        $this->router = new \Ignite\Router\Dispatcher($this->config['app']['base_url'], function($r) {
            $this->recursive_route_mapper($r, $this->theme['config']['routes']);
        });
    }

    public function dispatch() {
        $route = $this->router->dispatch($this->request->getUri(), $this->request->getMethod());

        if($route['code'] < 400) {
            $options = $route['route_info'];

            if($options['dispatcher']) {
                return $options['dispatcher'](
                    $this->response,
                    $this->request,
                    [
                        'config'   => $this->config,
                        'theme'    => $this->theme,
                        'settings' => \Ignite\Services\DataLoader::PageSettings($this->theme['config']['domain'], $options['id'], $options['settings']),
                        'params'   => $route['uri_params'],
                        'data'     => []
                    ]
                );
            }
        } else 
            $this->response->setStatus($route['code'], $route['msg'])->setBody($route['msg'])->send();
    }
}