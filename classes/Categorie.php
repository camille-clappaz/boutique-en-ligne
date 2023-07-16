<?php
require("../includes/config.php");

class Categorie
{
    // les atributs
    public $id;
    public $titreCat;
    public $imgCat;
   

    // methodes
    public function __construct($titreCat, $imgCat)
    {
        $this->titreCat = $titreCat;
        $this->imgCat = $imgCat;
    }
    public function addCategorie($bdd)
    {
        $addCategorie = $bdd->prepare('INSERT INTO `categorie`(`titreCat`, `imgCat`) VALUES(?,?)');
        $addCategorie->execute([$this->titreCat, $this->imgCat]);
        }

    public function delete($bdd)
    {
        $req = $bdd->prepare('DELETE FROM `categorie` WHERE id=?');
        $req->execute([$this->id]);
        exit;
    }
    public function update(
      
        $bdd
    ) {
        $req = $bdd->prepare("UPDATE `categorie` SET titreCat=?, imgCat=? WHERE id = ?");
        $req->execute([$this->titreCat, $this->imgCat, $this->id]);
    }

    public function getId()
    {
        return $this->id;
    }
    public function getTitreCat()
    {
        return $this->titreCat;
    }
    public function getimgCat()
    {
        return $this->imgCat;
    }
   
    public function setId($id)
    {
        $this->id = $id;
    }
    public function setTitreCat($titreCat)
    {
        $this->titreCat = $titreCat;
    }
    public function setimgCat($imgCat)
    {
        $this->imgCat = $imgCat;
    }
   
}
// $categorie=new Categorie("vélo", "https://just-ebike.com/1183-large_default/velo-electrique-o2feel-vern-urban-power-91.jpg");
// $categorie->addCategorie($bdd);

