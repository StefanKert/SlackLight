<?php


class SessionContext extends BaseObject {
    private static $exists = false;

    public static function create(){
        if(!self::$exists){
            self::$exists = session_start();
        }
        return self::$exists;
    }
}

?>