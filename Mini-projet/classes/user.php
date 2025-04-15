<?php 

class User {
    private $id;
    private $name;
    private $bio;
    private $status;

    public function __construct($id, $name, $bio, $status) {
        $this->id = $id;
        $this->name = $name;
        $this->bio = $bio;
        $this->status = $status;
    }

    public function getId() {
        return $this->id;
    }
    public function getName() {
        return $this->name;
    }
    public function getBio() {
        return $this->bio;
    }
    public function getStatus() {
        return $this->status;
    }

}
