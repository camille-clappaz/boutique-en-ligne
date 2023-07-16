<?php

require_once('../classes/User.php');
require_once('../includes/config.php');
ob_start();
$msg = '';


// if (isset($_POST["Envoyer"])) {
//   $email = htmlspecialchars($_POST['email']);
//   $prenom = htmlspecialchars($_POST['firstName']);
//   $nom = htmlspecialchars($_POST['lastName']);
//   $password = $_POST['password'];
//   $passwordHash = password_hash($password, PASSWORD_DEFAULT);

//   if (!empty($email) && !empty($prenom) && !empty($nom) && !empty($password) && !empty($_POST['password2'])) {
//     if (isCompatible($bdd)) {
//       $user = new User('', $email, $passwordHash, $prenom, $nom, 'avatars/default.png', '');
//       if ($user->loginUnique($bdd)) {
//         if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
//           if (preg_match('/^(?=.?[A-Z])(?=.?[a-z])(?=.?[0-9])(?=.?[#?!@$%^&*-]).{8,}$/', $password)) {
//             $user->register($bdd);
//             header("Location: connexion.php");
//           } else {
//             $msg = "Le mot de passe doit contenir au moins une majuscule, une minuscule et un caractère spécial.";
//           }
//         } else {
//           $msg = "Veuillez rentrer un format d'email valide.";
//         }
//       } else {
//         $msg = "Cet email existe deja, utilisez un autre email ou connectez vous si vous avez deja un compte.";
//       }
//     } else {
//       $msg = "Les deux mots de passe ne sont pas identiques.";
//     }
//   } else {
//     $msg = "Veuillez remplir tout les champs.";
//   }
// }

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
  <script src="../js/inscription.js" defer></script>
  <script src="../js/fonction.js" defer></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap" rel="stylesheet">
</head>

<body>
  <?php require_once('../includes/header2.php'); ?>
  <main>
    <div class="moduleco">
      <h1 class="titre">Inscription</h1>

      <form method="post" id="signup">

        <label for="firstName">Prenom</label><br>
        <input class="inputtext" type="text" id="firstName" name="firstName" /><br>

        <label for="lastName">Nom</label><br>
        <input class="inputtext" type="text" id="lastName" name="lastName" /><br>

        <label for="email">Email</label><br>
        <input class="inputtext" type="email" id="email" name="email" /><br>


        <label for="password">Mot de passe</label><br>
        <input class="inputtext" type="password" id="password" name="password" /><br>


        <label for="password2">Confirmez le mot de passe</label><br>
        <input class="inputtext" type="password" id="password2" name="password2" /><br>

        <p id="message"><?= $msg ?></p>

        <input class="inputsubmit" type="submit" name="Envoyer">
      </form>

      <span class="msgfin">Vous avez deja un compte ? <a href="connexion.php">Connectez-vous !</a></span>
    </div>
  </main>

</body>

</html>

