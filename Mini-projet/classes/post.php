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
}

?>