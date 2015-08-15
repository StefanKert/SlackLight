<?php

interface IData {
    public function getId();
}

class Entity extends BaseObject implements IData {
    /**
     * @var integer
     */
    private $id;

    public function __construct($id){
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }
}