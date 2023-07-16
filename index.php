<?php
// phpinfo(); // pour chopper les infos version etc de mon php
require_once('classes/User.php');
ob_start(); // contre l'erreur d'header location 


?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CAMYAS Boutique</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
  <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
  <link rel="stylesheet" type="text/css" href="./css/style.css">
  <link rel="stylesheet" type="text/css" href="./css/header.css">
  <link rel="stylesheet" type="text/css" href="./css/footer.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="./css/carousel.css">
  <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/020a26a846.js" crossorigin="anonymous"></script>
  <script src="./js/fonction.js" defer></script>
  <script src="./js/autocompletion.js" defer></script>
  <script src="./js/index.js"></script>
</head>

<body>
  <?php
  require_once('./includes/header2.php'); ?>
  <main id="mainIndex">
    <div id="carouselAutoplaying" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselAutoplaying" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselAutoplaying" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselAutoplaying" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
     
      <div class="carousel-inner">
        <!-- Div qui englobe le carousel qui est crée dynamiquement en JS -->
      </div>
    </div>
    <div class="scroll_bloc hover">
                <h2>Nos nouveautés</h2>
                <article class="scroll_container nouveautes"></article>
            </div>
  </main>

 
  <footer>
    <div class="footers">
    <hr>
    <div class="footerP1">
        <div>
            <p>Livraison offerte <br>A partir de 30€ d’achat</p><br>
            <i class="fa-solid fa-truck fa-2xl"></i>
        </div>
        <div>
            <p> Retours et Remboursement <br> Sous 15 jours</p><br>
            <i class="fa-solid fa-rotate-left fa-2xl"></i>
        </div>
        <div>
            <p>Payement en 3x sans frais <br> Des 80€ d’achat</p><br>
            <i class="fa-solid fa-credit-card fa-2xl"></i>
        </div>
        <div>
            <p>Service Client <br> Pour toute questions
                <br> contactez nous
            </p><br>
            <i class="fa-solid fa-circle-question fa-2xl"></i>
        </div>
    </div>
    <hr>
    <div class="footerP2">
        <div class="reseaulogo">
			<img class="logoFooter" src="./maquette/logo-removebg.png" alt="">
            <p>Retrouvez nous sur nos réseaux</p><br>
            <div class="reseaux">
                <a href="https://www.facebook.com/groups/Software.Engineering.learning" target="_blank"><i class="fa-brands fa-facebook fa-xl"></i></a>
                <a href="https://twitter.com/explore" target="_blank"><i class="fa-brands fa-twitter fa-xl"></i></a>
                <a href="https://www.instagram.com/coding.batch/" target="_blank"><i class="fa-brands fa-instagram fa-xl"></i></a>
                <a href="https://www.pinterest.fr/pin/448671181641299040/" target="_blank"> <i class="fa-brands fa-pinterest fa-xl"></i></a>
                <a href="https://github.com/Yasmine-Amaddah/boutique-en-ligne" target="_blank"><i class="fa-brands fa-github fa-xl"></i></a>

            </div>

        </div>

        <div>
            <h2>NEWSLETTER</h2>
            <p>Recevez notre actualité ainsi que toutes nos offres exclusives.</p>
            <form action="">
                <div class="newsletter">
                    <input type="email" name="email" id="inputNews" placeholder="Entrez votre email">
                    <button type="submit" name="mailNews" id="buttonNews"><i class="fa-regular fa-envelope fa-xl"></i></button>
                </div>
            </form>


        </div>
        <div>
            <h2>CATALOGUE</h2>
            <div id="catFooter">
                <?php
                $displayCat = $bdd->prepare('SELECT * FROM categorie');
                $displayCat->execute();
                $result = $displayCat->fetchAll(PDO::FETCH_ASSOC);
                ?>

                <p><a href="<?= $urlPHP ?>categories.php">Toutes les Categories </a></p>
                <?php foreach ($result as $categorie) {
                    $categorieId = $categorie['idCat'];
                    $categorieNom = $categorie['titreCat']; ?>
                    <p>
                        <a href="<?= $urlPHP ?>categories.php?category=<?= $categorieId ?>"><?= $categorieNom; ?></a><?php } ?>
            </div>
        </div>
    </div>
    <div class="footerP3">
        <p><a href="">Conditions générales de vente </a> / <a href=""> Confidentialité/Cookie </a> / <a href=""> Mentions légales</a></p>
    </div>
    </div>
    <!-- <?php
            //     function sendNews($bdd)
            // {
            //         if (isset($_POST["mailNews"])) {
            $email = htmlspecialchars($_POST['email']);
            //     }
            // }

            ?> -->

</footer>

</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</html>