<?php namespace Ignite\Services;

class DataLoader {
    public static function Theme() {
        $current = \Ignite\Config::Get('cms')['default_theme'];
        $meta    = require_once(BASE_PATH . 'app/themes/' . $current . '/theme.php');

        return [
            'name' => $current,
            'meta' => $meta,
            'settings' => self::ThemeSettings($current, $meta) 
        ];
    }

    public static function GetThemeDomain($name) {
        $path = BASE_PATH . 'app/themes/' . $name . '/theme.php';
        if(file_exists($path))
            return require_once($path)['domain'];
        else 
            throw new \Exception('Meta File "theme.php" Not found in: ' . $path);
    }

    public static function ThemeSettings($name, $meta) {
        $domain   = $meta['domain'];
        $settings = $meta['settings'];

        if(!empty($settings)) {
            $data = [];

            $settings_path = BASE_PATH . 'store/themes-data/' . $domain . '.json';
            if(file_exists($settings_path)) {
                $rewrite = false;
                $data    = json_decode(file_get_contents($settings_path), true);
                foreach($settings as $setting => $values) {
                    if(!array_key_exists($setting, $data)) {
                        $rewrite = true;
                        $data[$setting] = is_array($values) ? $values['default'] : null; 
                    }
                }

                if($rewrite) {
                    \file_put_contents($settings_path, json_encode($data));
                }
            } else {
                foreach($settings as $setting => $values) {
                    $data[$setting] = is_array($values) ? $values['default'] : null; 
                }
                
                \file_put_contents($settings_path, json_encode($data));
            }

            return $data;
        }

        return $settings;
    }
}