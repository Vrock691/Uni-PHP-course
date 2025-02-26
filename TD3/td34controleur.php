<?php

session_start();

require('../tbs_3151/tbs_class.php');
require("./td34modele.class.php");

$TBS = new clsTinyButStrong();
$ID = new ID();
$cible = $_SERVER['PHP_SELF'];

if (isset($_POST['login']) && isset($_POST['password'])) {
    $logged = $ID->verif($_POST['login'], $_POST['password']);
    if ($logged == 1) {
        $_SESSION['login'] = $_POST['login'];
        $_SESSION['password'] = $_POST['password'];
        $message = "Indentifiants corrects";
    } else {
        $message = "Indentifiant ou mot de passe incorrect";
    }

    $TBS->LoadTemplate("td34vue-msg.tpl.html");
    $TBS->Show();
} else if ($_SESSION["login"]) {
    $logged = $ID->verif($_SESSION['login'], $_SESSION['password']);
    if ($logged == 1) {
        if (!($_GET["action"])) {
            $cible = $_SERVER["PHP_SELF"] . "?action=suite";
            $message = "On continue";
        } else {
            switch ($_GET["action"]) {
                case 'suite':
                    $cible = $_SERVER["PHP_SELF"] . "?action=fin";
                    $message = "Il faut s'arreter maintenant";
                    break;
                
                default:
                    session_destroy();
                    $cible = $_SERVER["PHP_SELF"];
                    $message = "Bye Bye";
                    break;
            }
        }

        $TBS->LoadTemplate("td34vue-msg.tpl.html");
        $TBS->Show();
    } else {
        $TBS->LoadTemplate("td34vue-form.tpl.html");
        $TBS->Show();
    }
} else {
    $TBS->LoadTemplate("td34vue-form.tpl.html");
    $TBS->Show();
}

?>