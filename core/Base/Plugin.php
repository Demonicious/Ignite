<?php namespace Ignite\Base;

class Plugin {
    protected $request;
    protected $response;

    static $name   = 'base-plugin-module';
    static $domain = 'demonicious_base_plugin_module';
    static $author = [
        'name'  => 'Mudassar Islam',
        'email' => 'demoncious@gmail.com',
        'url'   => 'https://github.com/demonicious'
    ];

    public function __construct() {
        $this->request  = new \Ignite\Http\Request();
        $this->response = new \Ignite\Http\Response();
    }
}