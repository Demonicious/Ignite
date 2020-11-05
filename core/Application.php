<?php namespace Ignite;

class Application {
    protected $is_backend;
    protected $request;
    protected $response;
    
    public function __construct() {
        $this->config   = Config::All();
        $this->request  = new Http\Request();
        $this->response = new Http\Response();

        Database\Instance::Initialize(
            $this->config['database']
        );

        $this->is_backend = detect_backend_path(
            $this->request->getUri(),
            $this->config['cms']['backend_path']
        );

        print_r($this);
        exit;
    }

    public function run() {
        $this->response
        ->setStatus(200, 'OK')
        ->setBody('Hello!')
        ->send();
    }
}