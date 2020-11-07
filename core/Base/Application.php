<?php namespace Ignite\Base;

class Application {
    protected $request;
    protected $response;

    public function __construct($request, $response) {
        $this->config   = \Ignite\Config::GetAll();
        $this->request  = $request;
        $this->response = $response;

        $this->init();
    }

    protected function init() {}
    public function dispatch() {
        echo 'Base Application';
        exit;
    }
}