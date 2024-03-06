<?php

include_once 'libs/modele.php';
include_once 'libs/maLibSecurisation.php';

$limit = 24; // nb de produits max par page 
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// si on veut accéder aux produits appartenant à une catégorie
if (isset($_GET['id'])) {
    $categorie_id = $_GET['id'];
    $totalProduits = getTotalProduitsBySousCat($categorie_id); 
    $totalPages = ceil($totalProduits / $limit);
    $products = getProduitsBySousCatPaginated($categorie_id, $limit, $offset); 
} 
// si on veut accéder aux produits mais sans passer par les catégories
else {
    $totalProduits = getTotalProduits(); 
    $totalPages = ceil($totalProduits / $limit);
    $products = getProduitsPagines($limit, $offset); 
}
ini_set('display_errors', 1);
error_reporting(E_ALL);

?>

<div class="products-hp">
<?php foreach ($products as $product): ?>
    <?php
        $quantiteProd = getQuantite($product['id_produit']);
        $quantiteProdMin = getQuantiteMin($product['id_produit']);
        if ($quantiteProd == 0) {
            $affichage = "En rupture de stock";
            $classe = "rouge";
        } elseif ($quantiteProd < $quantiteProdMin) {
            $affichage = "Il ne reste que $quantiteProd exemplaires(s)";
            $classe = "orange";
        } else {
            $affichage = "Disponible";
            $classe = "vert";
        }
    ?>
    <div class="product-card">
        <img src="<?php echo htmlspecialchars($product['image_prod']); ?>" alt="Image du produit" class="product-image">
        <div class="product-details">
            <h3 class="product-name"><?php echo htmlspecialchars($product['designation']); ?></h3>
            <p class="product-price"><?php echo htmlspecialchars($product['prix_unitaire']); ?> dhs</p>
            <p class="product-availability <?php echo $classe; ?>"><?php echo $affichage; ?></p>
            <a href="index.php?view=produit&id=<?php echo $product['id_produit']; ?>" class="product-details-link">Voir les détails</a>
        </div> 
    </div> 
<?php endforeach; ?>
</div>

<div class="pagination" style="text-align: center;">
    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <a href="index.php?view=produits&page=<?php echo $i; ?><?php echo isset($categorie_id) ? "&id=$categorie_id" : ''; ?>" class="<?php echo $page == $i ? 'active' : ''; ?>">
            <?php echo $i; ?>
        </a>
    <?php endfor; ?>
</div>

