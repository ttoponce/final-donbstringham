<?php

namespace App\Storage;

class UserRepository implements RepositoryInterface {

    /** @var  \App\Storage\AdapterInterface */
    protected $adapter;

    public function __construct(AdapterInterface $adapter) {
        $this->SetAdapter($adapter);
    }

    public function SetAdapter(AdapterInterface $adapter) {
        $this->adapter = $adapter;
        return $this;
    }

    public function Add($item) {
        $this->adapter->Create($item);
    }

    public function Delete($ID) {
        $this->adapter->Remove($ID);
    }

    public function DeleteAll() {}
    public function Find($ID) {}
    public function FindAll() {}
    public function Update($ID, $item) {}
}
