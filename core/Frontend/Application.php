<?php namespace Ignite\Frontend;

class Application extends \Ignite\Base\Application {
    private $router;
    private $theme;

    public function init() {
        $this->theme    = \Ignite\Services\DataLoader::Theme();
        $this->renderer = \Ignite\Services\Renderers::Create($this->theme['config']['renderer'], THEME_ROOT);

        if(\Ignite\Services\DataLoader::AppSettings('maintenance_mode')) {
            $this->maintenance_page();
        }

        $this->create_routes();
    }

    private function recursive_route_mapper($router, $routes) {
        foreach($routes as $route => $options) {
            $resolver = [
                'id'          => null,
                'title'       => 'Page',
                'description' => '',
                'keywords'    => '',
                'method'      => 'GET',
                'view'        => null,
                'layout'      => null,
                'handler'     => null,
                'data'        => [],
                'settings'    => [],
                'routes'      => [],
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

    public function send_error($code = 404, $message = 'Resource Not Found!') {
        if(isset($this->theme['config']['error_page'])) {

        } else $this->response->setStatus($code, $message)->setBody($message)->send();
    }

    public function maintenance_page() {
        if(isset($this->theme['config']['maintenance_page'])) {

        } else $this->response->setStatus(503, 'Maintenance')->setBody('This website is currently down for maintenance purposes.')->send();
    }

    public function dispatch() {
        $route = $this->router->dispatch($this->request->getUri(), $this->request->getMethod());

        if($route['code'] < 400) {
            $options = $route['route_info'];

            $settings = \Ignite\Services\DataLoader::PageSettings($this->theme['config']['domain'], $options['id'], $options['settings']);
            $data     = \Ignite\Services\DataLoader::PageData($route['route_info']['data']);

            if($options['handler']) {
                return $options['handler'](
                    [
                        'config' => $this->config,
                        'page' => [
                            'title'       => $settings['title'],
                            'description' => $settings['description'],
                            'keywords'    => $settings['keywords'],
                            'settings'    => $settings,
                            'params'      => $route['uri_params'],
                            'data'        => $data,
                        ],
                        'theme' => [
                            'name'     => $this->theme['config']['name'],
                            'domain'   => $this->theme['config']['domain'],
                            'preview'  => $this->theme['config']['preview'],
                            'author'   => $this->theme['config']['author'],
                            'assets'   => $this->config['app']['base_url'] . 'app/themes/' . $this->theme['name'] . '/' . $this->theme['config']['assets'],
                            'settings' => $this->theme['settings']
                        ],
                    ],
                    $this->response,
                    $this->request
                );
            } else if($options['view']) {

            } $this->send_error(404, 'No handler specified for this route.');
        } else 
            $this->send_error($route['code'], $route['msg']);
    }
}