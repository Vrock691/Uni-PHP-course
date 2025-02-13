<?php

require('../tbs_3151/tbs_class.php');
require('td1.class.php');
$TBS = new clsTinyButStrong();

$hw = new HelloWorld("Hello World");
$valeur = $hw->retournerN();

$scal = array("chaine0", "chaine1", "chaine2");
$tab = new Tableau($scal);

$mat = new Matrice(array(array(1, 3, 5), array(9, 0, 2)));
$somme = $mat->sum();

// Chargement de la template
$TBS->LoadTemplate("td1.tpl.html");

// Mise en oeuvre des blocs de répétition
$TBS->MergeBlock("chaine", $tab->returnT());
$TBS->MergeBlock("nombre", $mat->returnAll());

// Affichage
$TBS->Show();

?>