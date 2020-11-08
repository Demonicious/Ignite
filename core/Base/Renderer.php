<?php namespace Ignite\Base;

class Renderer {
    protected $renderer;
    protected $config;
    protected $driver;

    public function __construct($src_dir) {
        $this->config = \Ignite\Config::Get('app')['renderers'][$this->renderer];
        
        $class = "\\Ignite\\Renderers\\Drivers\\".ucfirst($this->config['driver']);
        $this->driver = new $class();
    }

    public function render() {}
}