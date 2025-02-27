<?php

session_start();

require('../tbs_3151/tbs_class.php');
require("./td34modele.class.php");

$TBS = new clsTinyButStrong();
$ID = new ID();

if (isset($_POST['login']) && isset($_POST['password'])) {
    $TBS->LoadTemplate("td34vue-msg.tpl.html");
    
    $logged = $ID->verif($_POST['login'], $_POST['password']);
    if ($logged == 1) {
        $_SESSION['login'] = $_POST['login'];
        $_SESSION['password'] = $_POST['password'];
        $TBS->MergeBlock('message', "Indentifiants corrects");
    } else {
        $TBS->MergeBlock('message', "Indentifiant ou mot de passe incorrect");
    }
} else if ($_SESSION["login"]) {
    
    $logged = $ID->verif($_SESSION['login'], $_SESSION['password']);
    if ($logged == 1) {
        session_destroy();
        $TBS->LoadTemplate("td34vue-msg.tpl.html");
        $TBS->MergeBlock('message', "Connecté");
    } else {
        $TBS->LoadTemplate("td34vue-form.tpl.html");
        $TBS->MergeBlock('message', "Indentifiant ou mot de passe incorrect");
    }
} else {
    $TBS->LoadTemplate("td34vue-form.tpl.html");
}

$TBS->MergeBlock('cible', $_SERVER['PHP_SELF']);

$TBS->Show();

?>