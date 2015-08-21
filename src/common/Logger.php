<?php

/**
 * Created by IntelliJ IDEA.
 * User: Stefan
 * Date: 21.08.2015
 * Time: 09:21
 */
class Logger extends BaseObject
{
    public static function saveRequestLog($message, array $errors = null){
        $ipAddress = $_SERVER['REMOTE_ADDR'];
        $userAgent = $_SERVER['HTTP_USER_AGENT'];
        $requestUri = $_SERVER['REQUEST_URI'];

        if($errors != null)
            $message .= "\nErrors:\n" . serialize($errors);

        DataManager::performInsertion("INSERT INTO requestLogs (requestUri, ipAddress, userAgent, message, datetime) VALUES (?, ?, ?, ?, NOW());", array($requestUri, $ipAddress, $userAgent, $message));
    }
}