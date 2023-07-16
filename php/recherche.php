<?php

require("../includes/config.php");


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $requete = $bdd->prepare('SELECT * FROM articles 
INNER JOIN souscategorie  ON souscategorie.id = articles.id_sousCategorie
INNER JOIN categorie ON categorie.idCat=souscategorie.id_parent WHERE articles.idArt=:id');
    $requete->execute(array('id' => $id));
    $result = $requete->fetch(PDO::FETCH_ASSOC);
}

if (isset($_GET["all"])) {
    if ($_GET["all"] == 1) {
        $requete = $bdd->prepare('SELECT * FROM articles 
INNER JOIN souscategorie  ON souscategorie.id = articles.id_sousCategorie
INNER JOIN categorie ON categorie.idCat=souscategorie.id_parent');
        $requete->execute();
        $result = $requete->fetchAll(PDO::FETCH_ASSOC); // IMPORTANT fetchAll pour afficher plusieurs trucs, si fetch ça n'affiche que le premier resultat
    }
}

if (isset($_GET["panelAdmin"])) {
    if ($_GET["panelAdmin"] == 1) {
        $requete = $bdd->prepare('SELECT * FROM categorie');
        $requete->execute();
        $result = $requete->fetchAll(PDO::FETCH_ASSOC); // IMPORTANT fetchAll pour afficher plusieurs trucs, si fetch ça n'affiche que le premier resultat
    }
}

if (isset($_GET["sousCat"])) {
    if ($_GET["sousCat"] == 1) {
        $requete = $bdd->prepare('SELECT * FROM souscategorie');
        $requete->execute();
        $result = $requete->fetchAll(PDO::FETCH_ASSOC); // IMPORTANT fetchAll pour afficher plusieurs trucs, si fetch ça n'affiche que le premier resultat
    }
}
if (isset($_GET["carousel"])) {
    if ($_GET["carousel"] == 1) {
        $requete = $bdd->prepare('SELECT * FROM carousel');
        $requete->execute();
        $result = $requete->fetchAll(PDO::FETCH_ASSOC); // IMPORTANT fetchAll pour afficher plusieurs trucs, si fetch ça n'affiche que le premier resultat
    }
}
echo json_encode($result);
