<?php

require('../../tbs_3151/tbs_class.php');
require('./td5class.php');
require('./connect.inc.php');

$TBS = new clsTinyButStrong();

$etatConnexion = "Démarrage de la connexion";

try {
    $id_serveur_BD = "mysql:host=$host;dbname=$dbname";
    $pdo = new PDO($id_serveur_BD, $login, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $etatConnexion = "Connexion réussie";
    $_req = "select * from matiere";

    $qmat = new RQ1($pdo, $TBS, $etatConnexion, $_req, "td5vue.tpl.html");
    $qmat->executer();
    $qmat->afficher();
} catch (PDOException $erreur) {
    $etatConnexion = $erreur->getMessage();
}

$TBS->Show();

?>