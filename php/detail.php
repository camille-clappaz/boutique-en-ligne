<?php
require_once('../includes/config.php');
if (isset($_GET['article_id'])) {
?>
    <!DOCTYPE html>
    <html lang="fr" dir="ltr">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Detail</title>
        <link rel="stylesheet" type="text/css" href="../css/detail.css">
        <link rel="stylesheet" type="text/css" href="../css/header.css">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <link rel="stylesheet" type="text/css" href="../css/footer.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/e1a1b68f9b.js" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap" rel="stylesheet">
    </head>

    <body>
        <?php require_once('../includes/header2.php'); ?>
        <main id="mainDetail">
        </main>
        <?php
require_once('../includes/footer.php');

?>

    </body>
    <?php
    if (isset($_SESSION["user"])) {
        if (isset($_POST["ajouterPanier"])) {
            $req2 = $bdd->prepare("SELECT `quantite_art` FROM `panier` WHERE id_article = ?");
            $req2->execute([$_POST["ajouterPanier"]]);
            $res2 = $req2->fetch(PDO::FETCH_ASSOC);
            if ($req2->rowCount() > 0) {
                $req3 = $bdd->prepare("UPDATE `panier` SET `quantite_art`= ? WHERE id_article = ?");
                $req3->execute([$res2["quantite_art"] + 1, $_POST["ajouterPanier"]]);
                echo '<i class="fa-solid fa-circle-check" style="color: #0cad00;"></i> Article ajouté au panier.';
            } else {
                $req = $bdd->prepare("INSERT INTO `panier`(`id_user`, `id_article`, `quantite_art`) VALUES (?,?,?)");
                $req->execute([$_SESSION['user']['id'], $_POST["ajouterPanier"], 1]);
                // $_POST["ajouterPanier"] == id de l'article (jsp ce qu'il fout la)
                echo '<i class="fa-solid fa-circle-check" style="color: #0cad00;"></i> Article ajouté au panier.';
            }
        }
    } else {
        echo "Veuillez vous connecter pour ajouter des articles a vos paniers";
    }

    ?>

    </html>
    
<?php } ?>
<script src="../js/autocompletion.js" defer></script>
<script src="../js/fonction.js" defer></script>
<script src="../js/detail.js" ></script>