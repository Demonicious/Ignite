<?php namespace Ignite;

class Config {
    private static $store = [];

    static function GetAll() {
        return self::$store;
    }

    static function Get($name) {
        $config = null;
        
        if(is_array($name)) {
            foreach($name as $cfg) {
                if(array_key_exists($cfg, self::$store))
                    $config[$cfg] = self::$store[$cfg];
                else
                    $config[$cfg] = null;
            }
        } else
            if(array_key_exists($name, self::$store))
                $config = self::$store[$name];

        return $config;
    }

    static function LoadAll() {
        $map = [];

        $filenames = scandir(BASE_PATH . 'app/config');
        foreach($filenames as $filename) {
            if($filename != '.' && $filename != '..') {
                $filepath = configs_path($filename);
                if(file_exists($filepath))
                    $filename = get_filename($filename);
                    $map[$filename] = require_once($filepath);
                    self::$store[$filename] = $map[$filename];
            }
        }

        return $map;
    }

    static function Load($name) {
        if(is_array($name)) {
            $map = [];
            foreach($name as $filename) {
                $filename = get_filename($filename);
                $path = configs_path($filename . '.php');
                $map[$filename] = file_exists($path)
                    ? require_once($path)
                    : null;

                self::$store[$filename] = $map[$filename];
            }

            return $map;
        } else {
            $name = get_filename($name);
            $path = configs_path($name . '.php');

            $current = file_exists($path)
                ? require_once($path)
                : null;

            self::$store[$name] = $current;
            return $current;
        }
    }
}