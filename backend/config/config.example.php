<?php
class Config {
    public static function get_env($name, $default) {
        return isset($_ENV[$name]) ? $_ENV[$name] : $default;
    }
    public static function DB_HOST() { return self::get_env("DB_HOST", "127.0.0.1"); }
    public static function DB_NAME() { return self::get_env("DB_NAME", "sneakers"); }
    public static function DB_PORT() { return self::get_env("DB_PORT", "3306"); }
    public static function DB_USER() { return self::get_env("DB_USER", "root"); }
    public static function DB_PASSWORD() { return self::get_env("DB_PASSWORD", ""); }


public static function EXTERNAL_API_URL() {
        return Config::get_env("EXTERNAL_API_URL", "https://open.er-api.com/v6/latest");
    }

    public static function EXTERNAL_API_KEY() {
        return Config::get_env("EXTERNAL_API_KEY", "your_api_key_here");
    }

}