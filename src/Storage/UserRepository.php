<?php

namespace App\Storage;

class UserRepository implements RepositoryInterface {

    /** @var  \App\Storage\AdapterInterface */
    protected $adapter;

    public function __construct($adapter)
    {
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
    public function FindByUsername($username) {
        if ($this->adapter->Type() === \App\Storage\EloquentPlugin::class) {
            $this->adapter->SetGetByStringColumn('email');
        }
        $user = $this->adapter->GetByString($username);
    }
    public function FindAll() {}
    public function Update($ID, $item) {}
}
