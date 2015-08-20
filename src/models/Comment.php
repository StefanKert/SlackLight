<?php


class Comment extends Entity {
    private $creationDate;
    private $updatedDate;
    private $text;
    private $channelId;
    private $creationUserId;
    private $deleted;

    public function __construct($id, $creationDate, $updatedDate, $text, $channelId, $creationUserId, $deleted) {
        parent::__construct($id);
        $this->creationDate = $creationDate;
        $this->updatedDate = $updatedDate;
        $this->text = $text;
        $this->channelId = $channelId;
        $this->creationUserId = $creationUserId;
        $this->deleted = $deleted;
    }


    public function getCreationDate() {
        return $this->creationDate;
    }

    public function getUpdatedDate() {
        return $this->updatedDate;
    }

    public function getText() {
        return $this->text;
    }

    public function getChannelId() {
        return $this->channelId;
    }

    public function getCreationUserId(){
        return $this->creationUserId;
    }

    public function getDeleted(){
        return $this->deleted;
    }
}