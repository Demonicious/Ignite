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
        if(isset($argv[1])) {
            $name = $argv[1];
        }

        $command = isset($this->registry[$name]) ? $this->registry[$name] : null;
        if($command) {
            $args = array_splice($argv, 2);
            return $this->registry[$name]($this->responder, $args);
        } else {
            $this->responder->echo('Invalid Command.');
        }
    }
}