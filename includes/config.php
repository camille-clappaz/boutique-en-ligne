<?php
session_start();
    $bdd = new PDO("mysql:host=localhost;dbname=boutique", 'root', '');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // session_start();
    // $bdd = new PDO("mysql:host=localhost:3306;dbname=camille-clappaz_boutique", 'camille-clappaz8', 'HTqRlhcphi81y3#?');
    // $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	// $bdd->exec('SET NAMES utf8');

?>