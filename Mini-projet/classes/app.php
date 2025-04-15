<?php 

class App {

    private $tbs;
    
    function __construct($_tbs) {
        $this->tbs = $_tbs;
    }

    private function login() {
        $this->tbs->LoadTemplate("./pages/login.html");
        $this->tbs->Show();
    }

    private function account() {
        $this->tbs->LoadTemplate("./pages/account.html");
        $this->tbs->Show();
    }

    private function feed() {
        $this->tbs->LoadTemplate("./pages/feed.html");
        $this->tbs->Show();
    }

    public function engine() {
        $view = isset($_GET["view"]) ? $_GET["view"] : "";

        switch ($view) {
            case 'login':   
                $this->login();
                break;
            
            case 'account':
                $this->account();
                break;

            default:
                $this->feed();
                break;
        }

    }

}