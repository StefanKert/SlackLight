<?php
SessionContext::create();

class AuthenticationManager extends BaseObject
{

    public static function Authenticate($userName, $password)
    {
        $repository = new UserRepository();
        $user = $repository->getUserForUserName($userName);
        /*       if($user != null && $user->getPasswordHash() == hash('sha1', "$userName|$password")){
                   $_SESSION['user'] = $user->getId();
                   return true;
               }
               else{
                   self::signOut();
                   return false;
               }*/
        if ($user != null && $user->getPasswordHash() == $password) {
            $_SESSION['user'] = $user->getId();
            return true;
        } else {
            self::signOut();
            return false;
        }
    }

    public static function getAuthenticatedUser()
    {
        $repository = new UserRepository();
        return self::isAuthenticated() ? $repository->getUserForId($_SESSION['user']) : null;
    }

    public static function saveLoggedInUser($user)
    {
        $_SESSION['user'] = $user;
    }

    public static function isAuthenticated()
    {
        return isset($_SESSION['user']);
    }

    public static function signOut()
    {
        unset($_SESSION['user']);
    }
}
?>