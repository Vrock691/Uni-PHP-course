<?php 

class Request {

    protected $pdo;
    protected $tbs;
    protected $eta;
    protected $req;
    protected $gab;
    protected $data;

    function __construct($_pdo, $_tbs, $_eta, $_req, $_gab) 
    {
        $this->pdo = $_pdo;
        $this->tbs = $_tbs;
        $this->eta = $_eta;
        $this->req = $_req;
        $this->gab = $_gab;
    }

    public function executer() {
        $res = $this->pdo->prepare($this->req);
        $res->execute();
        $this->data = $res->fetchAll();
    }

}

class RQ1 extends Request {

    public function afficher() {
        
        $i = 0;
        $tabCode = array();
        $tabLibe = array();
        $tabCoef = array();
        foreach($this->data as $ligne) {
            $tabCode[$i++] = $ligne["codemat"];
            $tabLibe[$i++] = $ligne["libelle"];
            $tabCoef[$i++] = $ligne["coef"];
        }
        $this->tbs->LoadTemplate($this->gab);
        $this->tbs->MergeBlock("codemat", $tabCode);
        $this->tbs->MergeBlock("libelle", $tabLibe);
        $this->tbs->MergeBlock("coef", $tabCoef);

    }

}

class AccesMatiere {
    private $pdo;
    private $qmat;

    function __construct($param_pdo, $param_tbs, $param_connexion) {
        $this->pdo = $param_pdo;
        
        $req = "select * from matiere";
        $this->qmat = new RQ1($this->pdo, $param_tbs, $param_connexion, $req, "td67vue-tab.tpl.html");
    }
    
    public function liste() {
        $this->qmat->executer();
        $this->qmat->afficher();
    }

    public function ajouterMatiere($_codemat, $_libelle, $_coef) {
        $req = "insert into matiere values (?, ?, ?)";
        $message = "";
        $resultat = $this->pdo->prepare($req);
        $resultat->execute([ $_codemat, $_libelle, $_coef ]);
        if ($resultat->rowCount() > 0)
            $message = "Matière ajoutée";
    }

    public function supprimerMatiere($_codemat) {
        $req = "delete from matiere where codemat = ?";
        $message = "";
        $resultat = $this->pdo->prepare($req);
        $resultat->execute([ $_codemat ]);
        if ($resultat->rowCount() > 0)
            $message = "Matière supprimée";
    }

}


?>