<?php namespace Ignite\Drivers\DataLoader;

class Database extends \Ignite\Base\DataLoaderDriver {
    protected $name = 'database';

    public function ThemeSettings($meta) {
        $domain   = $meta['domain'];
        $settings = $meta['settings'];

        if(!empty($settings)) {
            $data = [];

            $row = \Ignite\Database\Models\ThemeSetting::where('domain', $domain)->first();
            if($row) {
                $update = false;
                $data   = json_decode($row->settings, true);

                foreach($settings as $setting => $values) {
                    if(!array_key_exists($setting, $data)) {
                        $update = true;
                        $data[$setting] = is_array($values) ? $values['default'] : null; 
                    }
                }

                if($update) {
                    $row->settings = json_encode($data);
                    $row->save();
                }
            } else {
                foreach($settings as $setting => $values) {
                    $data[$setting] = is_array($values) ? $values['default'] : null; 
                }
                
                $entry = new \Ignite\Database\Models\ThemeSetting();
                $entry->domain   = $domain;
                $entry->settings = json_encode($data);
                $entry->save();
            }

            return $data;
        }

        return $settings;
    }

    public function PageSettings($domain, $id, $settings) {
        return [
            'title' => '',
            'description' => '',
            'keywords' => ''
        ];
    }

    public function AppSettings() {
        $items = \Ignite\Database\Models\AppSetting::all();
        $records = [];
        foreach($items as $item) {
            $records[$item->setting] = $item->value;
        }

        return $records;
    }
}