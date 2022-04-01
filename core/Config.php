<?php 

namespace Core;

class Config {
    private static $config = [
        'version'             => '0.0.1',
        'default_controller'  => 'Blog',  // The default home controller
        'default_layout'      => 'default', // Default layout that is used
        'default_site_title'  => 'Freeskills', // Default Site title
    ];

    public static function get($key) {
        if(array_key_exists($key, $_ENV)) return $_ENV[$key];
        return array_key_exists($key, self::$config)? self::$config[$key] : NULL;
    }
}