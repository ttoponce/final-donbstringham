<?php

namespace App\Storage;

class Session {
    private static $adapter;

    public static function init(SessionAdapter $adapter) {
        self::$adapter = $adapter;
    }

    public static function exists($var) {
        return self::$adapter->exists($var);
    }

    public static function get($var) {
        return self::$adapter->get($var);
    }

    public static function set($var, $value) {
        return self::$adapter->set($var, $value);
    }
}
