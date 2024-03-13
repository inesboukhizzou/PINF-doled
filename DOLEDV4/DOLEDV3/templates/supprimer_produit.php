<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<?php
include_once "libs/maLibUtils.php";
include_once "libs/maLibSQL.pdo.php";
include_once "libs/maLibSecurisation.php";
include_once "libs/modele.php";

$listeProduits = listeProduits();
?>
<div id="searchContainer">
    <input type="text" id="searchProduit" onkeyup="filterProducts()"
        placeholder="Rechercher par marque, par designation ou par id">
</div>
<div id="produitsContainer">
    <?php

    foreach ($listeProduits as $produit) {
        echo "<div class='conteneur-produit'>";
        echo "<div class='produit'>";
        echo "   <img src='" . $produit["image_prod"] . "' class='photo'>";
        echo "   <p class='identite'><strong>" . $produit["designation"] . "</strong></p>";
        echo "   <p class='role'>" . $produit["prix_unitaire"] . "€</p>";
        echo " <p class='marque' >" . $produit["nom_marque"] . "</p>";
        echo "<input type='button' class='btn3' value='Supprimer' onclick='supprimerProduit(" . $produit["id_produit"] . ")'>";

        echo "</div></div>";
    }
    ?>
</div>
<script>


        function filterProducts() {
        var input, filter, produits, produit, i, txtValue;
        input = document.getElementById('searchProduit');
        filter = input.value.toUpperCase();
        produits = document.getElementsByClassName('produit');

        for (i = 0; i < produits.length; i++) {
            produit = produits[i];
        txtValue = produit.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
            produit.style.display = "";
            } else {
            produit.style.display = "none";
            }
        }
    }



        function supprimerProduit(idProduit) {
            // Effectuer une requête AJAX pour supprimer le produit
            $.ajax({
                url: 'controleur.php?action=supprimerProduit&id_produit=' + idProduit,
                method: 'POST',
                success: function (response) {
                    // Faire quelque chose après la suppression (mettre à jour l'interface utilisateur, etc.)
                    console.log(response);
                    location.reload();
                },
                error: function (error) {
                    console.log(error);
                }
            });
    }
</script>
