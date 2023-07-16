<?php
require_once('../includes/config.php'); 

$request2 = $bdd->prepare("SELECT * FROM articles");
$request2->execute();
$result2 = $request2->fetchAll(PDO::FETCH_ASSOC);
$json2 = json_encode($result2);
echo $json2;
