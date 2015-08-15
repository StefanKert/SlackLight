<?php
class BaseObject {
    public function __get($name){
        throw new Exception('Attribute ' . $name . ' is not declaerd');
    }

    public function __set($name, $value){
        throw new Exception('Attribute ' . $name . ' is not declaerd');
    }

    public function __call($name, $arguments){
        throw new Exception('Method ' . $name . ' is not declaerd');
    }

    public static function __callStatic($name, $arguments){
        throw new Exception('StaticMethod ' . $name . ' is not declaerd');
    }
}