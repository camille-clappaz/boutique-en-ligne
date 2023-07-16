<?php
// require("../includes/config.php");

class SousCategorie
{
    // les atributs
    public $id;
    public $titreSousCat;
    public $imgSousCat;
    public $id_parent;
   

    // methodes
    public function __construct($titreSousCat, $imgSousCat, $id_parent)
    {
        $this->titreSousCat = $titreSousCat;
        $this->imgSousCat = $imgSousCat;
        $this->id_parent = $id_parent;
    }
    public function addSousCategorie($bdd)
    {
        $addSousCategorie = $bdd->prepare('INSERT INTO `souscategorie`(`titreSousCat`, `imgSousCat`,`id_parent`) VALUES(?,?,?)');
        $addSousCategorie->execute([$this->titreSousCat, $this->imgSousCat, $this->id_parent]);
    }

    public function delete($bdd)
    {
        $req = $bdd->prepare('DELETE FROM `souscategorie` WHERE id=?');
        $req->execute([$this->id]);
        exit;
    }
    public function update(
      
        $bdd
    ) {
        $req = $bdd->prepare("UPDATE `souscategorie` SET titreSousCat=?, imgSousCat=?, id_parent=? WHERE id = ?");
        $req->execute([$this->titreSousCat, $this->imgSousCat, $this->id, $this->id_parent]);
    }

    public function getId()
    {
        return $this->id;
    }
    public function getTitreSousCat()
    {
        return $this->titreSousCat;
    }
    public function getimgSousCat()
    {
        return $this->imgSousCat;
    }
    public function getid_parent()
    {
        return $this->id_parent;
    }
   
    public function setId($id)
    {
        $this->id = $id;
    }
    public function setTitreSousCat($titreSousCat)
    {
        $this->titreSousCat = $titreSousCat;
    }
    public function setimgSousCat($imgSousCat)
    {
        $this->imgSousCat = $imgSousCat;
    }
    public function setid_parent($id_parent)
    {
        $this->id_parent = $id_parent;
    }
   
}


