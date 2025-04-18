<?php 

class Post {
    private $pdo;
    private $id;
    private $title;
    private $desc;
    private $content;
    private $author;
    private $created_at;

    public function __construct($pdo, $id) {
        $this->pdo = $pdo;
        $this->id = $id;

        $stmt = $this->pdo->prepare("SELECT * FROM posts JOIN users ON posts.author = users.userID WHERE posts.postID = :id");
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
        $post = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($post) {
            $this->title = $post['title'];
            $this->desc = $post['description'];
            $this->content = $post['content'];
            $this->author = new User();
            $this->author->setId($post['userID']);
            $this->author->setName($post['name']);
            $this->author->setBio($post['bio']);
            $this->author->setStatus($post['status']);
            $this->created_at = $post['created_at'];
        }
    }

    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getDesc() {
        return $this->desc;
    }

    public function getContent() {
        return $this->content;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function getCreatedAt() {
        return $this->created_at;
    }
}

?>