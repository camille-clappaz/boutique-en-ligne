<?php
//require_once('header.php');
require_once('../classes/User.php');
require_once('../classes/Adresse.php');
require_once('../includes/config.php');
ob_start('ob_gzhandler');

$msg = '';
if (isset($_FILES['photo']['tmp_name'])) {
  $extension = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));
  // Vérification de l'extension 
  if ($extension === 'png' || $extension === 'jpg' || $extension === 'gif') {
    if (move_uploaded_file($_FILES["photo"]["tmp_name"], './avatars/' . $_SESSION['user']['id'] . '.' . pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION))) {
      $avatar = pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION);
      $user = new User($_SESSION['user']['id'], '', '', '', '', $avatar, '');
      $user->addAvatar($bdd);
      $msg = '<p>La photo a bien été enregistrée.</p>';
    } else {
      $msg = '<p>Une erreur s\'est produite lors du déplacement du fichier.</p>';
    }
  } else {
    $msg = '<p>Seuls les fichiers PNG et JPG sont autorisés.</p>';
  }
}


if (isset($_POST['submitInfo'])) {
  if (!empty($_POST['email'])) {
    $email = !empty($_POST['email']) ? $_POST['email'] : $_SESSION['user']['email'];
    $log = $_SESSION['user']['email'];
    $request = $bdd->prepare("UPDATE users SET email = :email WHERE id = :id");
    $request->execute(["email" => $email, "id" => $_SESSION['user']['id']]);
    $_SESSION['user']['email'] = $email;
    header('refresh:0');
  }
  if (!empty($_POST['password1']) && !empty($_POST['password2'])) {
    if ($_POST['password1'] == $_POST['password2']) {
      $mdp = $_POST['password1'];
      $sql = "UPDATE users SET password = ? WHERE id = ?";
      $request = $bdd->prepare($sql);
      $request->execute([$mdp, $id]);
      $result = $request->fetchAll(PDO::FETCH_ASSOC);
    } else {
      $message = "Les deux mots de passe ne sont pas identiques !";
    }
  } else {
    $message = "Il faut remplir tous les champs de mot de passe !";
  }
  if (!empty($_POST['firstname'])) {
    $firstname = !empty($_POST['firstname']) ? $_POST['firstname'] : $_SESSION['user']['firstname'];
    $request = $bdd->prepare("UPDATE users SET firstname = :firstname WHERE id = :id");
    $request->execute(["firstname" => $firstname, "id" => $_SESSION['user']['id']]);
    $_SESSION['user']['firstname'] = $_POST['firstname'];
  }
  if (!empty($_POST['lastname'])) {
    $request = $bdd->prepare("UPDATE users SET lastname = (?) WHERE id = ?");
    $request->execute([$_POST['lastname'], $_SESSION['user']['id']]);
    $_SESSION['user']['lastname'] = $_POST['lastname'];
  }
}
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profil</title>
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
      <h1 class="titre">Profil</h1>
      <?php $user = new User($_SESSION['user']['id'], '', '', '', '', '', '');
      if ($user->selectAvatar($bdd) == "default.png") { ?>
        <img id="imageProfil" src="avatars/default.png">
      <?php } 
      else { ?>
        <img id="imageProfil" src="avatars/<?= $_SESSION['user']['id'] . "." . $user->selectAvatar($bdd) ?>">
      <?php }
      ?>
      <?= $msg ?>
      <form method="post" enctype="multipart/form-data">
        <input type="file" name="photo">
        <input class="submitavatar" type="submit" name="submitAvatar" value="Enregistrer l'image">
      </form>

      <form class='form1' method="POST">
        <div class="field">
          <label>Email </label>
          <input class="inputtext" type="text" name="email" placeholder="<?php echo $_SESSION['user']['email']; ?>">
        </div>

        <div class="field">
          <label>Prenom</label>
          <input class="inputtext" type="text" name="firstname" placeholder="<?php echo $_SESSION['user']['firstname']; ?>">
        </div>

        <div class="field">
          <label>Nom </label>
          <input class="inputtext" type="text" name="lastname" placeholder="<?php echo $_SESSION['user']['lastname']; ?>">
        </div>

        <div class="field">
          <label>Mot de passe</label>
          <input class="inputtext" type="password" name="password1" placeholder='********'>
        </div>

        <div class="field">
          <label>Confirmez le mot de passe</label>
          <input class="inputtext" type="password" name="password2" placeholder='********'>
        </div>

        <input class="inputsubmit" type="submit" name="submitInfo" value="Enregistrer">

        <div>
          <button class="inputsubmit" class="button"><a href="profil.php">Retour au profil</a></button>
        </div>

        <p id="message"></p>
      </form>
    </div>
  </main>

</body>

</html>

<script>
  let prenom = document.querySelector("#firstname");
  let nom = document.querySelector("#lastname");
  let email = document.querySelector("#email");
  let password = document.querySelector("#password");
  let password2 = document.querySelector("#password2");
  let formSignUp = document.querySelector("#signup");
  let message = document.querySelector("#message");

  function isSignUp() {
    if (prenom.value == "") {
      document.getElementById("message").innerText = "Le champs prenom ne peut pas être vide.";
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
    } else if (email.value == "") {
      document.getElementById("message").innerText =
        "Le champs email ne peut pas être vide.";
      return false;
    } else if (password.value == "") {
      document.getElementById("message").innerText =
        "Le champs mot de passe ne peut pas être vide.";
      return false;
    } else if (password2.value == "") {
      document.getElementById("message").innerText =
        "Le champs confirmation de mot de passe ne peut pas être vide.";
      return false;
    } else if (password.value !== password2.value) {
      document.getElementById("message").innerText =
        "Les deux mots de passe ne sont pas identiques.";
      return false;
    } else {
      return true;
    }
  }

  formSignUp.addEventListener("submitInfo", (e) => {
    if (submitInfo() == false) {
      e.preventDefault();
    }
  });
</script>