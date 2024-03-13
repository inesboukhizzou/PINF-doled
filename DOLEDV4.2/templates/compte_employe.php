<?php
include_once "libs/maLibUtils.php";
include_once "libs/maLibSQL.pdo.php";
include_once "libs/maLibSecurisation.php";
include_once "libs/modele.php";

// Gestion des stocks et fidélités
?>

<h3> Gestion des points de fidélité </h3>
<div id="searchContainer">
    <input type="text" id="searchInputClient" placeholder="Rechercher par pseudo ou mail">
</div>
<div id="tableContainerClient">
    <table>
        <thead>
            <tr>
                <th>Identifiant</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Adresse</th>
                <th>Mail</th>
                <th>Numéro de téléphone</th>
                <th>Points de fidélité</th>
                <th>Montant dépensé (Dhs)</th>
                <th>Points de fidélité dépensés </th>
            </tr>
        </thead>
        <tbody>
            <?php $listeClients = listeClients();
            foreach ($listeClients as $client): ?>
                <tr>
                    <td>
                        <?php echo $client['id_user']; ?>
                    </td>
                    <td>
                        <?php echo $client['nom']; ?>
                    </td>
                    <td>
                        <?php echo $client['prenom']; ?>
                    </td>
                    <td>
                        <?php echo $client['adresse']; ?>
                    </td>
                    <td>
                        <?php echo $client['mail']; ?>
                    </td>
                    <td>
                        <?php echo $client['num_telephone']; ?>
                    </td>
                    <td class='pointsFidelite'>
                        <?php echo $client['points_fidelite']; ?>
                    </td>
                    <td>
                        <input type="text" class="editablePoints" data-id="<?php echo $client['id_user']; ?>"
                            data-colonne="montantDepense" value=0>
                    </td>
                    <td>
                        <input type="text" class="pointDepense" data-id="<?php echo $client['id_user']; ?>"
                            data-colonne="pointsDepenses" value=0>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>


<div>
    <!-- Ajoutez un titre -->
    <h3>Gestion des stocks</h3>

    <div id="searchContainer">
        <input type="text" id="searchInput" placeholder="Rechercher">
    </div>

    <!-- Ajoutez un conteneur pour le tableau -->
    <div id="tableContainer">
        <table>
            <thead>
                <tr>
                    <th><input type="checkbox" id="selectAll">Sélectionner</th>
                    <th onclick="trierParColonne(this, 1)" data-ordre="asc" data-colonne="Id">Identifiant <span
                            id="iconeTriId"></span>
                    </th>
                    <th> Image</th>
                    <th onclick="trierParColonne(this, 2)" data-ordre="asc" data-colonne="NumSerie">Numéro de
                        série <span id="iconeTriNumSerie"></span></th>
                    <th onclick="trierParColonne(this, 3)" data-ordre="asc" data-colonne="Designation">Désignation <span
                            id="iconeTriDesignation"></span></th>
                    <th onclick="trierParColonne(this, 4)" data-ordre="asc" data-colonne="PrixHT">Prix HT (Dhs)<span
                            id="iconeTriPrixHT"></span>
                    </th>
                    <th onclick="trierParColonne(this, 5)" data-ordre="asc" data-colonne="PrixTTC">Prix TTC (Dhs)<span
                            id="iconeTriPrixTTC"></span>
                    </th>
                    <th onclick="trierParColonne(this, 6)" data-ordre="asc" data-colonne="Stock">Stock <span
                            id="iconeTriStock"></span></th>
                    <th onclick="trierParColonne(this, 7)" data-ordre="asc" data-colonne="Promotion">Promotion (%) <span
                            id="iconeTriPromotion"></span></th>
                    <!-- Ajoutez d'autres colonnes en fonction de vos besoins -->
                </tr>
            </thead>
            <tbody>
                <?php $listeProduits = listeProduits();
                foreach ($listeProduits as $produit):
                    $prixHT = $produit['prix_unitaire'];
                    $prixTTC = $prixHT * 1.2;
                    $stock = stockProduit($produit['id_produit']);

                    ?>
                    <tr>
                        <td><input type="checkbox" name="selection[]" value="<?php echo $produit['id_produit']; ?>"></td>
                        <td>
                            <?php echo $produit['id_produit']; ?>
                        </td>
                        <td><img src="<?php echo $produit['image_prod']; ?>" alt="Image du produit" width="50"></td>
                        <td><input type="text" class="editable" data-id="<?php echo $produit['id_produit']; ?>"
                                data-colonne="num_serie" value="<?php echo $produit['num_serie']; ?>"></td>
                        <td><input type="text" class="editable" data-id="<?php echo $produit['id_produit']; ?>"
                                data-colonne="designation" value="<?php echo $produit['designation']; ?>"></td>
                        <td><input type="text" class="editable" data-id="<?php echo $produit['id_produit']; ?>"
                                data-colonne="prix_ht" value="<?php echo $prixHT; ?>"></td>
                        <td><input type="text" class="editable" data-id="<?php echo $produit['id_produit']; ?>"
                                data-colonne="prix_ttc" value="<?php echo $prixTTC; ?>"></td>
                        <td><input type="text" class="editable" data-id="<?php echo $produit['id_produit']; ?>"
                                data-colonne="stock" value="<?php echo $stock; ?>"></td>
                        <td><input type="text" class="editable" data-id="<?php echo $produit['id_produit']; ?>"
                                data-colonne="promotion" value="<?php echo $produit['promotion']; ?>"></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>


        </table>
    </div>
    <div id="promotionContainer">
        <label for="promotionInput"> Modifier la promotion pour les éléments sélectionnés: </label></br></br>
        <input type="number" id="promotionInput" min="0" max="100" step="0.5" value="0">
        <button id="applyPromotion" class="btn2">Appliquer</button>
    </div></br></br></br>

    <!-- Ajoutez un conteneur pour le champ de recherche -->

</div>


<form action="controleur.php" method="post">
    <input type="hidden" name="action" value="Logout">
    <button class="btn1" type="submit">Déconnexion</button>
</form>
<!-- Ajoutez ceci à votre JavaScript -->
<!-- jquery -->

<script>
    $(document).ready(function () {
        // Écouteur d'événement pour le champ de recherche
        $('#searchInput').on('input', function () {
            var searchTerm = $(this).val().toLowerCase();
            console.log(searchTerm);

            // Parcours toutes les lignes du tableau
            $('#tableContainer table tbody tr').each(function () {
                var id = $(this).find('td:eq(1)').text().toLowerCase(); // Index 1 pour la colonne de l'identifiant
                var numSerie = $(this).find('td:eq(3) input').val().toLowerCase(); // Index 3 pour la colonne du numéro de série
                var designation = $(this).find('td:eq(4) input').val().toLowerCase(); // Index 4 pour la colonne de la désignation

                if (id.includes(searchTerm) || numSerie.includes(searchTerm) || designation.includes(searchTerm)) {
                    $(this).show(); // Afficher la ligne si elle correspond
                } else {
                    $(this).hide(); // Masquer la ligne sinon
                }
            });
        });
    });

    // Fonction pour trier par colonne (sauf l'image)
    function trierParColonne(trigger, indexColonne) {
        const tbody = document.querySelector('tbody');
        const rows = Array.from(tbody.querySelectorAll('tr'));

        // Déterminer l'ordre de tri
        const ordre = (trigger.dataset.ordre === 'asc') ? -1 : 1;
        console.log(trigger.dataset.colonne);
        // Mettre à jour l'icône de tri
        const iconeTri = document.getElementById('iconeTri' + trigger.dataset.colonne);
        console.log(iconeTri);
        if (trigger.dataset.ordre === 'asc') {
            iconeTri.innerHTML = '&#9660;'; // Flèche vers le bas pour tri ascendant
        } else {
            iconeTri.innerHTML = '&#9650;'; // Flèche vers le haut pour tri descendant
        }

        // Trier les lignes en fonction de la colonne
        rows.sort((a, b) => {
            const contenuA = a.cells[indexColonne].textContent.toLowerCase();
            const contenuB = b.cells[indexColonne].textContent.toLowerCase();
            return contenuA > contenuB ? ordre : -ordre;
        });

        // Réorganiser les lignes dans le tableau
        rows.forEach(row => tbody.appendChild(row));

        // Inverser l'ordre de tri pour le prochain clic
        trigger.dataset.ordre = (trigger.dataset.ordre === 'asc') ? 'desc' : 'asc';
    }

    $(document).ready(function () {
        // Gestion de l'édition des cellules
        $('.editable').click(function () {
            var id = $(this).data('id');
            console.log(id);
            var contenu = $(this).val();
            console.log(contenu);

        });

        // Enregistrement des modifications lors de l'appui sur "Entrée"
        $(document).on('keydown', '.editable', function (e) {
            if (e.key === 'Enter') {
                console.log('Entrée');
                var id = $(this).data('id');
                console.log(id);
                var newValue = $(this).val();
                console.log(newValue);
                $(this).val(newValue);
                $(this).blur();
                console.log($(this).data('colonne'));

                // Envoyer la modification au serveur
                $.ajax({
                    url: 'controleur.php?action=modifier_produit',
                    type: 'POST',
                    data: {
                        id: id,
                        colonne: $(this).data('colonne'),
                        valeur: newValue
                    },
                    success: function (data) {


                    }
                });
            }
        });
    });

    $(document).ready(function () {
        // Écouteur d'événement pour la case à cocher "Tout sélectionner"
        $('#selectAll').on('change', function () {
            // Si la case à cocher est cochée, cochez toutes les cases de sélection dans le tableau
            if ($(this).prop('checked')) {
                $('input[name="selection[]"]').prop('checked', true);
            } else {
                // Sinon, décochez toutes les cases de sélection dans le tableau
                $('input[name="selection[]"]').prop('checked', false);
            }
        });
    });
    $(document).ready(function () {
        // Gestion de l'événement de clic sur le bouton "Appliquer"
        $('#applyPromotion').click(function () {
            // Récupérer la valeur de la promotion à appliquer
            var newPromotion = $('#promotionInput').val();

            // Récupérer les éléments sélectionnés
            var selectedProducts = $('input[name="selection[]"]:checked');

            // Parcourir les éléments sélectionnés et mettre à jour leurs promotions
            selectedProducts.each(function () {
                var productId = $(this).val();
                console.log(productId);
                console.log(newPromotion);

                // Envoyer une requête AJAX pour mettre à jour la promotion du produit
                $.ajax({
                    url: 'controleur.php?action=modifier_promotion',
                    type: 'POST',
                    data: {
                        id: productId,
                        promotion: newPromotion
                    },
                    success: function (data) {
                        // Gérer la réponse ou la mise à jour de l'interface utilisateur si nécessaire
                        console.log("Promotion mise à jour pour le produit avec l'ID " + productId);
                        //on affiche les nw promotions dans le tableau
                        $('.editable[data-id="' + productId + '"][data-colonne="promotion"]').val(newPromotion);



                    },
                    error: function (error) {
                        // Gérer les erreurs éventuelles
                        console.error("Erreur lors de la mise à jour de la promotion pour le produit avec l'ID " + productId);
                    }
                });
            });
        });
    });

    $(document).ready(function () {
        // Écouteur d'événement pour le champ de recherche
        $('#tableContainerClient table tbody tr').hide();
        $('#searchInputClient').on('input', function () {
            var searchTerm = $(this).val().toLowerCase();
            console.log(searchTerm);

            // Parcours toutes les lignes du tableau
            $('#tableContainerClient table tbody tr').each(function () {
                var mail = $(this).find('td:eq(4)').text().toLowerCase(); // Index 1 pour la colonne de l'identifiant
                var numTel = $(this).find('td:eq(5)').text().toLowerCase(); // Index 4 pour la colonne de la désignation
                if (mail.includes(searchTerm) || numTel.includes(searchTerm)) {
                    $(this).show(); // Afficher la ligne si elle correspond
                } else {
                    $(this).hide(); // Masquer la ligne sinon
                }
            });
        });
    });

    $(document).ready(function () {
        // Gestion de l'édition des cellules
        $('.editablePoints').click(function () {
            var id = $(this).data('id');
            console.log(id);
            var contenu = $(this).val();
            console.log(contenu);

        });

        $('.pointDepense').click(function () {
            var id = $(this).data('id');
            console.log(id);
            var contenu = $(this).val();
            console.log(contenu);

        });

        // Enregistrement des modifications lors de l'appui sur "Entrée"
        $(document).on('keydown', '.editablePoints', function (e) {
            if (e.key === 'Enter') {
                console.log('Entrée');
                var id = $(this).data('id');
                console.log(id);
                var newValue = $(this).val();
                console.log(newValue);
                var points = $(this).closest('tr').find('.pointsFidelite').text();
                console.log(points);


                // Convertir la valeur en entier pour effectuer des opérations mathématiques
                points = parseInt(points);
                console.log(points);
                // Calculer le nouveau total des points de fidélité
                var total = points + parseInt(newValue);
                console.log(total);
                $(this).closest('tr').find('.pointsFidelite').text(total);
                $(this).blur();

                // Envoyer la modification au serveur
                $.ajax({
                    url: 'controleur.php?action=modifier_fidelite',
                    type: 'POST',
                    data: {
                        id: id,
                        valeur: newValue
                    },
                    success: function (data) {



                    }
                });
            }
        });

        $(document).on('keydown', '.pointDepense', function (e) {
            if (e.key === 'Enter') {
                console.log('Entrée');
                var id = $(this).data('id');
                console.log(id);
                var newValue = $(this).val();
                console.log(newValue);
                var points = $(this).closest('tr').find('.pointsFidelite').text();
                console.log(points);


                // Convertir la valeur en entier pour effectuer des opérations mathématiques
                points = parseInt(points);
                console.log(points);
                // Calculer le nouveau total des points de fidélité
                var total = points - parseInt(newValue);
                console.log(total);
                if (total < 0) {
                    total = points;
                    //on affiche un popup indiquant q'uon a pas assez de points de fidelite
                    alert("Vous n'avez pas assez de points de fidélité");
                }
                $(this).closest('tr').find('.pointsFidelite').text(total);
                $(this).blur();

                // Envoyer la modification au serveur
                $.ajax({
                    url: 'controleur.php?action=supprimer_points',
                    type: 'POST',
                    data: {
                        id: id,
                        valeur: total
                    },
                    success: function (data) {



                    }
                });
            }
        });
    });

</script>