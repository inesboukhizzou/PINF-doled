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

        <input type="button" class="btn5" value="Ajouter un employé"
            onclick="location.href='index.php?view=modifier_coordonnees&id=-1'">
        <div class="conteneur-carrousel-employes">
                    <?php foreach ($resultats as $unResultat) { ?>
                    <div class="carte-employe" onclick="window.location='index.php?view=modifier_coordonnees&id=<?= $unResultat["id_user"] ?>'">
                        <img src="ressources/profil.png" alt="Photo de l'employé" class="photo-employe">
                        <div class="details-employe">
                            <p class="nom-employe"><?= htmlspecialchars($unResultat["nom"]) . " " . htmlspecialchars($unResultat["prenom"]) ?></p>
                            <p class="role-employe"><?= htmlspecialchars($unResultat["nom_role"]) ?></p>
                        </div>
                    </div>
                    <?php } ?>
        </div>
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
        </br></br>
    </div>


</div>


<form action="controleur.php" method="post">
    <input type="hidden" name="action" value="Logout">
    <button class="btn1" type="submit">Déconnexion</button>
</form>
