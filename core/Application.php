<?php namespace Ignite;

class Application {
    protected $is_backend;
    protected $request;
    protected $response;
    
    public function __construct() {
        $this->config   = Config::Load([ 'database', 'cms' ]);
        $this->request  = new Http\Request();
        $this->response = new Http\Response();

        Database\Instance::Initialize(
            $this->config['database']
        );

        $this->is_backend = detect_backend_path(
            $this->request->getUri(),
            $this->config['cms']['backend_path']
        );
    }

    public function run() {
        if($this->is_backend) {
            $instance = new Backend\Application(
                $this->request,
                $this->response
            );
            $instance->dispatch();
        } else {
            $instance = new Frontend\Application(
                $this->request,
                $this->response
            );
            $instance->dispatch();
        }
    }
}