<?php 

class Adresse
{
    public $id;
    public $id_user;
    public $firstname;
    public $lastname;
    public $numero;
    public $rue;
    public $codePostal;
    public $ville;

function __construct($id_user, $firstname, $lastname, $numero, $rue, $codePostal, $ville)
    {
        $this->id_user = $id_user;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->numero = $numero;
        $this->rue = $rue;
        $this->codePostal = $codePostal;
        $this->ville = $ville;
    }

    /* GETTERS */

    function getId_user()
    {
        return $this->id_user;
    }

    function getFirstname()
    {
        return $this->firstname;
    }

    function getLastname()
    {
        return $this->lastname;
    }

    function getNumero()
    {
        return $this->numero;
    }

    function getRue()
    {
        return $this->rue;
    }

    function getCodePostal()
    {
        return $this->codePostal;
    }

    function getVille()
    {
        return $this->ville;
    }


    /* SETTERS */

    function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    function setNumero($numero)
    {
        $this->numero = $numero;
    }

    function setRue($rue)
    {
        $this->rue = $rue;
    }

    function setCodePostal($codePostal)
    {
        $this->codePostal = $codePostal;
    }

    function setVille($ville)
    {
        $this->ville = $ville;
    }


    function register($bdd){
        $request = $bdd->prepare('INSERT INTO `adresse`(`id_user`, `firstname`, `lastname`,`numero`, `rue`, `codePostal`, `ville`) VALUES (?,?,?,?,?,?,?)');
        $request->execute([$this->id_user, $this->firstname, $this->lastname, $this->numero, $this->rue, $this->codePostal, $this->ville]);
    }

    function itExist($bdd){
        $request = $bdd->prepare('SELECT * FROM `adresse` INNER JOIN users ON adresse.id_user = users.id WHERE users.id = ?');
        $request->execute([$_SESSION['user']['id']]);
        $result = $request->fetch(PDO::FETCH_ASSOC);
        if ($request->rowCount() > 0){
            return true;
        }
        else {
            return false;
        }
    }

    function isExisting($bdd){
        $request = $bdd->prepare('SELECT * FROM `adresse` WHERE id_user = ?');
        $request->execute([$_SESSION['user']['id']]);
        $result = $request->fetch(PDO::FETCH_ASSOC);
        if ($request->rowCount() > 0){
            $this->firstname = $result['firstname'];
            $this->lastname = $result['lastname'];
            $this->numero = $result['numero'];
            $this->rue = $result['rue'];
            $this->codePostal = $result['codePostal'];
            $this->ville = $result['ville'];
            $adresse = $result['firstname'] . " " . $result['lastname'] . " " . $result['numero'] . " " . $result['rue'] . " " . $result['codePostal'] . " " . $result['ville'];
            return $adresse;
        }
        else {
            return '<a href="inscriptionAdresse.php"><button class="buttonAdresse">Ajouter une adresse</button></a>';
        }
    }

    function editAdresse($bdd){
        $request = $bdd->prepare("UPDATE adresse SET firstname=?, lastname=?, numero= ?, rue= ?, codePostal= ?, ville= ? WHERE id_user = ?");
        $request->execute([$this->firstname, $this->lastname, $this->numero, $this->rue, $this->codePostal, $this->ville, $_SESSION['user']['id']]);
    }

    function deleteAdresse($bdd){
        $request = $bdd->prepare('DELETE FROM `adresse` WHERE id_user = ?');
        $request->execute([$_SESSION['user']['id']]);
    }
}
?>