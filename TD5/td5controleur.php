<?php

require('../tbs_3151/tbs_class.php');
require('./connect.inc.php');

$TBS = new clsTinyButStrong();

$etatConnexion = "Démarrage de la connexion";

try {
    $id_serveur_BD = "mysql:host=$host;dbname=$dbname";
    $pdo = new PDO($id_serveur_BD, $login, $password);

    $etatConnexion = "Connexion réussie";
} catch (PDOException $erreur) {
    $etatConnexion = $erreur->getMessage();
}

$TBS->LoadTemplate("td5vue.tpl.html");
$TBS->Show();

?>