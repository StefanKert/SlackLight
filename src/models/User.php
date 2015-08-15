<?php


class User extends Entity {
    /**
     * @var string
     */
    private $userName;
    /**
     * @var string
     */
    private $passwordHash;
    /**
     * Category constructor.
     * @param string $userName
     * @param string $passwordHash
     */
    public function __construct($id, $userName, $passwordHash) {
        parent::__construct($id);
        $this->userName = $userName;
        $this->passwordHash = $passwordHash;
    }

    /**
     * @return mixed
     */
    public function getUserName() {
        return $this->userName;
    }
    /**
     * @return mixed
     */
    public function getPasswordHash() {
        return $this->passwordHash;
    }
}