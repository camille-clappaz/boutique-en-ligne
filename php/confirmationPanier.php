<?php
// Importation de la bibliothèque Stripe
require_once('../stripe/init.php');
require_once('../includes/keyStripe.php');
require_once('../includes/config.php');

// On appelle la méthode statique setApiKey de la classe Stripe se trouvant dans le fichier init.php (dans le dossier Stripe)
\Stripe\Stripe::setApiKey($stripeSecretKey);
// On créé un nouvel objet de la classe StripeClient qui va nous permettre d'effectuer des requêtes à l'API Stripe
$stripe = new \Stripe\StripeClient($stripeSecretKey);

// On récupère l'id du paiement dans l'URL
$paymentIntentId = $_GET['payment_intent'];

// On vérifie que l'id du paiement existe et n'est pas vide
if (isset($paymentIntentId) && !empty($paymentIntentId)) {
    // On vérifie que le paiement n'a pas déjà été validé
    $request = $bdd->prepare('SELECT * FROM commande WHERE paymentIntentId = ?');
    $request->execute([$paymentIntentId]);

    // Si le paiement a déjà été validé, on redirige l'utilisateur vers la page panier
    if ($request->rowCount() > 0) {
        header('Location: panier.php');
        return;
    }

    // On récupère le paiement dans l'API Stripe
    $paymentIntent = $stripe->paymentIntents->retrieve($paymentIntentId);

    // On vérifie que le paiement a bien été validé
    if ($paymentIntent->status === 'succeeded') {
        // On récupère les informations de l'utilisateur dans les metadata du paiement
        $user = json_decode($paymentIntent->metadata->user, true);

        // On récupère le panier de l'utilisateur
        $request = $bdd->prepare('SELECT * FROM `panier` WHERE `id_user` = ?');
        $request->execute([$user['id']]);
        $cart = $request->fetchAll(PDO::FETCH_ASSOC);

        // On créé un tableau qui va contenir les produits de la commande
        $products = [];

        if ($cart) {
            // On parcourt le panier de l'utilisateur
            foreach ($cart as $productInCart) {
                $product_id = $productInCart['id_article'];
                $product_quantity = $productInCart['quantite_art'];
                $productRequest = $bdd->prepare('SELECT * FROM `articles` WHERE `idArt` = ?');
                $productRequest->execute([$product_id]);
                $product = $productRequest->fetch(PDO::FETCH_ASSOC);
                $product['quantite_art'] = $product_quantity;

                // On ajoute le produit au tableau des produits de la commande
                $products[] = $product;
            }
        }

        // On calcule le prix total de la commande
        $prixTotal = $paymentIntent->amount / 100;

        // On enregistre la commande dans la base de données
        $request2 = $bdd->prepare('INSERT INTO `commande`(`adresse`, `id_user`, `phone`, `date`, `prixTotal`,`paymentIntentId`) VALUES (?,?,?,?,?,?)');
        $request2->execute([$user['adresse'], $user['id'], $user['phone'], date('Y-m-d'), $prixTotal, $paymentIntentId]);

        // On récupère l'id de la commande
        $idcommande = $bdd->lastInsertId();

        // Parcourir les produits de la commande et les enregistrer dans la table commandpanier
        foreach ($products as $product) {
            $articleIDPanier = $product['idArt'];
            $request3 = $bdd->prepare('INSERT INTO `commandpanier`(`id_commande`, `id_article`, `quantite_art`) VALUES (?,?,?)');
            $request3->execute([$idcommande, $articleIDPanier, $product['quantite_art']]);
        }

        // On supprime le panier de l'utilisateur
        $request4 = $bdd->prepare('DELETE FROM `panier` WHERE `id_user` = (?)');
        $request4->execute([$user['id']]);
    } else {
        // Si le paiement n'a pas été validé, on redirige l'utilisateur vers la page panier
        header('Location: panier.php');
    }
} else {
    // Si l'id du paiement n'existe pas ou est vide, on redirige l'utilisateur vers la page panier
    header('Location: panier.php');
}

?>

<html>

<head>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/header.css">
    <link rel="stylesheet" type="text/css" href="../css/checkout.css">
    <link rel="stylesheet" type="text/css" href="../css/panier.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/e1a1b68f9b.js" crossorigin="anonymous"></script>
   
    <title>Confirmation de commande</title>
</head>

<body>
    <?php require_once('../includes/header2.php'); ?>
    <h1>Confirmation de commande</h1>
    <p>Merci pour votre commande !</p>
    <p>Numéro de commande : <?= $idcommande ?></p>
    <script src="../js/autocompletion.js" defer></script>
    <script src="../js/fonction.js" defer></script>
</body>

</html>