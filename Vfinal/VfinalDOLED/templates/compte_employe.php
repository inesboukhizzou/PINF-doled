<?php
include_once "libs/maLibUtils.php";
include_once "libs/maLibSQL.pdo.php";
include_once "libs/maLibSecurisation.php";
include_once "libs/modele.php";?>
 

<div class="conteneur-onglets">
    <div class="onglets">
        <button class="onglet" onclick="afficherGestionPoints()">Gestion des points de fidélité</button>
        <button class="onglet" onclick="afficherGestionStock()">Gestion des stocks</button>
        <button class="onglet" onclick="afficherStockMin()">Articles en dessous du stock minimal</button>
        <button class="onglet" onclick="deconnexion()">Deconnexion</button>
        <!-- Ajoutez d'autres boutons pour les autres fonctionnalités -->
    </div>

    <div id="gestionPoints" class="contenu-onglet">





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
    </div></br></br>
       
    </div> 
    <div id="gestionStockMin" class="contenu-onglet">
    <div id="stockMin">
        <p> Articles en dessous du stock minimal :</p> </br></br>
        <div id='urgence'>

            <?php
            $listeStock = stockInferieurMinim();

            // Vérifier si $listeStock est un tableau et s'il contient des éléments
            if (is_array($listeStock) && count($listeStock) > 0) {
                foreach ($listeStock as $produit) {
                    $stock = $produit['quantite'];
                    $stockMin = $produit['quantite_min'];
                    if ($stock <$stockMin) {
                        echo "Le produit " . $produit['id_produit'] . " est en dessous du stock minimal: </br> Stock actuel: " . $stock . " Stock minimal: " . $stockMin . "</br>";
                        echo "</br>";
                    }
                }
            } else {
                echo "Aucun produit trouvé en dessous du stock minimal.";
            }
            ?>
        </div>


    </div></br></br></br>

    </div>








    <div id="gestionStock" class="contenu-onglet">
       
    <div id="promotionContainer">
        <label for="promotionInput"> Modifier la promotion pour les éléments sélectionnés: </label></br></br>
        <input type="number" id="promotionInput" min="0" max="100" step="0.5" value="0">
        <button id="applyPromotion" class="btn2">Appliquer</button>
    </div></br></br></br>
<div> 
    <!-- Ajoutez un titre -->
    <p>Gestion des stocks</p>

    <div id="searchContainer">
        <input type="text" id="searchInput" placeholder="Rechercher">
    </div>

    <!-- Ajoutez un conteneur pour le tableau -->
    <div id="tableContainer">
        <table id="simpleTable">
            <thead>
                <tr>
                    <th><input type="checkbox" id="selectAll">Sélectionner</th>
                    <th data-colonne="Id" data-sort="int">
                        Identifiant <span id="iconeTriId"></span>
                    </th>
                    <th> Image</th>
                    <th data-colonne="NumSerie" data-sort="string">
                        Numéro de
                        série <span id="iconeTriNumSerie"></span></th>
                    <th data-colonne="Designation" data-sort="string">Désignation <span id="iconeTriDesignation"></span>
                    </th>
                    <th data-colonne="PrixHT" data-sort="float">Prix
                        HT (Dhs)<span id="iconeTriPrixHT"></span>
                    </th>
                    <th data-colonne="PrixTTC" data-sort="float">
                        Prix TTC (Dhs)<span id="iconeTriPrixTTC"></span>
                    </th>
                    <th data-colonne="Stock" data-sort="int">Stock
                        <span id="iconeTriStock"></span>
                    </th>
                    <th data-colonne="Promotion" data-sort="float">
                        Promotion (%) <span id="iconeTriPromotion"></span></th>

                    <th data-colonne="StockVendu">Quantité vendue </th>
                    <th data-colonne="quantiteAchetee">Quantité achetée </th>
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
                        <td data-sort-value="<?php echo $produit['num_serie']; ?>"><input type="text" class="editable"
                                data-id="<?php echo $produit['id_produit']; ?>" data-colonne="num_serie"
                                value="<?php echo $produit['num_serie']; ?>"></td>
                        <td data-sort-value="<?php echo $produit['designation']; ?>"><input type="text" class="editable"
                                data-id="<?php echo $produit['id_produit']; ?>" data-colonne="designation"
                                value="<?php echo $produit['designation']; ?>"></td>
                        <td data-sort-value="<?php echo $prixHT; ?>"> <input type="text" class="editable"
                                data-id="<?php echo $produit['id_produit']; ?>" data-colonne="prix_ht"
                                value="<?php echo $prixHT; ?>"></td>
                        <td data-sort-value="<?php echo $prixTTC; ?>"><input type="text" class="editable"
                                data-id="<?php echo $produit['id_produit']; ?>" data-colonne="prix_ttc"
                                value="<?php echo $prixTTC; ?>"></td>
                        <td data-sort-value="<?php echo $stock; ?>"><input type="text" class="editableStock"
                                data-id="<?php echo $produit['id_produit']; ?>" data-colonne="stock"
                                value="<?php echo $stock; ?>"></td>
                        <td data-sort-value="<?php echo $produit['promotion']; ?>"><input type="text" class="editable"
                                data-id="<?php echo $produit['id_produit']; ?>" data-colonne="promotion"
                                value="<?php echo $produit['promotion']; ?>"></td>
                        <td> <input type="text" class="stockVendu" data-id="<?php echo $produit['id_produit']; ?>"
                                data-colonne="stock_vendu" value=0></td>
                        <td> <input type="text" class="stockAchete" data-id="<?php echo $produit['id_produit']; ?>"
                                data-colonne="quantiteAchetee" value=0></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>


        </table>
    </div>
    


</div>
    </div>

   

</div>








<div id="deco" class="contenu-onglet"> 
<form action="controleur.php" method="post">
    <input type="hidden" name="action" value="Logout">
    <button class="btn2" type="submit">Déconnexion</button>
</form>
</div>




<!-- Ajoutez ceci à votre JavaScript -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="stupidtable.min.js"></script>
<script>

    // Fonctions pour afficher les différents contenus d'onglet
    function afficherGestionPoints() {
        document.getElementById("gestionPoints").style.display = "block";
        document.getElementById("gestionStock").style.display = "none";
        document.getElementById("gestionStockMin").style.display = "none";
        document.getElementById("deco").style.display = "none";
        //on met l'onglet en surbrillance jaune
        document.getElementsByClassName("onglet")[0].style.backgroundColor = "#ffcc00";
        document.getElementsByClassName("onglet")[1].style.backgroundColor = "#f0f0f0";
        document.getElementsByClassName("onglet")[2].style.backgroundColor = "#f0f0f0";
        document.getElementsByClassName("onglet")[3].style.backgroundColor = "#f0f0f0";
    }

    function afficherGestionStock() {
        document.getElementById("gestionStock").style.display = "block";
        document.getElementById("gestionPoints").style.display = "none";
        document.getElementById("gestionStockMin").style.display = "none";
        document.getElementById("deco").style.display = "none";
        document.getElementsByClassName("onglet")[0].style.backgroundColor = "#f0f0f0";
        document.getElementsByClassName("onglet")[1].style.backgroundColor = "#ffcc00";
        document.getElementsByClassName("onglet")[2].style.backgroundColor = "#f0f0f0"; 
        document.getElementsByClassName("onglet")[3].style.backgroundColor = "#f0f0f0";
    }

    function afficherStockMin() {
        document.getElementById("gestionStockMin").style.display = "block";
        document.getElementById("gestionStock").style.display = "none";
        document.getElementById("gestionPoints").style.display = "none";
        document.getElementById("deco").style.display = "none";
        document.getElementsByClassName("onglet")[0].style.backgroundColor = "#f0f0f0";
        document.getElementsByClassName("onglet")[1].style.backgroundColor = "#f0f0f0";
        document.getElementsByClassName("onglet")[2].style.backgroundColor = "#ffcc00";
        document.getElementsByClassName("onglet")[3].style.backgroundColor = "#f0f0f0";
        
    }
    function deconnexion() {
        document.getElementById("gestionStockMin").style.display = "none";
        document.getElementById("gestionStock").style.display = "none";
        document.getElementById("gestionPoints").style.display = "none";
        document.getElementById("deco").style.display = "block";
        document.getElementsByClassName("onglet")[0].style.backgroundColor = "#f0f0f0";
        document.getElementsByClassName("onglet")[1].style.backgroundColor = "#f0f0f0";
        document.getElementsByClassName("onglet")[2].style.backgroundColor = "#f0f0f0";
        document.getElementsByClassName("onglet")[3].style.backgroundColor = "#ffcc00";
    }


    // Par défaut, afficher le contenu de la première fonctionnalité au chargement de la page
    afficherStockMin();


    $(document).ready(function () {
        // Écouteur d'événement pour le champ de recherche
        $('#searchInput').on('input', function () {
            var searchTerm = $(this).val().toLowerCase(); 

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
    $(document).ready(function () {
        // Désactiver les champs de saisie lors du tri
        $("#simpleTable").on("beforetablesort", function () {
            $('.editable').prop('readonly', true);
        });

        // Activer le tri sur le tableau
        $("#simpleTable").stupidtable();

        // Réactiver les champs de saisie après le tri
        $("#simpleTable").on("aftertablesort", function () {
            $('.editable').prop('readonly', false);
        });
    });





    $(document).ready(function () {
        // Gestion de l'édition des cellules
        $('.editable').click(function () {
            var id = $(this).data('id'); 
            var contenu = $(this).val(); 

        });

        // Enregistrement des modifications lors de l'appui sur "Entrée"
        $(document).on('keydown', '.editable', function (e) {
            if (e.key === 'Enter') { 
                var id = $(this).data('id'); 
                var newValue = $(this).val(); 
                $(this).val(newValue);
                $(this).blur(); 

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
            if (newPromotion < 0 || newPromotion > 100) {
                alert("La promotion doit être comprise entre 0 et 100");
                return;
            }

            // Récupérer les éléments sélectionnés
            var selectedProducts = $('input[name="selection[]"]:checked');

            // Parcourir les éléments sélectionnés et mettre à jour leurs promotions
            selectedProducts.each(function () {
                var productId = $(this).val(); 

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
        $('#searchInputClient').on('input', function () {
            var searchTerm = $(this).val().toLowerCase(); 
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
            var contenu = $(this).val(); 

        });

        $('.pointDepense').click(function () {
            var id = $(this).data('id'); 
            var contenu = $(this).val(); 

        });

        // Enregistrement des modifications lors de l'appui sur "Entrée"
        $(document).on('keydown', '.editablePoints', function (e) {
            if (e.key === 'Enter') { 
                var id = $(this).data('id'); 
                var newValue = $(this).val(); 
                var points = $(this).closest('tr').find('.pointsFidelite').text(); 


                // Convertir la valeur en entier pour effectuer des opérations mathématiques
                points = parseFloat(points); 
                //100 Dhs=1 point
                newValue = newValue / 100; 
                // Calculer le nouveau total des points de fidélité
                var total = points + parseFloat(newValue); 
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
                var id = $(this).data('id'); 
                var newValue = $(this).val(); 
                var points = $(this).closest('tr').find('.pointsFidelite').text(); 


                // Convertir la valeur en entier pour effectuer des opérations mathématiques
                points = parseFloat(points); 
                // Calculer le nouveau total des points de fidélité
                var total = points - parseFloat(newValue); 
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

    $(document).ready(function () {
        // Gestion de l'édition des cellules
        $('.stockVendu').click(function () {
            var id = $(this).data('id'); 
            var contenu = $(this).val(); 

        });


        $(document).on('keydown', '.stockVendu', function (e) {
            if (e.key === 'Enter') { 
                var id = $(this).data('id');
                var newValue = $(this).val();
                
                // Récupérer le stock initial
                var stockInitial = $(this).closest('tr').find('.editableStock').val();
                stockInitial = parseInt(stockInitial); 

                // Calculer le nouveau stock disponible
                var nouveauStock = stockInitial - parseInt(newValue); // Convertir en flottant 
                if (nouveauStock < 0) {
                    alert("Le stock vendu ne peut pas dépasser le stock disponible");
                    return;
                }

                $(this).closest('tr').find('.editableStock').val(nouveauStock);
                $(this).blur();
                // Envoyer la modification au serveur
                $.ajax({
                    url: 'controleur.php?action=modifier_produit',
                    type: 'POST',
                    data: {
                        id: id,
                        colonne: 'stock',
                        valeur: nouveauStock
                    },
                    success: function (data) {
                    },
                    error: function (error) {
                    }
                });
            }
        });
    });

    $(document).ready(function () {
        // Gestion de l'édition des cellules
        $('.editableStock').click(function () {
            var id = $(this).data('id'); 
            var contenu = $(this).val(); 

        });

        // Enregistrement des modifications lors de l'appui sur "Entrée"
        $(document).on('keydown', '.editableStock', function (e) {
            if (e.key === 'Enter') { 
                var id = $(this).data('id'); 
                var newValue = $(this).val(); 
                $(this).val(newValue);
                $(this).blur(); 

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
        // Gestion de l'édition des cellules
        $('.stockAchete').click(function () {
            var id = $(this).data('id'); 
            var contenu = $(this).val(); 

        });


        $(document).on('keydown', '.stockAchete', function (e) {
            if (e.key === 'Enter') { 
                var id = $(this).data('id'); 
                var newValue = $(this).val(); 

                // Récupérer le stock initial
                var stockInitial = $(this).closest('tr').find('.editableStock').val();
                stockInitial = parseInt(stockInitial); 

                // Calculer le nouveau stock disponible
                var nouveauStock = stockInitial + parseInt(newValue); // Convertir en flottant 

                $(this).closest('tr').find('.editableStock').val(nouveauStock);
                $(this).blur();
                // Envoyer la modification au serveur
                $.ajax({
                    url: 'controleur.php?action=modifier_produit',
                    type: 'POST',
                    data: {
                        id: id,
                        colonne: 'stock',
                        valeur: nouveauStock
                    },
                    success: function (data) { 
                        // Gérer la réponse ou la mise à jour de l'interface utilisateur si nécessaire
                    },
                    error: function (error) {
                        console.error('Erreur lors de la mise à jour du stock pour le produit avec l\'ID ' + id);
                        // Gérer les erreurs éventuelles
                    }
                });
            }
        });
    });


</script>