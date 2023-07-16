<?php
//require_once('header.php');
require_once('../classes/User.php');
require_once('../classes/Adresse.php');
require_once('../includes/config.php');

// Importation de la bibliothèque Stripe
require_once('../stripe/init.php');
require_once('../includes/keyStripe.php');

// On appelle la méthode statique setApiKey de la classe Stripe se trouvant dans le fichier init.php (dans le dossier Stripe)
\Stripe\Stripe::setApiKey($stripeSecretKey);

ob_start();

$user = new User($_SESSION['user']['id'], '', '', '', '', '', '');
$adresse = new Adresse($_SESSION['user']['id'], '', '', '', '', '', '');
$adresse->isExisting($bdd);

$somme = 0;
$livraison = 4.99;
$prixTotal = 0;
$request = $bdd->prepare('SELECT * FROM `panier` WHERE `id_user` = ?');
$request->execute([$_SESSION['user']['id']]);
$result = $request->fetchAll(PDO::FETCH_ASSOC);

// On crée un tableau vide pour stocker les produits du panier
$products = [];

// Si le panier n'est pas vide
if ($result) {
    // Pour chaque produit dans le panier
    foreach ($result as $productInCart) {
        // On récupère l'id du produit et la quantité dans le panier
        $product_id = $productInCart['id_article'];
        $quantity = $productInCart['quantite_art'];

        // Récupérer les informations de l'article depuis la base de données
        $productRequest = $bdd->prepare('SELECT * FROM `articles` WHERE `idArt` = ?');
        $productRequest->execute([$product_id]);
        $product = $productRequest->fetch(PDO::FETCH_ASSOC);
        $product['quantite'] = $quantity;
        $somme += $product['prix'] * $quantity;

        // On ajoute le produit au tableau des produits
        $products[] = $product;
    }
}
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/header.css">
    <link rel="stylesheet" type="text/css" href="../css/checkout.css">
    <link rel="stylesheet" type="text/css" href="../css/panier.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/e1a1b68f9b.js" crossorigin="anonymous"></script>
    <script src="../js/autocompletion.js" defer></script>
    <script src="../js/fonction.js" defer></script>
    <script src="../js/panier.js" defer></script>
    <script src="https://js.stripe.com/v3/"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap" rel="stylesheet">
    <script>
        // On stocke les produits du panier dans une variable JS pour Stripe
        const cart = {
            products: <?= json_encode($products) ?>,
            user: {
                id: <?= $_SESSION['user']['id'] ?>,
                email: '<?= $_SESSION['user']['email'] ?>',
                phone: '<?= $_SESSION['user']['phoneUser'] ?>',
                adresse: '<?= $adresse->getFirstname() . " " . $adresse->getLastname() . " " . $adresse->getNumero() . " " . $adresse->getRue() . " " . $adresse->getCodePostal() . " " . $adresse->getVille() ?>',
            },
        };
    </script>
    <script src="../js/checkout.js" defer></script>
</head>

<body>
    <?php require_once('../includes/header2.php'); ?>
    <main>
        <h1>Mon Panier</h1>
        <hr id='hr1'>
        <div id="panier">
            <?php
            if (count($products) > 0) { ?>
                <table class="table">
                <!-- on affiche les articles du panier dans une table -->
                    <thead>
                        <tr> 
                            <th scope="col">Article</th>
                            <th scope="col">Titre</th>
                            <th scope="col">Quantité</th>
                            <th scope="col">Prix TTC</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // parcourir les produits du panier
                        foreach ($products as $product) { ?>
                            <tr>
                                <td>
                                    <div class='prduitImgDescri' id="prduitImgDescri<?= $product['idArt'] ?>"><a href='detail.php?article_id=<?= $product['idArt'] ?>'><img src="<?= $product['imgArt'] ?>"></a></div>
                                </td>
                                <td>
                                    <div class='produitPanier'><?= $product['titreArt'] ?>
                                </td>
                                <td> <!-- on met des boutons + et - -->
                                    <div class='qttpanier' id='quantite<?= $product['idArt'] ?>'>
                                        <?php echo "<button name='deleteArt' value=" . $product['idArt'] . "><i class='fa-solid fa-minus fa-sm' style='color: #000000;'></i></button>"; ?>
                                        <?= $product['quantite'] ?>
                                        <?php echo "<form method='POST'><button name='addArt" . $product['idArt'] . "'><i class='fa-solid fa-plus fa-sm' style='color: #000000;'></i></button></form>"; ?>
                                    </div>
                                </td>
                                <td>
                                    <div class='produitPanier'><?= ($product['prix'] * $product['quantite']) . "€" ?>
                                </td>

                                <?php
                                if (isset($_POST["addArt" . $product['idArt']])) {
                                    $reqbtn = $bdd->prepare("UPDATE `panier` SET `quantite_art`= ? WHERE id_article = ?");
                                    $reqbtn->execute([$product['quantite'] + 1, $product['idArt']]);
                                    header('Location:panier.php');
                                } ?>
                            </tr>

                        <?php
                        } ?>
                    </tbody>
                </table>
            <?php

                // $somme c'est le prix AVEC TVA comprise
                $tva = (20 / 100); // on met la TVA toujours a 20% ici
                $prixTva = $somme / (1 + $tva);
                $valeurLimiteeTva = number_format($prixTva, 2); // pour limiter le calcul a 2 chiffres apres la virgule
                $prixTotal = $somme + $livraison;

                echo "<div class='divparent'><span class='prix'><div class='divdebut'>Sous total (hors taxes) : </div><div class='divmilieu'></div><div class='divfin'>" . $valeurLimiteeTva . " €</div></span><br>
                <span class='prix'><div class='divdebut'>TVA : </div><div class='divmilieu'></div><div class='divfin'> 20% </div></span><br>
                <span class='prix'><div class='divdebut'>Frais de livraison : </div><div class='divmilieu'></div><div class='divfin'> 4,99 € </div></span><br>
                <span class='prix'><div class='divdebut'>Total : </div><div class='divmilieu'></div><div class='divfin'>" . ($prixTotal) . " €</div></span></div>";
            } else {
                echo "<p>Panier vide.</p>";
            }
            ?>

            <!-- code promo -->
            
        </div>
        <div class="infopaiement">
            <div class="infoflex1">
                <div class="lalivraison"><span class="petitTitre">Adresse de livraison :</span><br>
                    <?php
                    if ($adresse->itExist($bdd)) {
                        $adresseCommande = $adresse->isExisting($bdd);
                        echo $adresseCommande . '<br><a href="inscriptionAdresse.php"><button class="buttonAdresse">Modifier l\'adresse</button></a>';
                    } else {
                        echo $adresse->isExisting($bdd);
                    }
                    ?>
                </div>

                <div class="letelephone"><spanspan class="petitTitre">Numero de téléphone :</span><br>
                    <?php
                    if ($user->isPhoneExist($bdd)) {
                        $phoneCommande = $user->selectPhoneNumber($bdd);
                        echo $phoneCommande;
                    } else { ?>
                        <form method="POST">
                            <input type="tel" id="phone" name="phone" pattern="[0-9]{2} [0-9]{2} [0-9]{2} [0-9]{2} [0-9]{2}" placeholder="01 23 45 67 89" required>
                            <input type="submit" name="submitPhone" value="Ajouter">
                            <?php if (isset($_POST['submitPhone'])) {
                                $user->addPhone($bdd);
                                echo "enregistré";
                                header('Location:panier.php');
                            }
                            ?>
                        </form>
                    <?php } ?>
                </div>
            </div>
            <div class="lepaiement"><?php
            if (count($products) > 0 && $user->isPhoneExist($bdd) && $adresse->itExist($bdd)) {
            ?>
            <div class="codepromo">
                <form method="post">
                    <span>Vous avez un code promo ? rentrez-le ici !</span><br>
                    <label for="code_promo">Code promo :</label>
                    <input type="text" id="code_promo" name="code_promo">
                    <input type="submit" name="appliquerPromo" value="Appliquer" class="buttonpromo">
                </form>

                <?php

                // Vérifiez si le code promo est valide
                if (isset($_POST['appliquerPromo'])) {
                    $dateActuel = date('Y-m-d');
                    $reqcode = $bdd->prepare('SELECT `code`, `valeur`, `date_expiration` FROM `codepromo` WHERE code = ?');
                    $reqcode->execute([$_POST['code_promo']]);
                    $rescode = $reqcode->fetch(PDO::FETCH_ASSOC);
                    if ($rescode) {
                        if ($rescode['date_expiration'] > $dateActuel) {
                            // Appliquez la réduction appropriée sur le panier
                            $reduction = $rescode['valeur'];
                            $prixTotal = number_format($prixTotal - ($prixTotal * $reduction / 100), 2);

                            // Affichez le nouveau total avec la réduction
                            echo "<div class='msgPromo1'>Total avec réduction : " . $prixTotal . "</div>";
                        } else {
                            echo "<div class='msgPromo2'>Code promo invalide</div>";
                        }
                    } else {
                        echo "<div class='msgPromo2'>Code promo invalide</div>";
                    }
                }
                ?>
            </div>
                    <hr id='hr1'>
                    <div><span class="petitTitre">Proceder au paiement :</span></div>
                    <form id="payment-form" style="margin-top: 10px;">
                        <div id="link-authentication-element">
                            <!--Stripe.js injects the Link Authentication Element-->
                        </div>
                        <div id="payment-element">
                            <!--Stripe.js injects the Payment Element-->
                        </div>
                        <button id="submit">
                            <div class="spinner hidden" id="spinner"></div>
                            <span id="button-text">Acheter</span>
                        </button>
                        <div id="payment-message" class="hidden"></div>
                    </form>

                    <!-- <form method="POST"><input type="submit" name="validerPanier" value="Valider la commande"></form> -->
                <?php
                                    }
                ?>
            </div>
        </div>
    </main>
</body>

</html>