<?php
require_once('../includes/header2.php');
require_once('../classes/User.php');
require_once('../classes/Adresse.php');
require_once('../includes/config.php');
ob_start();
$msg = '';
function submit($bdd)
{
    if (isset($_POST["Envoyer"])) {
        $id_user = $_SESSION['user']['id'];
        $firstname = htmlspecialchars($_POST['prenom']);
        $lastname = htmlspecialchars($_POST['nom']);
        $numero = htmlspecialchars($_POST['numero']);
        $rue = htmlspecialchars($_POST['rue']);
        $postal = htmlspecialchars($_POST['postal']);
        $ville = htmlspecialchars($_POST['ville']);

        if (!empty($firstname) && !empty($lastname) && !empty($numero) && !empty($rue) && !empty($postal) && !empty($ville)) {
            if (is_numeric($numero) && is_numeric($postal)) {
                if (preg_match("/^[0-9]{5}$/", $postal)) {
                    $adresse = new Adresse($id_user, $firstname, $lastname, $numero, $rue, $postal, $ville);
                    if ($adresse->itExist($bdd)) {
                        $adresse->editAdresse($bdd);
                    } else {
                        $adresse->register($bdd);
                    }
                    //header("Location: profil.php");
                } else {
                    echo "Le code postal n'est pas valide.";
                }
            } else {
                $msg = "Le champs numero et code postal doivent comporter des nombres uniquement.";
            }
        }
    }
}

submit($bdd);

?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/header.css">
    <link rel="stylesheet" type="text/css" href="../css/connexion.css">
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
        <div class="moduleco">
            <h1 class="titre">Adresse de Livraison</h1>

            <form method="post" id="signup">
                <label for="nom">Nom</label><br>
                <input class="inputtext" type="text" id="nom" name="nom" /><br>

                <label for="prenom">Prenom</label><br>
                <input class="inputtext" type="text" id="prenom" name="prenom" /><br>


                <label for="numero">Numero de voie</label><br>
                <input class="inputtext" type="text" id="numero" name="numero" /><br>

                <label for="rue">Nom de la voie</label><br>
                <input class="inputtext" type="text" id="rue" name="rue" /><br>

                <label for="postal">Code Postal</label><br>
                <input class="inputtext" type="text" id="postal" name="postal" /><br>

                <label for="ville">Ville</label><br>
                <input class="inputtext" type="text" id="ville" name="ville" /><br>

                <input class="inputsubmit" type="submit" name="Envoyer" id="button">

                <p id="message"><?= $msg ?></p>

            </form>
        </div>
    </main>

</body>

</html>
<script>
    let formSignUp = document.getElementById("signup");
    let nom = document.getElementById("nom");
    let prenom = document.getElementById("prenom");
    let numero = document.getElementById("numero");
    let rue = document.getElementById("rue");
    let postal = document.getElementById("postal");
    let ville = document.getElementById("ville");
    let message = document.getElementById("#message");

    function signUp() {
        if (prenom.value == "") {
            document.getElementById("message").innerText = "Le champs prénom ne peut pas être vide.";
            return false;
        } else if (prenom.value.length < 3) {
            document.getElementById("message").innerText = "Le prénom est trop court";
            return false;
        } else if (nom.value == "") {
            document.getElementById("message").innerText = "Le champs nom ne peut pas être vide.";
            return false;
        } else if (nom.value.length < 3) {
            document.getElementById("message").innerText = "Le nom est trop court";
            return false;
        } else if (numero.value == "") {
            document.getElementById("message").innerText =
                "Le champs numero ne peut pas être vide.";
            return false;
        } else if (rue.value == "") {
            document.getElementById("message").innerText =
                "Le champs rue ne peut pas être vide.";
            return false;
        } else if (postal.value == "") {
            document.getElementById("message").innerText =
                "Le champs code postal ne peut pas être vide.";
            return false;
        } else if (ville.value == "") {
            document.getElementById("message").innerText =
                "Le champs ville ne peut pas être vide.";
            return false;
        } else {
            return true;
        }
    }

    formSignUp.addEventListener("submit", (e) => {
        if (signUp() == false) {
            e.preventDefault();
        }
    });
</script>