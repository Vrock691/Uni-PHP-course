<?php 

class User {
    private $id;
    private $name;
    private $bio;
    private $status;

    public $loginMessage = "";

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

    public function login($id, $password, $pdo) {
        // Vérifier les identifiants avec la bdd
        $stmt = $pdo->prepare("SELECT id, name, bio, status FROM users WHERE id = :id AND password = :password");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user) {
            $this->id = $user['id'];
            $this->name = $user['name'];
            $this->bio = $user['bio'];
            $this->status = $user['status'];
            return true;
        }

        return false;
    }

}
