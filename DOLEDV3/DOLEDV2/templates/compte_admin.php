<?php
include_once "libs/maLibUtils.php";
include_once "libs/maLibSQL.pdo.php";
include_once "libs/maLibSecurisation.php";
include_once "libs/modele.php";

// On affiche le nom et le rôle de tous les employés avec la fonction listeEmploye()
$resultats = listeEmployes(); ?>
<div class="conteneur">
    <div>
        <h3>Gestion des comptes</h3>
        <br><br>
        <?php
        foreach ($resultats as $unResultat) {

            echo "<div class='profil'>";
            echo "   <img src='ressources/profil.png' class='photo'>";
            echo "   <p class='identite'><strong>" . $unResultat["nom"] . " " . $unResultat["prenom"] . "</strong></p>";
            echo "   <p class='role'>" . $unResultat["nom_role"] . "</p>";
            echo "</div>";

        }
        ?>
    </div>

    <!--gestion du stock-->
    <div>
        <h3>Gestion des articles et du stock</h3>
        <br><br>
        <div id="ensembleBouttons">
            <input type="button" class="btn2" value="Ajouter un article"
                onclick="location.href='index.php?view=ajout_produit'">
            <input type="button" class="btn2" value="Supprimer un article"
                onclick="location.href='index.php?view=supprimer_produit'">
            <input type="button" class="btn2" value="Gestion des stocks et fidélités"
                onclick="location.href='index.php?view=compte_employe'">
        </div>
    </div>
</div>