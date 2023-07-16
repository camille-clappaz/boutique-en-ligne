<?php
$urlPHP = "http://localhost/boutique-en-ligne/php/";


?>

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
            <img class="logoFooter" src="../maquette/logo-removebg.png" alt="">
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