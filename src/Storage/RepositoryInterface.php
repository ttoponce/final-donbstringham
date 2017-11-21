<?php

namespace App\Storage;

interface RepositoryInterface {
    public function Add($item);
    public function Delete($ID);
    public function DeleteAll();
    public function Find($ID);
    public function FindAll();
    public function Update($ID, $item);
}
