<?php
namespace KirbySync;
use c;

class settings {
    public static function __callStatic($name, $args) {
        $prefix = 'plugin.sync.';
        $name = strtolower(preg_replace('/([A-Z])/', '.$1', $name));

        $settings = kirby()->get('option', $prefix . 'settings');
        $settings_custom = kirby()->get('option', $prefix . 'settings.custom');

        if(isset($settings_custom)) {
            $settings = array_merge($settings, $settings_custom);
        }

        if(isset($settings) && array_key_exists($name, $settings)) {   
            return c::get($prefix . $name, $settings[$name]);
        }
    }
}