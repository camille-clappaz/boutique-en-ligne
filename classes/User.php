<?php

class User
{
    public $id;
    public $email;
    public $password;
    public $firstname;
    public $lastname;
    public $avatar;
    public $phoneUser;

    /* GETTERS */

    function getId()
    {
        return $this->id;
    }

    function getEmail()
    {
        return $this->email;
    }

    function getPassword()
    {
        return $this->password;
    }


    function getFirstname()
    {
        return $this->firstname;
    }

    function getLastname()
    {
        return $this->lastname;
    }

    function getAvatar()
    {
        return $this->avatar;
    }


    /* SETTERS */

    function setEmail($email)
    {
        $this->email = $email;
    }

    function setPassword($password)
    {
        $this->password = $password;
    }

    function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    function setAvatar($avatar)
    {
        $this->avatar = $avatar;
    }

    function __construct($id, $email, $password, $firstname, $lastname, $avatar, $phoneUser)
    {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->avatar = $avatar;
        $this->phoneUser = $phoneUser;
    }

    function register($bdd)
    {
        $email = trim($this->email);
        $firstname = trim($this->firstname);
        $lastname = trim($this->lastname);
        $password = password_hash(trim($this->password), PASSWORD_DEFAULT);
        $request = $bdd->prepare('INSERT INTO `users`(`email`, `password`, `firstname`, `lastname`, `avatar`) VALUES (?,?,?,?,?)');
        $request->execute([$email, $password, $firstname, $lastname, $this->avatar]);
    }

    function loginUnique($bdd)
    {
        $request = $bdd->prepare('SELECT `email` FROM `users` WHERE email = ?');
        $request->execute([$this->email]);
        if ($request->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function verifierSiVide()
    {
        if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['firstName']) && !empty($_POST['lastName'])) {
            return true;
        } else {
            return false;
        }
    }

    function connect($bdd)
    {   
        $request = $bdd->prepare('SELECT * FROM `users` WHERE email = ? ');
        $request->execute([$this->email]);
        $result = $request->fetch();
        if ($result) {
            $passwordHash = $result['password'];
            if ($request->rowCount() > 0 && password_verify($this->password, $passwordHash)) {
                return $_SESSION["user"] = $result;
            }
        }
    }

    function disconnect()
    {
        unset($_SESSION["user"]);
        session_destroy();
    }

    function isConnected()
    {
        if (isset($_SESSION["user"])) {
            return true;
        } else {
            return false;
        }
    }

    function update($bdd)
    {
        $request = $bdd->prepare("UPDATE `users` SET `email`= ?,`password`= ?,`first name`= ?,`last name`= ? WHERE id = ?");
        $request->execute([$this->email, $this->password, $this->firstname, $this->lastname, $this->get_id($bdd)]);
    }
    function get_id($bdd)
    {
        $request = $bdd->prepare('SELECT `id` FROM `users` WHERE email = ? ');
        $request->execute([$this->email]);
        $result = $request->fetch();
        return $result['id'];
    }

    function addAvatar($bdd)
    {
        $request = $bdd->prepare('UPDATE `users` SET `avatar`= (?) WHERE `id` = ?');
        $request->execute([$this->avatar, $this->id]);
    }

    function selectAvatar($bdd)
    {
        $request = $bdd->prepare('SELECT `avatar` FROM `users` WHERE `id` = ?');
        $request->execute([$this->id]);
        $result = $request->fetch(PDO::FETCH_ASSOC);
        return $result['avatar'];
    }

    function isPhoneExist($bdd)
    {
        $request = $bdd->prepare('SELECT `phoneUser` FROM `users` WHERE users.id = ?');
        $request->execute([$_SESSION['user']['id']]);
        $result = $request->fetch(PDO::FETCH_ASSOC);
        if ($result['phoneUser'] == "") {
            return false;
        } else {
            return true;
        }
    }

    function selectPhoneNumber($bdd)
    {
        $request = $bdd->prepare('SELECT `phoneUser` FROM `users` WHERE users.id = ?');
        $request->execute([$_SESSION['user']['id']]);
        $result = $request->fetch(PDO::FETCH_ASSOC);
        return $result['phoneUser'];
    }

    function addPhone($bdd)
    {
        $request = $bdd->prepare('UPDATE `users` SET `phoneUser`= (?) WHERE users.id = ?');
        $request->execute([$_POST['phone'], $_SESSION['user']['id']]);
        $_SESSION['user']['phoneUser'] = $_POST['phone'];
    }
}
