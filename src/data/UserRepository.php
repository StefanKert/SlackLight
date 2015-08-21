<?php

class UserRepository extends BaseObject
{
    public function __construct(){}

    public function createUser($username, $passwordHash, $firstName, $lastName, $mail) {
        return DataManager::performInsertion("INSERT INTO users (username, passwordHash, firstName, lastName, mail) VALUES (?, ?, ?, ? ,?);", array($username, $passwordHash, $firstName, $lastName, $mail));
    }

    public function getUserForId($userId) {
        return DataManager::performSelectWithFetch("SELECT id, username, passwordHash, firstName, lastName, mail FROM users WHERE id = ?;", array($userId), function($res){
            return $this->fetchUserObject($res);
        });
    }

    public function getUserForUserName($userName) {
        $result = DataManager::performSelectWithFetch("SELECT id, username, passwordHash, firstName, lastName, mail FROM users WHERE username = ?;", array($userName), function($res){
            return $this->fetchUserObject($res);
        });
        return $result;
    }

    public function getUserForMail($mail) {
        $result = DataManager::performSelectWithFetch("SELECT id, username, passwordHash, firstName, lastName, mail FROM users WHERE mail = ?;", array($mail), function($res){
            return $this->fetchUserObject($res);
        });
        return $result;
    }

    private function fetchUserObject($res){
        if ($u = DataManager::fetchObject($res)) {
            return new User($u->id, $u->username, $u->passwordHash, $u->firstName, $u->lastName, $u->mail);
        }
        else{
            return null;
        }
    }
}