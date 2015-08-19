<?php


class Channel extends Entity {
    private $creationDate;
    private $updatedDate;
    private $title;
    private $description;
    private $creationUserId;

    public function __construct($id, $creationDate, $updatedDate, $title, $description, $creationUserId) {
        parent::__construct($id);
        $this->creationDate = $creationDate;
        $this->updatedDate = $updatedDate;
        $this->title = $title;
        $this->description = $description;
        $this->creationUserId = $creationUserId;
    }


    public function getCreationDate() {
        return $this->creationDate;
    }

    public function getUpdatedDate() {
        return $this->updatedDate;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getCreationUserId(){
        return $this->creationUserId;
    }
}