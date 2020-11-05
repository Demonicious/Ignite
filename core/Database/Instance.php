<?php namespace Ignite\Database;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

class Instance {
    static $capsule;

    static function Initialize($credentials = []) {
        self::$capsule = new Capsule();
        if(!empty($credentials))
            self::New($credentials);
        
        self::$capsule->setEventDispatcher(
            new Dispatcher(
                new Container()
            )
        );

        self::$capsule->setAsGlobal();
        self::$capsule->bootEloquent();
    }

    static function New($credentials = [], $name = 'default') {
        if(empty($credentials))
            $credentials = \Ignite\Config::Load('database');

        self::$capsule->addConnection($credentials, $name);
    }

    static function Schema() {
        return self::$capsule->schema();
    }

    static function QueryBuilder() {
        return self::$capsule;
    }
}