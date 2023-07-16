<?php
// require("../includes/config.php");

class Article
{
    // les atributs
    public $idArt;
    public $titreArt;
    public $description;
    public $prix;
    public $date;
    public $id_categorie;
    public $id_sousCategorie;
    public $quantite;
    public $imgArt;
    public $promo;



    // methodes
    public function __construct($titreArt, $description, $prix, $date, $id_categorie, $id_sousCategorie, $quantite, $imgArt, $promo)
    {
        $this->titreArt = $titreArt;
        $this->description = $description;
        $this->prix = $prix;
        $this->date = $date;
        $this->id_categorie = $id_categorie;
        $this->id_sousCategorie = $id_sousCategorie;
        $this->quantite = $quantite;
        $this->imgArt = $imgArt;
        $this->promo = $promo;
        
    }
    public function addArticle($bdd)
    {
        $addArticle = $bdd->prepare('INSERT INTO `articles`(`titreArt`, `description`, `prix`, `date`, `id_categorie`,`id_sousCategorie`, `quantite`, `imgArt`, `promotion`) VALUES(?,?,?,?,?,?,?,?,?)');
        $addArticle->execute([$this->titreArt, $this->description, $this->prix, $this->date, $this->id_categorie, $this->id_sousCategorie, $this->quantite, $this->imgArt,  $this->promo]);
    }

    public function delete($bdd)
    {
        $req = $bdd->prepare('DELETE FROM `articles` WHERE idArt=?');
        $req->execute([$this->idArt]);
        exit;
    }
    public function update(
      
        $bdd
    ) {
        $req = $bdd->prepare("UPDATE `articles` SET titreArt=?, description=?, imgArt=? WHERE idArt = ?");
        $req->execute([$this->titreArt, $this->description, $this->imgArt, $this->idArt]);
    }

    public function getId()
    {
        return $this->idArt;
    }
    public function gettitreArt()
    {
        return $this->titreArt;
    }
    public function getDescription()
    {
        return $this->description;
    }
    public function getPrix()
    {
        return $this->prix;
    }
    public function getDate()
    {
        return $this->date;
    }
    public function getIdCategorie()
    {
        return $this->id_categorie;
    }
    public function getQuantite()
    {
        return $this->quantite;
    }
    public function getimgArt()
    {
        return $this->imgArt;
    }
    public function setId($idArt)
    {
        $this->idArt = $idArt;
    }
    public function settitreArt($titreArt)
    {
        $this->titreArt = $titreArt;
    }
    public function setDescription($description)
    {
        $this->description = $description;
    }
    public function setPrix($prix)
    {
        $this->prix = $prix;
    }
    public function setDate($date)
    {
        $this->date = $date;
    }
    public function setIdCategorie($id_categorie)
    {
        $this->id_categorie = $id_categorie;
    }
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;
    }
    public function setimgArt($imgArt)
    {
        $this->imgArt = $imgArt;
    }
}

// $article = new Article("boucle d'oreille", "bl bl", "4", "2023-02-02", "1", "3", "img33");
// $article->addArticle($bdd);
