<?php namespace Ignite\Base;

class DataLoaderDriver {
    protected $name = 'data-loader-driver';

    public function ThemeSettings($meta) {}
    public function PluginSettings($meta) {}
    public function PageSettings($theme_domain, $id, $settings) {}
}