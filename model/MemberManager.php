<?php
require_once("model/Manager.php");

class MemberManager extends Manager 
{
    public function connexionUser($pseudo, $pass)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, pass FROM membres WHERE pseudo = ?');
        $req->execute(array($pseudo));
        return $req->fetch();
    }

} 