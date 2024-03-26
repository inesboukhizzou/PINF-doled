<?php
include_once "libs/maLibUtils.php";
include_once "libs/maLibSQL.pdo.php";
include_once "libs/maLibSecurisation.php";
include_once "libs/modele.php";
?>
<div id="rechercheSupp">
    <input type="text" id="searchInput" placeholder="Rechercher">
</div>

<?php
$listeProduits = listeProduits();
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

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    function supprimerProduit(idProduit) {
        // Effectuer une requête AJAX pour supprimer le produit
        $.ajax({
            url: 'controleur.php?action=supprimerProduit&id_produit=' + idProduit,
            method: 'POST',
            success: function (response) {
                // Faire quelque chose après la suppression (mettre à jour l'interface utilisateur, etc.) 
                location.reload();
            },
            error: function (error) { 
            }
        });
    }

    $(document).ready(function () {
        // Écouteur d'événement pour le champ de recherche
        $('#searchInput').on('input', function () {
            var searchTerm = $(this).val().toLowerCase(); 

            // Parcourir tous les produits pour filtrer
            $('.conteneur-produit').each(function () {
                var identiteProduit = $(this).find('.identite').text().toLowerCase();
                if (identiteProduit.indexOf(searchTerm) === -1) {
                    $(this).hide();
                } else {
                    $(this).show();
                }
            });
        });
    });
</script>
