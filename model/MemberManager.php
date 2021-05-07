<?php
require_once("model/Manager.php");

class MemberSpaceManager extends Manager 
{
    public function registration()
    {
        $db = dbConnect();
        $req = $bdd->prepare('INSERT INTO membres(pseudo, pass, email, date_inscription) VALUES(:pseudo, :pass, :email, CURDATE())');
        $req->execute (array(
        'pseudo' => $_POST['pseudo'],
        'pass' => $pass_hache,
        'email' => $_POST['email']));   
}

    }

}