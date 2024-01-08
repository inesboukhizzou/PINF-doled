CREATE DATABASE IF NOT EXISTS doled;

USE doled;

CREATE TABLE IF NOT EXISTS roles(
    id_role INT PRIMARY KEY AUTO_INCREMENT,
    nom_role VARCHAR(30) NOT NULL,
    description TEXT NOT NULL
);

CREATE TABLE IF NOT EXISTS marque(
    id_marque INT PRIMARY KEY AUTO_INCREMENT,
    nom_marque VARCHAR(30) NOT NULL,
    origine VARCHAR(30) NOT NULL,
    informations TEXT NOT NULL
);


CREATE TABLE IF NOT EXISTS categorie (
    id_cat INT PRIMARY KEY AUTO_INCREMENT,
    nom_cat VARCHAR(30) NOT NULL,    
    descriptif_cat TEXT NOT NULL,
    image_cat VARCHAR(255) NOT NULL,
    sous_cat INT,
    FOREIGN KEY (sous_cat) REFERENCES categorie(id_cat)
);


CREATE TABLE IF NOT EXISTS users (
    id_user INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(30) NOT NULL,
    prenom VARCHAR(30) NOT NULL,
    adresse VARCHAR(255) NOT NULL,
    mail VARCHAR(255) NOT NULL,
    num_telephone INT NOT NULL,
    points_fidelite INT NOT NULL,
    passwd VARCHAR(255) NOT NULL,
    id_role INT,
    FOREIGN KEY (id_role) REFERENCES roles(id_role)
);


CREATE TABLE IF NOT EXISTS produit (
    id_produit INT PRIMARY KEY AUTO_INCREMENT,
    designation VARCHAR(255) NOT NULL,
    image_prod VARCHAR(255) NOT NULL,
    num_serie VARCHAR(255) NOT NULL,
    prix_unitaire INT NOT NULL,
    descriptif_produit TEXT NOT NULL,
    datasheet TEXT NOT NULL,
    id_cat INT,
    id_marque INT,
    FOREIGN KEY (id_marque) REFERENCES marque(id_marque),
    FOREIGN KEY (id_cat) REFERENCES categorie(id_cat)
);


CREATE TABLE IF NOT EXISTS stock(
    quantite INT NOT NULL,
    quantite_min INT NOT NULL,
    id_produit INT,
    FOREIGN KEY (id_produit) REFERENCES produit(id_produit)
);


CREATE TABLE IF NOT EXISTS avis(
    contenu TEXT NOT NULL,
    id_produit INT,
    id_user INT,
    FOREIGN KEY (id_produit) REFERENCES produit(id_produit),
    FOREIGN KEY (id_user) REFERENCES users(id_user)
);


CREATE TABLE IF NOT EXISTS mots_cles(
    mot_cle VARCHAR(30) PRIMARY KEY,
    id_produit INT,
    FOREIGN KEY (id_produit) REFERENCES produit(id_produit)
);


