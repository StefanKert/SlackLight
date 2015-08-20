<?php


class SessionContext extends BaseObject {
    private static $exists = false;

    const USER_ID = 'user';

    public static function create(){
        if(!self::$exists){
            self::$exists = session_start();
        }
        return self::$exists;
    }


    public static function getCurrentUser(){
        return $_SESSION[self::USER_ID];
    }

}

?>