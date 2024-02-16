<?php

include_once "libs/maLibSQL.pdo.php";

/*
Dans ce fichier, on définit diverses fonctions permettant de récupérer des données utiles pour notre site web.
*/


/********* fonctions pour utiliser la base de données *********/


/* Vérifie l'identité d'un utilisateur dans la base de données
 * Paramètres :
 * - $pseudo : string - Le pseudo de l'utilisateur
 * - $mot_de_passe : string - Le mot de passe de l'utilisateur
 * Retour :  int|string - L'ID de l'utilisateur si succès, sinon false */
function verifUserBdd($pseudo, $mdp)
{
    $SQL = "SELECT id_user FROM users WHERE mail='$pseudo' OR num_telephone ='$pseudo' AND passwd='$mdp'";
    return SQLGetChamp($SQL);
}

function creer_compte($nom, $prenom, $passe, $num, $mail)
{
    //on hash le mdp
    $passe = password_hash($passe, PASSWORD_DEFAULT);
    //on insère les données dans la base de données
    $sql = "INSERT INTO users (nom, prenom,mail,num_telephone,points_fidelite, passwd, id_role)
		  VALUES ('$nom','$prenom','$mail','$num',0, '$passe',2)";
    SQLInsert($sql);
}

function recupRole($id)
{
    $sql = "SELECT id_role FROM users WHERE id_user = '$id'";
    return SQLGetChamp($sql);
}

function listeEmployes()
{
    $sql = "SELECT id_user, nom, prenom, adresse,mail, num_telephone, points_fidelite, roles.nom_role,users.id_role FROM users JOIN roles ON users.id_role = roles.id_role
    WHERE users.id_role =1 ";
    return parcoursRs(SQLSelect($sql));
}

function creer_produit($designation, $image, $num_serie, $prix, $description, $datasheet, $id_marque, $id_categorie)
{
    $sql = "INSERT INTO produit (designation, image_prod, num_serie, prix_unitaire, descriptif_produit, datasheet, id_marque, id_cat)
          VALUES ('$designation','$image','$num_serie','$prix','$description','$datasheet','$id_marque','$id_categorie')";
    return SQLInsert($sql);
}
function creer_stock($stock, $id)
{
    $sql = "INSERT INTO stock (quantite, quantite_min, id_produit) VALUES ('$stock',0,'$id')";
    return SQLInsert($sql);
}

function listeCategories()
{
    $sql = "SELECT id_cat, nom_cat, descriptif_cat,image_cat,sous_cat FROM categorie";
    return parcoursRs(SQLSelect($sql));
}

function listeMarques()
{
    $sql = "SELECT id_marque, nom_marque, origine,informations FROM marque";
    return parcoursRs(SQLSelect($sql));
}



function creer_marque($nom, $origine, $infos)
{
    $sql = "INSERT INTO marque (nom_marque, origine, informations)
          VALUES ('$nom','$origine','$infos')";
    return SQLInsert($sql);

}

function creer_categorie($nom, $desc, $image, $sous_cat)
{
    $sql = "INSERT INTO categorie (nom_cat, descriptif_cat, image_cat, sous_cat)
          VALUES ('$nom','$desc','$image','$sous_cat')";
    return SQLInsert($sql);
}

function creer_categorieMere($nom, $desc, $image)
{
    $sql = "INSERT INTO categorie (nom_cat, descriptif_cat, image_cat)
          VALUES ('$nom','$desc','$image')";
    return SQLInsert($sql);
}

function listeProduits()
{
    $sql = "SELECT id_produit, designation, image_prod, num_serie, prix_unitaire,promotion,descriptif_produit,nom_marque
    FROM produit JOIN marque ON produit.id_marque = marque.id_marque";
    return parcoursRs(SQLSelect($sql));
}

function supprimer_stock($id)
{
    $sql = "DELETE FROM stock WHERE id_produit = '$id'";
    SQLDelete($sql);
}
function stockProduit($id)
{
    $sql = "SELECT quantite FROM stock WHERE id_produit = '$id'";
    return SQLGetChamp($sql);
}

function modifierProduit($id, $colonne, $valeur)
{
    $sql = "UPDATE produit SET $colonne = '$valeur' WHERE id_produit = '$id'";
    SQLUpdate($sql);
}

function modifierStock($id, $valeur)
{
    $sql = "UPDATE stock SET quantite = '$valeur' WHERE id_produit = '$id'";
    SQLUpdate($sql);
}

/* Vérifie si un num existe dans la base de données
 * Paramètres :
 * - $pseudo : string - Le pseudo à vérifier
 * Retour :  string - Le pseudo si trouvé, sinon false */
function verifnum($num)
{
    $sql = "SELECT id_user
		  FROM users
		  WHERE num_telephone = '$num'";
    return SQLGetChamp($sql);
}

function supprimer_produit($id)
{
    $sql = "DELETE FROM produit WHERE id_produit = '$id'";
    SQLDelete($sql);
}



/* Valide une adresse e-mail
 * Paramètres :
 * - $email : string - L'adresse e-mail à valider
 * Retour : bool - true si l'adresse est valide, sinon false */
function validateMail($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function verifMdp($mdp)
{
    return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{8,}$/', $mdp);

}

// HOMEPAGE


function getProduits() {
    $sql = "SELECT id_produit, designation, image_prod, prix_unitaire FROM produit";
    $result = SQLSelect($sql);
    return parcoursRs($result); // Utilisez la fonction parcoursRs pour convertir l'objet PDOStatement en tableau associatif
}

function getQuantite($idProduit){
    $sql = "SELECT quantite FROM stock WHERE id_produit = '$idProduit'";
    $result = SQLSelect($sql);
    return getQuantiteFromResult($result); // Utilisez une fonction dédiée pour extraire la quantité du résultat
}

function getQuantiteMin($idProduit){
    $sql = "SELECT quantite_min FROM stock WHERE id_produit = '$idProduit'";
    $result = SQLSelect($sql);
    return getQuantiteMinFromResult($result); // Utilisez une fonction dédiée pour extraire la quantité minimale du résultat
}

function getQuantiteFromResult($result) {
    if ($result && $result->rowCount() > 0) {
        $row = $result->fetch(PDO::FETCH_ASSOC);
        return $row['quantite'];
    } else {
        return 0; // ou une valeur par défaut, selon votre logique
    }
}
function getQuantiteMinFromResult($result) {
    if ($result && $result->rowCount() > 0) {
        $row = $result->fetch(PDO::FETCH_ASSOC);
        return $row['quantite_min'];
    } else {
        return 0; // ou une valeur par défaut, selon votre logique
    }
}

function getCategorieMere(){
    $sql = "SELECT id_cat, nom_cat, descriptif_cat, image_cat FROM categorie WHERE sous_cat IS NULL";
    $result = SQLSelect($sql);
    return parcoursRs($result);
}
function getCategorieMereNom($idCategorie){
    $sql = "SELECT nom_cat FROM categorie WHERE id_cat = '$idCategorie'";
    $result = SQLSelect($sql);
    return parcoursRs($result);
}

function getCategorieMereImage($idCategorie){
    $sql = "SELECT image_cat FROM categorie WHERE id_cat = '$idCategorie'";
    $result = SQLSelect($sql);
    return parcoursRs($result);
}

function getSousCategorie($idCategorie){
    $sql = "SELECT id_cat, nom_cat, descriptif_cat, image_cat FROM categorie WHERE sous_cat = '$idCategorie'";
    $result = SQLSelect($sql);
    return parcoursRs($result);
}

function getProduitById($idProduit){
    $sql = "SELECT designation, image_prod, prix_unitaire, num_serie, descriptif_produit, datasheet, id_cat, id_marque, promotion FROM produit WHERE id_produit = '$idProduit'";
    $result = SQLSelect($sql);
    return parcoursRs($result);
}

function getProduitByCat($idCategorie){
    $sql="SELECT designation, image_prod FROM produit WHERE id_cat = '$idCategorie' ";
    $result = SQLSelect($sql);
    return parcoursRs($result);
}

?>

