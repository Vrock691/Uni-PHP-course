<?php

class User
{
    private $id;
    private $name;
    private $bio;
    private $status;
    private $posts = [];

    public $loginMessage = "";

    public function __construct() {}

    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function getName()
    {
        return $this->name;
    }
    public function setName($name)
    {
        $this->name = $name;
    }
    public function getBio()
    {
        return $this->bio;
    }
    public function setBio($bio)
    {
        $this->bio = $bio;
    }
    public function getStatus()
    {
        return $this->status;
    }
    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function login($pdo)
    {
        // Gérer le post de connexion
        if (isset($_POST["userID"]) && isset($_POST["password"])) {
            $id = $_POST["userID"];
            $password = $_POST["password"];

            // Vérifier les identifiants avec la bdd
            $stmt = $pdo->prepare("SELECT userID, name, bio, status FROM users WHERE userID = :id AND password = :password");
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':password', $password);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($user) {
                $this->id = $user['userID'];
                $this->name = $user['name'];
                $this->bio = $user['bio'];
                $this->status = $user['status'];

                $this->loginMessage = "Connexion réussie";
                return true;
            } else {
                // Afficher un message d'erreur
                $this->loginMessage = "Identifiants incorrects";
                return false;
            }
        } else {
            // Afficher un message d'erreur
            $this->loginMessage = "Veuillez entrer vos identifiants";
            return false;
        }
    }

    public function fetchPosted($pdo)
    {
        $query = "SELECT * FROM posts JOIN users ON posts.author = users.userID ORDER BY created_at DESC";
        $req = $pdo->prepare($query);
        $req->execute();
        $this->posts = $req->fetchAll(PDO::FETCH_ASSOC);
        return $this->posts;
    }

    public function getPosts()
    {
        return $this->posts;
    }

    public function createPost($pdo) {
        // Gérer le post de création
        if (isset($_POST["title"]) && isset($_POST["desc"]) && isset($_POST["content"])) {
            $title = $_POST["title"];
            $desc = $_POST["desc"];
            $content = $_POST["content"];

            // Insérer le post dans la bdd
            $stmt = $pdo->prepare("INSERT INTO posts (title, `desc`, content, author) VALUES (:title, :desc, :content, :author)");
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':desc', $desc);
            $stmt->bindParam(':content', $content);
            $stmt->bindParam(':author', $_SESSION["user"]->getId());
            $stmt->execute();
        }
    }

    public function updateUser($pdo)
    {
        // Mise à jour des informations en local
        $_SESSION["user"]->setName($_POST["name"]);
        $_SESSION["user"]->setBio($_POST["bio"]);
        $_SESSION["user"]->setStatus($_POST["status"]);

        // On met à jour la base de données
        $stmt = $pdo->prepare("UPDATE users SET name = :name, bio = :bio, status = :status WHERE id = :id");
        $stmt->bindParam(':name', $_SESSION["user"]->getName());
        $stmt->bindParam(':bio', $_SESSION["user"]->getBio());
        $stmt->bindParam(':status', $_SESSION["user"]->getStatus());
        $stmt->bindParam(':userID', $_SESSION["user"]->getId());
        $stmt->execute();
    }
}
