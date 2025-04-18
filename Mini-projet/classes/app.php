<?php 

class App {

    private $tbs;
    private $feed;
    private $user;
    private $pdo;
    
    function __construct($tbs, $feed, $user, $pdo) {
        $this->tbs = $tbs;
        $this->feed = $feed;
        $this->user = $user;
        $this->pdo = $pdo;
    }

    private function login() {
        $this->tbs->LoadTemplate("./pages/login.html");
        $this->tbs->MergeField('loginMessage', $this->user->loginMessage);
        $this->tbs->Show();
    }

    private function account() {
        $this->tbs->LoadTemplate("./pages/account.html");
        $this->tbs->Show();
    }

    private function feed() {
        $this->feed->fetchFeed();
        $this->tbs->LoadTemplate("./pages/feed.html");
        $this->tbs->MergeBlock("feed", $this->feed->getFeed());
        $this->tbs->Show();
    }

    private function viewArticle($id) {
        $this->tbs->LoadTemplate("./pages/post.html");
        $this->tbs->Show();
    }

    public function engine() {
        $view = isset($_GET["view"]) ? $_GET["view"] : "";

        switch ($view) {
            case 'login':   
                if (isset($_SESSION["userID"])) {
                    header("Location: " . $_SERVER['PHP_SELF'] . "?view=");
                    exit;
                }

                if ($this->user->login($this->pdo)) {
                    // Connexion effectuée
                    // Redirection vers le profil
                    header("Location: " . $_SERVER['PHP_SELF'] . "?view=account");
                    exit;
                } else {
                    // Connexion échouée
                    // Affichage du message d'erreur
                    $this->tbs->MergeField('loginMessage', $this->user->loginMessage);
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
                if (!isset($_SESSION["userID"])) {
                    header("Location: " . $_SERVER['PHP_SELF'] . "?view=login");
                    exit;
                } else {
                    // Sinon, on affiche le profil
                    $this->account();
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