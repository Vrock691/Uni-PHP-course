<?php 

class App {

    private $tbs;
    private $feed;
    private $pdo;
    
    function __construct($tbs, $feed, $pdo) {
        $this->tbs = $tbs;
        $this->feed = $feed;
        $this->pdo = $pdo;
    }

    // Affiche la page de login
    private function login() {
        $this->tbs->LoadTemplate("./pages/login.html");
        $this->tbs->MergeField('postText', ($_SESSION["loggedin"] != true) ? "" : "Poster");
        $this->tbs->MergeField('loginMessage', $_SESSION["user"]->loginMessage);
        $this->tbs->Show();
    }

    // Affiche la page de profil
    private function account() {
        $_SESSION["user"]->fetchPosted($this->pdo);
        $this->tbs->LoadTemplate("./pages/account.html");
        $this->tbs->MergeField('postText', ($_SESSION["loggedin"] != true) ? "" : "Poster");
        $this->tbs->MergeField('name', $_SESSION["user"]->getName());
        $this->tbs->MergeField('bio', $_SESSION["user"]->getBio());
        $this->tbs->MergeField('status', $_SESSION["user"]->getStatus());
        $this->tbs->MergeField('id', $_SESSION["user"]->getId());
        $this->tbs->MergeBlock("posts", $_SESSION["user"]->getPosts());
        $this->tbs->Show();
    }

    // Affiche le fil 
    private function feed() {
        $this->feed->fetchFeed();
        $this->tbs->LoadTemplate("./pages/feed.html");
        $this->tbs->MergeField('postText', ($_SESSION["loggedin"] != true) ? "" : "Poster");
        $this->tbs->MergeBlock("feed", $this->feed->getFeed());
        $this->tbs->Show();
    }

    // Affiche un article à partir de l'ID
    private function viewArticle($id) {
        $this->tbs->LoadTemplate("./pages/post.html");
        $this->tbs->MergeField('postText', ($_SESSION["loggedin"] != true) ? "" : "Poster");
        $this->tbs->Show();
    }

    // Affiche l'éditeur de post
    private function postEditor() {
        $this->tbs->LoadTemplate("./pages/edit.html");
        $this->tbs->MergeField('postText', ($_SESSION["loggedin"] != true) ? "" : "Poster");
        $this->tbs->Show();
    }

    public function engine() {
        $view = isset($_GET["view"]) ? $_GET["view"] : "";

        switch ($view) {
            case 'login':   
                if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
                    header("Location: " . $_SERVER['PHP_SELF'] . "?view=");
                    exit;
                }

                $_SESSION["user"] = new User();
                $_SESSION['loggedin'] = false;
                if ($_SESSION["user"]->login($this->pdo)) {
                    // Connexion effectuée
                    // Redirection vers le profil
                    $_SESSION["loggedin"] = true;
                    header("Location: " . $_SERVER['PHP_SELF'] . "?view=account");
                    exit;
                } else {
                    // Connexion échouée
                    // Affichage du message d'erreur
                    $_SESSION["loggedin"] = false;
                    $this->tbs->MergeField('loginMessage', $_SESSION["user"]->loginMessage);
                    $this->login();
                }
                break;

            case 'logout':
                // Déconnexion
                session_destroy();
                header("Location: " . $_SERVER['PHP_SELF'] . "?view=");
                exit;
                break;
                
            case 'account':
                // Si l'utilisateur n'est pas connecté, on affiche la page de login
                if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] != true) {
                    header("Location: " . $_SERVER['PHP_SELF'] . "?view=login");
                    exit;
                } else {
                    // Sinon, on vérifie qu'il n'y aucun changement de variables
                    if (isset($_POST["name"]) && isset($_POST["bio"]) && isset($_POST["status"])) {
                        $_SESSION["user"]->updateUser($this->pdo);
                    }

                    $this->account();
                }
                break;

            case 'post':
                // Si l'utilisateur n'est pas connecté, on affiche la page de login
                if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] != true) {
                    header("Location: " . $_SERVER['PHP_SELF'] . "?view=login");
                    exit;
                } else {
                    // Sinon, on vérifie qu'il n'y aucun post à créer
                    if (isset($_POST["title"]) && isset($_POST["desc"]) && isset($_POST["content"])) {
                        $_SESSION["user"]->createPost($this->pdo);
                        header("Location: " . $_SERVER['PHP_SELF'] . "?view=account");
                        exit;
                    }
                    
                    $this->postEditor();
                }
                break;

            case 'article':
                $postID = isset($_GET["postID"]) ? $_GET["postID"] : "";
                $this->viewArticle($postID);
                break;

            case 'addPost':
                // Gérer l'ajout d'un post
                break;

            default:
                $this->feed();
                break;
        }

    }

}