<?php namespace Ignite\Drivers\DataLoader;

class File extends \Ignite\Base\DataLoaderDriver {
    protected $name = 'file';
    protected $path = BASE_PATH . 'store/dataloader/';

    public function ThemeSettings($meta) {
        $domain   = $meta['domain'];
        $settings = $meta['settings'];

        if(!empty($settings)) {
            $data = [];

            $settings_path = $this->path . 'themes/' . $domain . '.json';
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