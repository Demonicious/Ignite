<?php namespace Ignite\Frontend;

class Application extends \Ignite\Base\Application {
    private $theme;

    public function init() {
        $this->theme    = \Ignite\Services\DataLoader::Theme();
        $this->renderer = \Ignite\Services\Renderers::Create($this->theme['config']['renderer'], THEME_ROOT);

        print_r($this->renderer);
        exit;
    }

    public function dispatch() {
        $this->response->setStatus(200)->json($this->renderer)->send();
    }
}