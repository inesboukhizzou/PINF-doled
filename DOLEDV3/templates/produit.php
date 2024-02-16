<?php
include_once 'libs/modele.php';

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    $product = getProduitById($product_id);

    if ($product) {
        $productDetails = $product[0];
        
        
        // Affichage des détails du produit
        echo '<div class="product-container">';
        echo '<div class="product-image-container">';
        echo '<img class="product-image" src="'.htmlspecialchars($productDetails['image_prod']).'" alt="Image du produit">';
        echo '</div>';
        echo '<div class="product-details-container">';
        echo '<h1 class="product-designation">' . htmlspecialchars($productDetails['designation']) . '</h1>';
        echo '<h4 class="product-serial-number">' . htmlspecialchars($productDetails['num_serie']) . '</h4>';
        echo '<h3 class="product-price">' . htmlspecialchars($productDetails['prix_unitaire']) . ' dhs</h3>';
        echo '<p class="product-description">' . htmlspecialchars($productDetails['descriptif_produit']) . '</p>';
        echo '<a class="product-datasheet-link" href="'.htmlspecialchars($productDetails['datasheet']).'">Lien de la datasheet</a>';
        
        // Affichage de la disponibilité
        $quantiteProd = getQuantite($product_id);
        $quantiteProdMin = getQuantiteMin($product_id);
        $classe = ($quantiteProd == 0) ? 'rouge' : (($quantiteProd < $quantiteProdMin) ? 'orange' : 'vert');
        $affichage = ($quantiteProd == 0) ? 'En rupture de stock' : (($quantiteProd < $quantiteProdMin) ? "Il ne reste que $quantiteProd exemplaire(s)" : 'Disponible');
        echo '<p><span class="' . $classe . '">' . $affichage . '</span></p>';
        echo '</div>';
        echo '</div>';
        
        // Affichage des produits de la même catégorie
        $idCat = htmlspecialchars($productDetails['id_cat']);
        $productsCat = getProduitByCat($idCat);
        if ($productsCat) {
            echo '<div class="product-container-carousell">';
            echo '<i class="fas fa-arrow-left" id="scroll-left"></i>';
            foreach ($productsCat as $productCatDetails) {
                echo '<div class="product-card-carousell">';
                echo '<img class="product-image-carousell" src="'.htmlspecialchars($productCatDetails['image_prod']).'" alt="Image du produit">';
                echo '<div class="product-details">';
                echo '<h4 class="product-serial-number">' . htmlspecialchars($productCatDetails['designation']) . '</h4>';
                echo '</div>';
                echo '</div>';
            }
            echo '<i class="fas fa-chevron-right" id="scroll-right"></i>';
            echo '</div>';
        }
    } else {
        echo '<p>Produit non trouvé.</p>';
    }
} else {
    echo '<p>Identifiant du produit non spécifié.</p>';
}
?>
<!-- Ajoutez FontAwesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<!-- JavaScript pour le carrousel -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const container = document.querySelector('.product-container-carousell');
    const btnLeft = document.getElementById('scroll-left');
    const btnRight = document.getElementById('scroll-right');

    // Supposons que tous les éléments du carrousel ont la même largeur et des marges uniformes
    const slideWidth = document.querySelector('.product-card-carousell').offsetWidth;
    const slideMarginRight = parseInt(window.getComputedStyle(document.querySelector('.product-card-carousell')).marginRight);

    console.log('slideWidth:', slideWidth); // Vérifiez la valeur de slideWidth

    btnLeft.addEventListener('click', function() {
        console.log('Left button clicked'); // Vérifiez si le bouton gauche est cliqué
        container.scrollLeft -= slideWidth + slideMarginRight;
    });

    btnRight.addEventListener('click', function() {
        console.log('Right button clicked'); // Vérifiez si le bouton droit est cliqué
        container.scrollLeft += slideWidth + slideMarginRight;
    });
});


</script>

