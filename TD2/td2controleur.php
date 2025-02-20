<?php 

require('../tbs_3151/tbs_class.php');
require("./td2modele.class.php");

$TBS = new clsTinyButStrong();
$DATA = new FormData($_POST, $_FILES['photo']);

$tabChamps = [];
$tabValeur = [];

foreach($DATA->returnPost() as $key => $value) {
   array_push($tabChamps, $key);
   array_push($tabValeur, $value);
}

$tabChampsImg = [];
$tabValeursImg = [];

foreach($DATA->returnFile() as $key => $value) {
   array_push($tabChampsImg, $key);
   array_push($tabValeursImg, $value);
}

$path = $DATA->uploadFile();

$TBS->LoadTemplate("d2vue.tpl.html");

$TBS->MergeBlock("key", $tabChamps);
$TBS->MergeBlock("value", $tabValeur);

$TBS->MergeBlock("champImg", $tabChampsImg);
$TBS->MergeBlock("valeurImg", $tabValeursImg);

$TBS->MergeBlock("cheminImg", $path);

$TBS->Show();