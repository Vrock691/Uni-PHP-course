<?php 

class Request {

    protected $PDO;
    protected $tbs;
    protected $eta;
    protected $req;
    protected $gab;
    protected $data;

    function __construct($_PDO, $_tbs, $_eta, $_req, $_gab) 
    {
        $this->PDO = $_PDO;
        $this->tbs = $_tbs;
        $this->eta = $_eta;
        $this->req = $_req;
        $this->gab = $_gab;
    }

    public function executer() {
        $res = $this->PDO->prepare($this->req);
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


?>