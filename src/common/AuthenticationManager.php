<?php
SessionContext::create();

class AuthenticationManager extends BaseObject {

    public static function Authenticate($userName, $password){
        /*$user = DataManager::getUserForUserName($userName);
        if($user != null && $user->getPasswordHash() == hash('sha1', "$userName|$password")){
            $_SESSION['user'] = $user->getId();
            return true;
        }
        else{
            self::signOut();
            return false;
        }*/
    }

    public static function getAuthenticatedUser(){
       // return self::isAuthenticated() ? DataManager::getUserForId($_SESSION['user']) : null;
    }

    public static function saveLoggedInUser($user){
        $_SESSION['user'] = $user;
    }

    public static function isAuthenticated(){
        return isset($_SESSION['user']);
    }

    public static function signOut(){
        unset($_SESSION['user']);
    }

}
?>