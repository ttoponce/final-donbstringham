<?php

namespace App\Storage;

class MemoryPlugin implements AdapterInterface {

    /** @var  array $array */
    protected $array;

    public function __construct()
    {
        $this->RemoveAll();
    }

    public function Create($item)
    {
        if (!is_object($item)) {
            throw new \UnexpectedValueException('$item is not an object');
        }

        if(!method_exists($item, 'getID')) {
            throw new \UnexpectedValueException('$item does not have a getID() method');
        }

        $this->array[] = $item;

        return $this;
    }

    public function Remove($ID)
    {
        $offset = $this->getOffset($ID);

        if($offset === -1) {
            return;
        }

        unset($this->array[$offset]);
    }

    public function RemoveAll()
    {
        $this->array = [];
    }

    public function Get($ID)
    {
        $offset = $this->getOffset($ID);

        if($offset === -1) {
            return null;
        }

        return $this->array[$offset];
    }

    public function GetAll()
    {
        return $this->array;
    }

    public function Modify($ID, $item)
    {
        if (!is_object($item)) {
            throw new \UnexpectedValueException('$item is not an object');
        }

        if(!method_exists($item, 'getID')) {
            throw new \UnexpectedValueException('$item does not have a getID() method');
        }

        $offset = $this->getOffset($ID);

        if($offset === -1) {
            return;
        }

        $this->array[$offset];
    }

    protected function getOffset($ID) {
        $len = count($this->array);

        for ($i=0; $i < $len; $i++) {
            if($this->array[$i]->GetID() === $ID) {
                return $i;
            }
        }

        return -1;

//        foreach ($this->array as &$item) {
//            if ($item->GetID() === $ID) {
//                return $item;
//            }
//        }
//
//        return null;
    }
}