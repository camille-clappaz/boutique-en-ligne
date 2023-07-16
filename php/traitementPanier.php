<?php
require_once('../includes/config.php');
$msg = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_POST = json_decode(file_get_contents("php://input"),true);
    if (isset($_POST["deleteArt"])) { 
        $req = $bdd->prepare("SELECT quantite_art FROM panier WHERE id_article = ?");
        $req->execute([$_POST["deleteArt"]]);
        $res = $req->fetch(PDO::FETCH_ASSOC);

        if ($res["quantite_art"] != 1) { //si il y en a plus qu'un.
            $req2 = $bdd->prepare("UPDATE `panier` SET `quantite_art`= ? WHERE id_user = ? AND id_article = ?");
            $req2->execute([$res["quantite_art"] - 1, $_SESSION['user']['id'], $_POST["deleteArt"]]);
            $msg[] = '<i class="fa-solid fa-circle-minus fa-lg" style="color: #ff0000;"></i> Article supprimé du panier.';
            $msg['quantite'] = $res["quantite_art"] - 1;

        } elseif (($res["quantite_art"] == 1)) {
            $req3 = $bdd->prepare("DELETE FROM `panier` WHERE id_user = ? AND id_article = ? ");
            $req3->execute([$_SESSION['user']['id'], $_POST["deleteArt"]]);
            $msg[] = '<i class="fa-solid fa-circle-minus fa-lg" style="color: #ff0000;"></i> Article supprimé du panier.';
        }
    }
}
$json = json_encode($msg);
echo $json;
