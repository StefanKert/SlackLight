<?php


class User extends Entity {
    private $userName;
    private $passwordHash;
    private $firstName;
    private $lastName;
    private $mail;

    public function __construct($id, $userName, $passwordHash, $firstName, $lastName, $mail) {
        parent::__construct($id);
        $this->userName = $userName;
        $this->passwordHash = $passwordHash;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->mail = $mail;
    }


    public function getUserName() {
        return $this->userName;
    }

    public function getPasswordHash() {
        return $this->passwordHash;
    }

    public function getFirstName() {
        return $this->firstName;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function getMail() {
        return $this->mail;
    }
}