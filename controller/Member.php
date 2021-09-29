<?php

class Member 
{
    // Méthode / page de connexion
    public function connexion()
    {
        require('view/frontend/connexion.php');
    }

    // Méthode pour identifier le membre déjà inscrit 
    public function connexionUser($pseudo, $pass)
    {
        $memberManager = new MemberManager();
        
        $resultat = $memberManager->connexionUser($pseudo, $pass);
        
        if (!$resultat) { // Le membre est informé si le pseudo n'est pas enregisté
            $errorPseudo = 'Erreur d\'identifiant ou mot de passe';
            require('view/frontend/connexion.php');
        } 
        else { // Vérification membre existe
            $isPasswordCorrect = password_verify($pass, $resultat['pass']);

            if (!$isPasswordCorrect) { // Le membre est informé si le mdp n'est pas enregisté
                $errorPassword = 'Erreur d\'identifiant ou mot de passe';
                require('view/frontend/connexion.php');
            } 
            else { // Sinon la connexion est validée
                $_SESSION['id'] = $resultat['id']; 
                $_SESSION['pseudo'] = $_POST['pseudo'];
                $_SESSION['admin'] = $resultat['admin'];
                header('location: index.php?action=listPosts');
            }
        }
    }

    // Méthode / page d'inscription
    public function registration()
    {
    require('view/frontend/registration.php');
    }

    // Méthode pour enregistrer un membre
    public function saveUser($pseudo, $pass, $email)
    {
        $memberManager = new MemberManager();

        $passHache = password_hash($pass, PASSWORD_DEFAULT);
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { // Vérification si l'email est conforme
            $errorEmail = 'Votre email est invalide';
            require('view/frontend/registration.php');
        } 
        elseif (strlen($pass) < 5) { // Vérification si le mot de passe à plus de 5 caractères
            $errorPassword = 'Votre mot de passe doit contenir minimum 5 caractères';
            require('view/frontend/registration.php');
        } 
        elseif ($_POST['pass']!== $_POST['pass2']) { // Vérification que les mots de passes sont identiques
            $errorPassword = 'mots de passes pas identiques';
            require('view/frontend/registration.php');
        }
         elseif ($memberManager->saveUser($pseudo, $passHache, $email)) { // L'enregistrement du membre
            header('location: index.php?action=connexion'); 
        } 
        else { // Vérification si l'email est déjà utilisé
            $errorEmail = 'Votre email est déjà utilisé';
            require('view/frontend/registration.php');
        }               
    }

    // Méthode pour deconnecter un membre + retour page d'accueil
    public function deconnexion()
    {
        $_SESSION = array();
        session_destroy();
        header('location: index.php?action=listPosts');
    }
}