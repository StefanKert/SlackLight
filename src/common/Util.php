<?php

class Util extends BaseObject {
    public static function escape($string){
        return nl2br(htmlentities($string));
    }

    public static function action($action, $params = null){
        $page =  isset($_REQUEST['page']) ? $_REQUEST['page'] : $_SERVER['REQUEST_URI'];
        $res = 'index.php?action=' . rawurlencode($action) .  "&page=" .  rawurlencode($page);

        if(is_array($params)){
            foreach( $params as $name => $value){
                $res .= '&' . rawurlencode($name) . '=' . rawurlencode($value);
            }
        }
        return $res;
    }

    public static function redirect($page = null, $errors = null){
        if($page == null){
            $page = isset($_REQUEST['page']) ?
                $_REQUEST['page'] : $_SERVER['REQUEST_URI'];
        }
        if($errors != null) {
            $page .= '&errors=' . urlencode(serialize($errors));
        }
        header("Location: $page");
    }

    public static function redirectWithInterval($page = null, $seconds = 0){
        if($page == null){
            $page = isset($_REQUEST['page']) ?
                $_REQUEST['page'] : $_SERVER['REQUEST_URI'];
        }
        header( "refresh:$seconds;url=$page" );
    }
}