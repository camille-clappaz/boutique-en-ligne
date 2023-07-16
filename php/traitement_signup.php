<?php
require_once('../classes/User.php');
require_once('../includes/config.php');
$data = json_decode(file_get_contents('php://input'), true); // $data ===== $_post

function isCompatible($a,$b)
{
  if ($a == $b) {
    return true;
  } else {
    return false;
  }
}

if (isset($data)) {
    $email = $data['email'];
    $firstname = $data['firstName'];
    $lastname = $data['lastName'];
    $password = $data['password'];
    $confirm_password = $data['password2'];

    $user = new User('', $email, $password, $firstname, $lastname, 'default.png' ,'');

    if (empty($email)) {
        $message['erreur'] = '<i class="fa-solid fa-circle-exclamation"></i>&nbspLe champ Email est vide.';
    } elseif (empty($firstname)) {
        $message['erreur'] = '<i class="fa-solid fa-circle-exclamation"></i>&nbspLe champ Firstname est vide';
    } elseif (empty($lastname)) {
        $message['erreur'] = '<i class="fa-solid fa-circle-exclamation"></i>&nbspLe champ Lastname est vide';
    } elseif (empty($password)) {
        $message['erreur'] = '<i class="fa-solid fa-circle-exclamation"></i>&nbspLe champ Password est vide';
    } elseif (empty($confirm_password)) {
        $message['erreur'] = '<i class="fa-solid fa-circle-exclamation"></i>&nbspLe champ Confirm Password est vide';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message['erreur'] = '<i class="fa-solid fa-circle-exclamation"></i>&nbspL\'adresse mail n\'est pas valide.';
    } elseif (!isCompatible($password, $confirm_password)) {
        $message['erreur'] = '<i class="fa-solid fa-circle-exclamation"></i>&nbspLes champs password sont différents.';
    } elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{6,}$/', $password)){
        $message['erreur'] = '<i class="fa-solid fa-circle-exclamation"></i>&nbspLe mot de passe doit faire plus de 6 caractères et doit contenir au moins un chiffre, une lettre en majuscule et une en minuscule. ' . $password;
    } else {
        if ($user->loginUnique($bdd)) {
            $message['erreur'] = '<i class="fa-solid fa-circle-exclamation"></i>&nbspCette email est déjà utilisé';
        } else {
            $user->register($bdd);
            $message['succes'] = "Données enregistrées avec succès";
        }
  }
} else {
    $message['erreur'] = "Données manquantes";
}

header('Content-Type: application/json');
echo json_encode($message);
exit;