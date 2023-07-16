<?php
require_once('../classes/Categorie.php');
require_once('../classes/SousCategorie.php');
require_once('../classes/Article.php');
require_once('../includes/config.php');


if ($_SESSION["user"]["email"] == "admin@admin.fr") {
    if (password_verify("Admin1902", $_SESSION["user"]["password"])) {
        ob_start();

?>
        <!DOCTYPE html>
        <html lang="fr">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Panel Admin</title>
            <link rel="stylesheet" type="text/css" href="../css/style.css">
            <link rel="stylesheet" type="text/css" href="../css/header.css">
            <link rel="stylesheet" type="text/css" href="../css/footer.css">
            <link rel="stylesheet" type="text/css" href="../css/panelAdmin.css">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
            <script src="https://kit.fontawesome.com/020a26a846.js" crossorigin="anonymous"></script>
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap" rel="stylesheet">
            <script src="../js/autocompletion.js" defer></script>
            <script src="../js/fonction.js" defer></script>
        </head>

        <body>
            <?php require_once('../includes/header2.php');
            ?>
            <main id="panelAdmin">
                <div class="sticky">
                    <a href="http://localhost/boutique-en-ligne/php/panelAdmin#modifCar">Gestion du Carousel</a>
                    <a href="http://localhost/boutique-en-ligne/php/panelAdmin#creaCat">Gestion des catégories</a>
                    <a href="http://localhost/boutique-en-ligne/php/panelAdmin#souscreaCat">Gestion des sous-catégories</a>
                    <a href="http://localhost/boutique-en-ligne/php/panelAdmin#creaArt">Gestion des articles</a>
                </div>
                <br>
                <span id="modifCar"></span>
                <div id="modifCarouselIndex">
                    <h2>Modification du Carousel de l'index</h2>
                    <br>
                </div>
                <span id="creaCat"></span><br>
                <h2>Gestion des catégories</h2><br>
                <div id="categories">
                    <div id="formCat">
                        <form action="" method="POST">
                            <input type="text" name="titreCat" id="" placeholder="Nom de la catégorie"><br>
                            <input type="text" name="imgCat" id="" placeholder="URL de l'image"><br>
                            <button id="creerCat" type="submit" name="creerCat">Créer la catégorie</button><br>
                        </form>
                    </div><br>
                </div>
                <span id="souscreaCat"></span><br>
                <h2>Gestion des sous-catégories</h2><br>
                <div id="sousCategories">
                    <div id="formSousCat">
                        <form action="" method="POST">
                            <input type="text" name="titreSousCat" id="" placeholder="Nom de la sous-catégorie">
                            <input type="text" name="imgSousCat" id="" placeholder="URL de l'image">
                            <select name="categorie" id="categorie-select" value="categorie">
                                <option selected disabled>Catégorie</option>
                            </select>
                            <button id="creerSousCat" ype="submit" name="creerSousCat">Créer la sous-catégorie</button>
                        </form>
                    </div><br>
                </div>
                <span id="creaArt"></span><br>
                <h2>Gestions des articles</h2><br>
                <div id="articles">
                    <div id="formArtPromo">
                        <div id="formArt">
                            <form action="" method="POST">
                            <h4>Création d'article:</h4>
                            <br>
                                <input type="text" name="titreArt" id="" placeholder="Nom de l'article">
                                <textarea name="description" id="" placeholder="Description"></textarea>
                                <input type="text" name="prix" id="" placeholder="Prix de l'article €">
                                <input type="text" name="promotion" id="" placeholder="Promotion %">
                                <select name="categories" id="categories-select" value="categorie">
                                    <option selected disabled>Catégorie</option>
                                </select>
                                <select name="sousCategories" id="sousCategories-select" value="sousCategorie">
                                    <option selected disabled>Sous-catégorie</option>
                                </select>
                                <input type="text" name="quantite" id="" placeholder="Quantité">
                                <input type="text" name="imgArt" id="" placeholder="URL de l'image">
                                <button id="creerArt" type="submit" name="creerArt">Créer l'article</button>
                            </form>
                        </div><br>

                        <div id="formPromo">
                           
                            <form action="" method="post">
                            <h4>Création de code promo:</h4>
                            <br>
                                <input type="text" name="code" id="" placeholder="Nom du code promo">
                                <input type="text" name="valeur" id="" placeholder="Valeur du code promo %">
                                <input type="date" name="date" id="date">
                                <button id="creerPromo" type="submit" name="créerCodePromo">Créer le Code Promo</button>
                            </form>
                        </div><br>
                    </div>
                </div><br>
                <?php
                // CREATION DE CATEGORIES
                if (isset($_POST["creerCat"])) {
                    $titreCat = htmlspecialchars($_POST['titreCat']);
                    $imgCat = htmlspecialchars($_POST['imgCat']);
                    $categorie = new Categorie($titreCat, $imgCat);
                    $categorie->addCategorie($bdd);
                    header("Location:panelAdmin.php");
                    // Evite qu'en rechargeant la page on recrée la même cat.
                }
                if (isset($_POST["creerSousCat"])) {
                    $titreSousCat = htmlspecialchars($_POST['titreSousCat']);
                    $imgSousCat = htmlspecialchars($_POST['imgSousCat']);
                    $idParent = htmlspecialchars($_POST['categorie']);
                    $souscategorie = new SousCategorie($titreSousCat, $imgSousCat, $idParent);
                    $souscategorie->addSousCategorie($bdd);
                    header("Location:panelAdmin.php"); // Evite qu'en rechargeant la page on recrée la même cat.
                }
                if (isset($_POST["creerArt"])) {
                    $titreArt = htmlspecialchars($_POST['titreArt']);
                    $description = htmlspecialchars($_POST['description']);
                    $promo = htmlspecialchars($_POST['promotion']);
                    $prix = htmlspecialchars($_POST['prix']);
                    if ($promo != 0) {
                        $prix = $prix - (($promo * $prix) / 100);
                    }
                    $date = date('Y/m/d');
                    $categories = htmlspecialchars($_POST['categories']);
                    $quantite = htmlspecialchars($_POST['quantite']);
                    $sousCategories = htmlspecialchars($_POST['sousCategories']);
                    $imgArt = htmlspecialchars($_POST['imgArt']);
                    if (($sousCategories != "Sous-catégorie") && ($categories != "Catégorie")) {
                        $article = new Article($titreArt, $description, $prix, $date, $categories, $sousCategories, $quantite, $imgArt, $promo);
                        $article->addArticle($bdd);
                        header("Location:panelAdmin.php"); // Evite qu'en rechargeant la page on recrée la même cat.
                    }
                }
                if (isset($_POST["créerCodePromo"])) {
                    $dateActuelle = date("Y-m-d");
                    $code = htmlspecialchars($_POST['code']);
                    $valeur = htmlspecialchars($_POST['valeur']);
                    $date = htmlspecialchars($_POST['date']);
                    // if ($date> $dateActuelle) { // si la date n'est pas dans le passé
                    $addCode = $bdd->prepare('INSERT INTO `codepromo`(`code`, `valeur`, `date_expiration`) VALUES(?,?,?)');
                    $addCode->execute([$code, $valeur, $date]);
                    header("Location:panelAdmin.php");

                    // } else {
                    //     $message = "Vous ne pouvez pas choisir une date deja passée !";
                    // }
                }
                ?>
            </main>
            <script src="../js/panelAdmin.js"></script>
            <?php
            require_once('../includes/footer.php'); ?>
        </body>
<?php
    }
} else {
    header("Location:../index.php");
}
?>

        </html>