<?php
include_once "libs/maLibUtils.php";
include_once "libs/maLibSQL.pdo.php";
include_once "libs/maLibSecurisation.php";
include_once "libs/modele.php";

echo "Modifier les coordonnées de l'employé";
echo "</br></br></br>";
// Vérifiez si l'identifiant de l'employé est spécifié dans l'URL
if (isset($_GET['id'])) {
    // Récupérez l'identifiant de l'employé à partir de l'URL
    $idEmploye = $_GET['id'];

    // Récupérez les informations de l'employé à partir de la base de données en fonction de son identifiant
    $employe = infoUser($idEmploye);
    $table = json_encode($employe);
    $tableArray = json_decode($table, true);
    $nom = $tableArray[0]['nom'];
    $prenom = $tableArray[0]['prenom'];
    $adresse = $tableArray[0]['adresse'];
    $mail = $tableArray[0]['mail'];
    $num_telephone = $tableArray[0]['num_telephone'];
    $points_fidelite = $tableArray[0]['points_fidelite'];



    // Vérifiez si l'employé existe

    // Affichez les informations de l'employé dans un formulaire de modification
    ?>
    <form action="controleur.php" method="POST">
        <div class="log"><label for="nom">Nom </label><br>
            <input type="text" class="champText3" name="nom" placeholder="Nom" value="<?php echo $nom ?>" />
        </div><br />
        <div class="log"><label for="prenom">Prénom </label><br>
            <input type="text" class="champText3" name="prenom" placeholder="Prénom" value="<?php echo $prenom ?>" />
        </div><br />
        <div class="log"><label for="adresse">Adresse </label><br>
            <input type="text" class="champText3" name="adresse" placeholder="Adresse" value="<?php echo $adresse ?>" />
        </div><br />
        <div class="log"><label for="mail">Mail </label><br>
            <input type="text" class="champText3" name="mail" placeholder="Mail" value="<?php echo $mail ?>" />
        </div><br />
        <div class="log"><label for="num_telephone">Numéro de téléphone </label><br>
            <input type="text" class="champText3" name="num_telephone" placeholder="Numéro de téléphone"
                value="<?php echo $num_telephone ?>" />
        </div><br />
        <div class="log"><label for="points_fidelite">Points de fidélité </label><br>
            <input type="text" class="champText3" name="points_fidelite" placeholder="Points de fidélité"
                value="<?php echo $points_fidelite ?>" />
        </div><br />
    </form>


    <?php
} else {
    // Si aucun identifiant d'employé n'est spécifié dans l'URL, affichez un message d'erreur
    echo "Aucun identifiant d'employé spécifié.";
}
?>