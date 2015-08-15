<?php
/**
 * Created by PhpStorm.
 * User: p24506
 * Date: 13.06.2015
 * Time: 10:03
 */

class DataManager {


    private static $__connection;


    public static function getConnection() {
        if (!isset(self::$__connection)) {
            self::$__connection = new PDO('mysql:host=localhost;dbname=fh_2015_scm4_S1310307019;charset=utf8', 'fh_2015_scm4', 'fh_2015_scm4');
        }
        return self::$__connection;
    }


    public static function query ($connection, $query, $parameters = array()) {
        $statement = $connection->prepare($query);
        $i = 1;
        foreach ($parameters as $param) {
            if (is_int($param)) {
                $statement->bindValue($i, $param, PDO::PARAM_INT);
            }
            if (is_string($param)) {
                $statement->bindValue($i, $param, PDO::PARAM_STR);
            }
            $i++;
        }
        $statement->execute();
        return $statement;
    }


    public static function close($cursor) {
        $cursor->closeCursor();
    }

    public static function fetchObject($cursor) {
        return $cursor->fetchObject();
    }

    public static function lastInsertId($connection){
        $connection->lastInsertId();
    }
}
