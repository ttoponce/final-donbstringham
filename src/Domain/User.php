<?php
/**
 * 20171011User class
 */

namespace App\Domain;

class User
{
    protected $email;
    protected $fullName;
    protected $ID;

    public function __construct($email, $name)
    {
        if (empty($email) || empty($name)) {
            throw new \InvalidArgumentException('empty arguments');
        }

        if (!is_string($email) || !is_string($name)) {
            throw new \InvalidArgumentException('arguments are not strings');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException('email is not valid');
        }

        $this->email = $email;
        $this->fullName = $name;
        $this->ID = uniqid('USR_', true);
    }

    public function getEmail() {
        return $this->email;
    }

    public function getID() {
        return $this->ID;
    }

    public function getUsername() {
        return $this->getEmail();
    }
}
