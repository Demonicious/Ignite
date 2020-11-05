<?php namespace Ignite\CLI;

class Application {
    public $responder;

    public function __construct() {
        $this->responder = new Responder();
    }

    public function register_command($name, $callable) {
        $this->registry[$name] = $callable;
    }

    public function dispatch($argv) {
        $name = 'help';
        if(isset($argv[2])) {
            $name = $argv[2];
        }

        $command = isset($this->registry[$name]) ? $this->registry[$name] : null;
        if($command) {
            return $this->registry[$name]($this->responder, $argv);
        } else {
            $this->responder->echo('Invalid Command.');
        }
    }
}