<?php

require_once("model/Manager.php");

class MemberManager extends Manager 
{
    // Requête connexion utilisateur
    public function connexionUser($pseudo, $pass)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, pass, admin FROM members WHERE pseudo = ?');
        $req->execute(array($pseudo));
        return $req->fetch();
    }
    
    // Requête pour l'inscription du membre
    public function saveUser($pseudo, $passHache, $email)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO members(pseudo, pass, email, registration_date) VALUES(?, ?, ?, CURDATE())');
        return $req->execute(array($pseudo, $passHache, $email));
    }

} 