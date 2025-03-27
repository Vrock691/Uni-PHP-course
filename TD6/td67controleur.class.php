<?php

class Appli {
    private $tbs;

    function __construct($_tbs) {
        $this->tbs = $_tbs;
    } 

    private function formulaire() {
        $this->tbs->LoadTemplate("td67vue-form.tpl.html");
        $this->tbs->Show();
    }

    public function moteur($_accmat) {
        $action = isset($_GET["suivant"]) ? $_GET["suivant"] : "";

        switch ($action) {
            case 'form_ajout':
                $this->formulaire();
                break;
            
            case 'ajout':
                $_accmat->ajouterMatiere($_GET["codemat"], $_GET["libelle"], $_GET["coef"]);
                $_accmat->liste();
                break;

            case 'suppr':
                $_accmat->supprimerMatiere($_GET["codemat"]);
                $_accmat->liste();
                break;

            default:
                $_accmat->liste();
                break;
        }

    }

}

?>