<?php

include_once 'libs/modele.php';
include_once 'libs/maLibSecurisation.php';
$products = getProduits();

// var_dump($products); // Cela devrait afficher les résultats ou false si la requête a échoué

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

?>

<form action="controleur.php" method="post">
    <input type="hidden" name="action" value="Logout">
    <button class ="btn1" type="submit">Déconnexion</button>
</form>
