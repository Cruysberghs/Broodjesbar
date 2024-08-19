<?php
class Bestelling {
    private $bestelID;
    private $broodje;
    private $user;

    public function __construct($bestelID, $broodje, $user) {
        $this->bestelID = $bestelID;
        $this->broodje = $broodje;
        $this->user = $user;
    }

    public function getBestelID() {
        return $this->bestelID;
    }

    public function getBroodje() {
        return $this->broodje;
    }

    public function getUser() {
        return $this->user;
    }
}
?>