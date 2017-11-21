<?php

namespace App\Storage;

interface AdapterInterface {
    public function Create($item);
    public function Remove($ID);
    public function RemoveAll();
    public function Get($ID);
    public function GetAll();
    public function Modify($ID, $item);
}
