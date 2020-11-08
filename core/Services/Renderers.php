<?php namespace Ignite\Services;

class Renderers {
    public static function Create($name, $dir) {
        $class = "\\Ignite\\Renderers\\" . ucfirst($name) . 'Renderer';
        return new $class($dir);
    }
}