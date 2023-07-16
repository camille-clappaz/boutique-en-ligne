<?php
require_once('../classes/User.php');
require_once('../includes/config.php');
ob_start();

$msg = '';
if (isset($_POST["Envoyer"])) {
    $email = htmlspecialchars($_POST['email']);
    $prenom = '';
    $nom = '';
    $password = $_POST['password'];
    if (!empty($email) && !empty($password)) {
        $user = new User('', $email, $password, $prenom, $nom, '', '');
        $user->connect($bdd);
        if ($user->isConnected()) {
            header("Location: ../index.php");
        } else {
            $msg = "l'email et le mot de passe ne correspondent pas.";
        }
    } else {
        $msg = "Veuillez remplir tout les champs.";
    }
}


?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/header.css">
    <link rel="stylesheet" type="text/css" href="../css/connexion.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/e1a1b68f9b.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap" rel="stylesheet">
</head>

<body>
    <?php require_once('../includes/header2.php'); ?>
    <main>
        <div class="moduleco">
            <h1 class="titre">Connexion</h1>

            <form method="post">

                <label for="email">Email</label><br>
                <input class="inputtext" type="email" id="email" name="email" /><br>


                <label for="password">Mot de passe</label><br>
                <input class="inputtext" type="password" id="password" name="password" /><br>

                <p id="message"><?= $msg ?></p>

                <input class="inputsubmit" type="submit" name="Envoyer" id="login">

            </form>
            <span class="msgfin">Vous n'avez pas encore de compte ? <a href="inscription.php">Inscrivez-vous !</a></span>
        </div>
    </main>
    <script src="../js/autocompletion.js" defer></script>
    <script src="../js/connexion.js" defer></script>
    <script src="../js/fonction.js" defer></script>
</body>

</html>