<?php

namespace App\Storage;

class MemSessionAdapter implements SessionAdapter {
    private $session = [];

    public function exists($var) {
        return isset($this->session[$var]);
    }

    public function get($var) {
        return isset($this->session[$var]) ? $this->session[$var] : null;
    }

    public function set($var, $value) {
        $this->session[$var] = $value;
    }
}

