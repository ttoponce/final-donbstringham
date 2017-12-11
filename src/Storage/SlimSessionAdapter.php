<?php

namespace App\Storage;

class SlimSessionAdapter implements SessionAdapter {
    public function exists($var) {
        return isset($_SESSION[$var]);
    }

    public function get($var) {
        return isset($_SESSION[$var]) ? $_SESSION[$var] : null;
    }

    public function set($var, $value) {
        $_SESSION[$var] = $value;
    }
}
