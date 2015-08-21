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

    public static function generateUrl($file, $view = null, $controller = null, $action = null, array $params = null){
        $url = $file;
        if(!StringUtils::endsWith($file, '.php')) {
            $url .= '.php';
        }
        $url .= '?';
        if($view != null){
            $url .= 'view=' . $view . '&';
        }
        if($controller != null){
            $url .= 'controller=' . $controller . '&';
        }
        if($action != null){
            $url .= 'action=' . $action . '&';
        }
        if($params != null) {
            if(StringUtils::endsWith($url, '&'))
                $url = rtrim($url, '&');
            foreach($params as $name => $value) {
                $url .= '&' . rawurlencode($name) . '=' . rawurlencode($value);
            }
        }
        if(StringUtils::endsWith($url, '?')) {
            $url = rtrim($url, '?');
        }
        if(StringUtils::endsWith($url, '&'))
            $url = rtrim($url, '&');
        return $url;
    }

    public static  function redirect($target = null, array $errors = null, $parameters = null) {
        if ($target == null) {
            if (!isset($_REQUEST['view'])) {
                throw new Exception('Missing target for forward.');
            }
            $target = $_REQUEST['view'];
        }

        if ($errors != null && count($errors) > 0)
            $target .= '&errors=' . urlencode(serialize($errors));
        if($parameters != null) {
            foreach ($parameters as $key => $val)
                $target .= '&' . $key . '=' . urlencode($val);
        }
        header('location: ' . $target);
    }


    public static function readKeyFromRequest($key, $default = null){
        return  isset($_REQUEST[$key]) ? self::escape($_REQUEST[$key]) : $default;
    }
    public static function readKeyFromRequestWithoutEscape($key, $default = null){
        return  isset($_REQUEST[$key]) ? $_REQUEST[$key] : $default;
    }

    public static function redirectWithInterval($page = null, $seconds = 0){
        if($page == null){
            $page = isset($_REQUEST['page']) ?
                $_REQUEST['page'] : $_SERVER['REQUEST_URI'];
        }
        header("refresh:$seconds;url=$page");
    }


}
?>