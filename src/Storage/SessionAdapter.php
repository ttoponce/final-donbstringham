<?php

namespace App\Storage;

interface SessionAdapter {
    public function exists($var);
    public function get($var);
    public function set($var, $value);
}
