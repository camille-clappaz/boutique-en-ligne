<?php
require_once('../classes/User.php');
require_once('../classes/Adresse.php');
require_once('../includes/config.php');
//ob_start('ob_gzhandler');
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorie</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/header.css">
    <link rel="stylesheet" type="text/css" href="../css/categorie.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/e1a1b68f9b.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap" rel="stylesheet">
</head>

<body>
    <?php require_once('../includes/header2.php');
     ?>
    <main>
        <?php
        $req = $bdd->prepare('SELECT * FROM `categorie`');
        $req->execute();
        $result = $req->fetchAll(PDO::FETCH_ASSOC);

        ?>
        <div id="container">
            <form action="" method="get">
                <!-- ici y'avais le fichier testcateg.php -->
            </form>
            <div id="allItems">
            </div>
        </div>
    </main>
    <script src="../js/affichageCateg.js" defer></script>
    <script src="../js/autocompletion.js" defer></script>
    <script src="../js/fonction.js" defer></script>
</body>

</html>