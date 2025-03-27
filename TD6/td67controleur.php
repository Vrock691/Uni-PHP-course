<?php

require('../tbs_3151/tbs_class.php');
require('./td67modele.class.php');
require('./td67controleur.class.php');
require('./connect.inc.php');

$tbs = new clsTinyButStrong();

$etatConnexion = "Démarrage de la connexion";

try {
    // Connexion à la BDD
    $id_serveur_BD = "mysql:host=$host;dbname=$dbname";
    $pdo = new PDO($id_serveur_BD, $login, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $etatConnexion = "Connexion réussie";
    
    $cible = $_SERVER["PHP_SELF"];
    
    // Affichage des matières
    $accmat = new AccesMatiere($pdo, $tbs, $etatConnexion);
    $accmat->liste();

    // Démarrage de l'application
    $appli = new Appli($tbs);
    $appli->moteur($accmat);
} catch (PDOException $erreur) {
    $etatConnexion = $erreur->getMessage();
    echo $etatConnexion;
}

$tbs->Show();

?>