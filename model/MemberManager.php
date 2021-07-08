<?php
require_once("model/Manager.php");

class MemberManager extends Manager 
{
    public function connexionUser($pseudo, $pass)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, pass, admin FROM membres WHERE pseudo = ?');
        $req->execute(array($pseudo));
        return $req->fetch();
    }
    
    public function saveUser($pseudo, $passHache, $email)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO membres(pseudo, pass, email, date_inscription) VALUES(?, ?, ?, CURDATE())');
        return $req->execute(array($pseudo, $passHache, $email));
    }

} 