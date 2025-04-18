<?php 

class Post {
    private $pdo;
    private $id;
    private $title;
    private $desc;
    private $content;
    private $author;
    private $created_at;
    private $image;

    public function __construct($pdo, $id, $title, $desc, $content, $author, $created_at, $image) {
        $this->pdo = $pdo;
        $this->id = $id;
        $this->title = $title;
        $this->desc = $desc;
        $this->content = $content;
        $this->author = $author;
        $this->created_at = $created_at;
        $this->image = $image;
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

    public function getImage() {
        return $this->image;
    }
}

?>