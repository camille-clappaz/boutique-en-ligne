<?php
require_once('../includes/config.php');
require_once('../classes/User.php');

$data = json_decode(file_get_contents('php://input'), true);
if (isset($data)) {
    $email = $data['email'];
    $password = $data['password'];

    $user = new User('', $email,'','', $password, '','');

    // La sécurité empêche que les champs soient VIDES et correspondent à ce que nous voulons.
    if (empty($email)) {
        $message['erreur'] = '<i class="fa-solid fa-circle-exclamation"></i>&nbspLe champ Email est vide.';
    } elseif (empty($password)) {
        $message['erreur'] = '<i class="fa-solid fa-circle-exclamation"></i>&nbspLe champ Password est vide';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message['erreur'] = '<i class="fa-solid fa-circle-exclamation"></i>&nbspL\'adresse mail n\'est pas valide.';
    } elseif ($user->loginUnique($bdd)) {
        $request = $bdd->prepare('SELECT * FROM `users` WHERE email = ? ');
        $request->execute([$email]);
        $result = $request->fetch();
        if ($result) {
            //$passwordHash = $result['password'];
            if ($request->rowCount() > 0) {
                return $_SESSION["user"] = $result;
            }
        }
        $message['erreur'] = "sucess";
        $_SESSION['user'] = $email;
    }
} else {
    $message['erreur'] = "Données manquantes";
}

header('Content-Type: application/json');
echo json_encode($message);
exit;