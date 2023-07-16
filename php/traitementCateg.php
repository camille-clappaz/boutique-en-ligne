<?php
require_once('../includes/config.php');

if (isset($_GET['subCategory'])) {
    $request = $bdd->prepare("SELECT * FROM articles WHERE id_sousCategorie =  ? ");
    $request->execute([$_GET['subCategory']]);
    $result = $request->fetchAll(PDO::FETCH_ASSOC);
    $json = json_encode($result); 
    echo $json;
}

if (isset($_GET['category'])) {
    $request2 = $bdd->prepare("SELECT * FROM articles WHERE id_categorie= ?");
    $request2->execute([$_GET['category']]); 
    $result2 = $request2->fetchAll(PDO::FETCH_ASSOC);
    $json2 = json_encode($result2);
    echo $json2;
}
