<?php namespace Ignite;

class Config {
    static function All() {
        $map = [];

        $filenames = scandir(BASE_PATH . 'app/config');
        foreach($filenames as $filename) {
            if($filename != '.' && $filename != '..') {
                $filepath = configs_path($filename);
                if(file_exists($filepath))
                    $map[get_filename($filename)] = require_once($filepath);
            }
        }

        return $map;
    }

    static function Load($name) {
        if(is_array($name)) {
            $map = [];
            foreach($name as $filename) {
                $filename = get_filename($name);
                $path = configs_path($filename . '.php');
                $map[$filename] = file_exists($path)
                    ? require_once($path)
                    : null;
            }

            return $map;
        } else {
            $path = configs_path(get_filename($name) . '.php');

            return file_exists($path)
                ? require_once($path)
                : null;
        }
    }
}