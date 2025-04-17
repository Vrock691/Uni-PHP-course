<?php

// Importation des classes
require('./classes/user.php');
require('./classes/post.php');
require('./classes/feed.php');
require('./classes/app.php');

// Initialisation de TinyButStrong
require('../tbs_3152/tbs_class.php');
$tbs = new clsTinyButStrong();

// Initialisation de la bdd
require('./connect.inc.php');
$dbStatus = "loading";

// Initialisation de la session
session_start();
$user = new User(0, "", "", 0);

try {

    // Connexion à la BDD
    $id_serveur_BD = "mysql:host=$host;dbname=$dbname";
    $pdo = new PDO($id_serveur_BD, $login, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbStatus = "success";

    $cible = $_SERVER["PHP_SELF"];

    // Création du feed
    $feed = new Feed($pdo, $tbs);

    // Préparation de l'application
    $app = new App($tbs, $feed, $user, $pdo);
    $app->engine();

} catch (PDOException $error) {
    $dbStatus = "failed";
    echo "Erreur de connexion à la base de données : " . $error->getMessage();
}

?>