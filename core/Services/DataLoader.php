<?php namespace Ignite\Services;

class DataLoader {
    static $driver;

    public static function Init($driver = 'File') {        
        $class = "\\Ignite\\Drivers\\DataLoader\\" . ucwords($driver);
        self::$driver = new $class();
    }

    public static function Theme() {
        $current = \Ignite\Config::Get('cms')['default_theme'];

        $item = \Ignite\Database\Models\AppSetting::select('value')->where('setting', 'current_theme')->first();
        if($item)
            $current = $item->value;
        else {
            $item = new \Ignite\Database\Models\AppSetting();
            $item->setting = 'current_theme';
            $item->value   = $current;

            $item->save();
        }

        $meta_file = require_once(BASE_PATH . 'app/themes/' . $current . '/theme.php');

        if(!isset($meta_file['domain'])) {
            throw new \Exception('routes OR domain undefined in theme.php for: ' . $current);
        }

        $meta = [
            'name' => 'Base Theme',
            'assets' => 'assets/',
            'settings' => [],
            'routes' => [
                '/' => [
                    'dispatcher' => function($response) {
                        $response->setBody('Hello!')->send();
                    }
                ]
            ],
            'renderer' => 'main',
            'preview' => [
                'thumbnail' => '',
                'full'      => '',
            ],
            'author' => [
                'name' => 'Someone',
                'email' => 'someone@somewhere.com',
                'url' => 'http://somewhere.com'
            ]
        ];

        foreach($meta_file as $key => $value) {
            $meta[$key] = $value;
        }

        return [
            'name' => $current,
            'config' => $meta,
            'settings' => self::ThemeSettings($meta) 
        ];
    }

    public static function GetThemeDomain($name) {
        $path = BASE_PATH . 'app/themes/' . $name . '/theme.php';
        if(file_exists($path))
            return require_once($path)['domain'];
        else 
            throw new \Exception('Meta File "theme.php" Not found in: ' . $path);
    }

    public static function ThemeSettings($meta) {
        return self::$driver->ThemeSettings($meta);
    }

    public static function PageSettings($domain, $id, $schema) {
        return self::$driver->PageSettings($domain, $id, $schema);
    }

    public static function PageData($map) {

    }
}