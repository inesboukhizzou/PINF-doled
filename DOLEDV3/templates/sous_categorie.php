<?php
include_once 'libs/modele.php';

if (isset($_GET['id'])) {
    $categorie_mere_id = $_GET['id'];
    $catMere = getCategorieMere($categorie_mere_id);
    $catMereNom = getCategorieMereNom($categorie_mere_id);
    // echo $catMereNom;
    // var_dump($catMereNom);
    $sous_categories = getSousCategorie($categorie_mere_id);
    
    if ($sous_categories) {
        foreach ($sous_categories as $sous_categorie) {
            echo '<body class="catBODY">';
            if ($catMereNom){
                foreach($catMereNom as $catMereNomm)
            echo '<div class="deco-cat"> <h1 class="titresH1">' . htmlspecialchars($catMereNomm['nom_cat']) .'</h1> </div>';
            }
            echo '<div class="box-cat" >';
            echo '<img class="image-cat" src="' . htmlspecialchars($sous_categorie['image_cat']) . '" alt="image de la sous-catégorie">';
            echo '<h2 class="nom-cat">' . htmlspecialchars($sous_categorie['nom_cat']) . '</h2>';
            echo '</div>';
            echo '</body>';
        }
    } else {
        echo '<p>Aucune sous-catégorie trouvée pour cette catégorie.</p>';
    }
} else {
    echo '<p>Identifiant de la catégorie non spécifié.</p>';
}
?>
