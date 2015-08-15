<?php

/**
 * Created by IntelliJ IDEA.
 * User: Stefan
 * Date: 15.08.2015
 * Time: 12:46
 */
class UserRepository
{
    private $users;

    public function __construct(){
        $users = array();
    }

    public function UserExists($username){
        return true;
    }
    public function GetUserWithUsernameAndPassword($username, $password){
        var_dump($username);
        var_dump($password);
        if($username === "Test" && $password === "test") {
            return new User($username, $password);
        }
        else {
            return null;
        }
    }

    public static function createUser($username, $passwordHash) {

        $con = DataManager::getConnection();
        DataManager::query($con, 'BEGIN;');

        DataManager::query($con, "INSERT INTO users (username, passwordHash) VALUES (?, ?);", array($username, $passwordHash));
        $userId = DataManager::lastInsertId($con);
        DataManager::query($con, 'COMMIT;');
        return $userId;
    }


    public static function getUserForId($userId) {
        $user = null;
        $con = DataManager::getConnection();
        $res = DataManager::query($con, "SELECT id, username, passwordHash FROM users WHERE id = ?;", array($userId));
        if ($u = DataManager::fetchObject($res)) {
            $user = new User($u->id, $u->userName, $u->passwordHash);
        }
        DataManager::close($res);
        return $user;
    }

    public static function getUserForUserName($userName) {
        $user = null;
        $con = DataManager::getConnection();
        $res = DataManager::query($con, "SELECT id, username, passwordHash FROM users WHERE username = ?;", array($userName));
        if ($u = DataManager::fetchObject($res)) {
            $user = new User($u->id, $u->username, $u->passwordHash);
        }
        DataManager::close($res);
        return $user;
    }
}