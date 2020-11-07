<?php namespace Ignite\Frontend;

class Application extends \Ignite\Base\Application {
    private $theme;

    public function init() {
        $this->theme = \Ignite\Services\DataLoader::Theme();
    }

    public function dispatch() {
        
    }
}