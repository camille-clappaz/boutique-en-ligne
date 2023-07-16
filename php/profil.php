<?php
require_once('../classes/User.php');
require_once('../classes/Adresse.php');
require_once('../includes/config.php');
ob_start('ob_gzhandler'); //si il y a un pb essayer avec ob_start()


?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link rel="stylesheet" type="text/css" href="../css/profil.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/header.css">
    <script src="../js/favoris.js" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/e1a1b68f9b.js" crossorigin="anonymous"></script>
    <script src="../js/autocompletion.js" defer></script>
    <script src="../js/fonction.js" defer></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap" rel="stylesheet">
</head>

<body>
    <?php require_once('../includes/header2.php'); ?>
    <main>
        <h1>Profil</h1>
        <?php $user = new User($_SESSION['user']['id'], $_SESSION['user']['email'], $_SESSION['user']['password'], $_SESSION['user']['firstname'], $_SESSION['user']['lastname'], '', '');

        if ($user->selectAvatar($bdd) == "default.png") { ?>
            <img id="imageProfil" src="avatars/default.png">
        <?php } else { ?>
            <img id="imageProfil" src="avatars/<?= $_SESSION['user']['id'] . "." . $user->selectAvatar($bdd) ?>">
        <?php }
        ?>

        <h3><?= $user->getFirstname() . " " . $user->getLastname() ?></h3>
        <p><?= $user->getEmail() ?></p>

        <div class="editprofil">
            <a href="profiledit.php"><button class="button">Editer mon profil</button></a>
            <a href="deconnexion.php"><button class="button">Se déconnecter</button></a>
        </div>

        <div id="adresse">
            <h3>Adresse de livraison : </h3>
            <?php $adresse = new Adresse($_SESSION['user']['id'], '', '', '', '', '', '');
            echo $adresse->isExisting($bdd);
            if ($adresse->itExist($bdd)) {
                echo ' <a href="inscriptionAdresse.php"><button class="buttonAdresse">Modifier l\'adresse</button></a>';
            ?>
                <form method="POST">
                    <input type="submit" name="delete" value="Supprimer l'adresse">
                </form>

            <?php
                if (isset($_POST['delete'])) {
                    $adresse->deleteAdresse($bdd);
                    header('Location:profil.php');
                }
            } ?>
        </div>

        <div>
            <h3>Commandes passées:</h3>
            <div>
                <?php $request = $bdd->prepare('SELECT * FROM commande WHERE id_user = ?');
                $request->execute([$_SESSION['user']['id']]);
                $result = $request->fetchAll(PDO::FETCH_ASSOC);
                if ($result == null) {
                    echo "Vous n'avez pas encore passé de commande.";
                } else {
                    foreach ($result as $commande) {
                        $dateCommande = explode("-", $commande['date']);
                        $date = $dateCommande[2] . " / " . $dateCommande[1] . " / " . $dateCommande[0];
                        $idCommande = $commande['id'];
                        // Récupérer les informations de l'article depuis la base de données
                        $request2 = $bdd->prepare('SELECT * FROM commande INNER JOIN commandpanier ON commande.id = commandpanier.id_commande INNER JOIN articles ON commandpanier.id_article = articles.idArt WHERE id_user = ? AND commande.id = ?');
                        $request2->execute([$_SESSION['user']['id'], $idCommande]);
                        $result2 = $request2->fetchAll(PDO::FETCH_ASSOC);
                        echo "</br>Commande passée le : " . $date . " - Total : " . $commande['prixTotal'] . "€</br>
                        Livré à : " . $commande['adresse'] . "<br>Numero de Tel : " . $commande['phone'] . "</span></br>";
                        echo "<div class='commande'>";
                        foreach ($result2 as $key) {
                            echo "<a class='produit' href='detail.php?article_id=" . $key['idArt'] . "'><span class='badgeqtt'>" . $key['quantite_art'] . "</span><span><img src='" . $key['imgArt'] . " '></span></a>";
                        }
                        echo "</div>";
                    }
                }
                ?>
            </div>
        </div>
    </main>

</body>

</html>