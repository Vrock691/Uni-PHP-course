<?php 

class Feed {
    private $list = array();
    private $pdo;
    private $tbs;

    public function __construct($pdo, $tbs) {
        $this->pdo = $pdo;
        $this->tbs = $tbs;
    }

    public function fetchFeed() {
        $query = "SELECT * FROM posts JOIN users ON posts.author = users.userID ORDER BY created_at DESC";
        $req = $this->pdo->prepare($query);
        $req->execute();
        $this->list = $req->fetchAll(PDO::FETCH_ASSOC);
        return $this->list;
    }

    public function getFeed() {
        return $this->list;
    }
}

?>