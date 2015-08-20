<?php
/**
 * Created by PhpStorm.
 * User: p24506
 * Date: 13.06.2015
 * Time: 10:03
 */

class DataManager extends BaseObject {


    private static $__connection;


    public static function getConnection() {
        if (!isset(self::$__connection)) {
            self::$__connection = new PDO('mysql:host=localhost;dbname=fh_2015_scm4_S1310307019;charset=utf8', 'fh_2015_scm4', 'fh_2015_scm4');
        }
        return self::$__connection;
    }


    public static function query ($connection, $query, $parameters = array()) {
        $statement = $connection->prepare($query);
        $statement->execute($parameters);
        return $statement;
    }



    public static function performInsertion($command, array $params){
        $con = self::getConnection();
        $con->beginTransaction();
        self::query($con, $command, $params);
        $id = $con->lastInsertId();
        $con->commit();
        return $id;
    }

    public static function performSelectWithFetch($command, array $params, $fetchMethod){
        $con = self::getConnection();
        $res = self::query($con, $command, $params);
        $result = $fetchMethod($res);
        self::close($res);
        return $result;
    }

    public static function performAction($command, array $params) {
        $con = DataManager::getConnection();
        $con->beginTransaction();
        DataManager::query($con, $command, $params);
        $con->commit();
        return null;
    }

    public static function close($cursor) {
        $cursor->closeCursor();
    }

    public static function fetchObject($cursor) {
        return $cursor->fetchObject();
    }

    public static function logAction($message) {
        $con = self::getConnection();
        $ipaddress = $_SERVER['REMOTE_ADDR'];
        $userAgent = $_SERVER['HTTP_USER_AGENT'];
        $requestUri = $_SERVER['REQUEST_URI'];
        self::query($con, "
                INSERT INTO action_log (
                  ip_address, user_agent, request_uri, message, datetime
                ) VALUES (
                  '" . $ipaddress . "',
                  '" . $userAgent . "',
                  '" . $requestUri . "',
                  '" . $message . "',
                  NOW());"
        );
        self::closeConnection($con);
    }
}
