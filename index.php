<?php

session_start();

require 'controller/Autoloader.php'; 
Autoloader::register(); 

// Blog
try {
    if (isset($_GET['action'])) {
        
        if ($_GET['action'] == 'listPosts') {
            $blog = new Blog();
            $blog->listPosts();
        }
        
        elseif ($_GET['action'] == 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $blog = new Blog();
                $blog->post();
            }
            else {
                throw new Exception ('Aucun identifiant de billet envoyé');
            }
        }

        elseif ($_GET['action'] == 'viewAddComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $blog = new Blog();
                $blog->viewAddComment();
            }
        }
        
        elseif ($_GET['action'] == 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_SESSION['id']) && !empty($_POST['comment'])) {
                    $blog = new Blog();
                    $blog->addComment($_GET['id'], $_SESSION['id'], $_POST['comment']);
                }
                else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            }
            else {
                throw new Exception('Aucun idendifiant de billet envoyé');
            }
        }
        
        elseif ($_GET['action'] == 'viewEditComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $blog = new Blog();
                $blog->viewEditComment();
            }
            else {
                throw new Exeption('Aucun commentaire trouvé !');
            }
        }
        
        elseif ($_GET['action'] == 'editComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['comment'])) {
                    $blog = new Blog();
                    $blog->editComment($_GET['id'], $_POST['comment']);
                }
                else {
                    throw new Exeption('Tous les champs ne sont pas remplis !');
                }
            }
            else {
                throw new Exeption('Aucun idendifiant de billet envoyé');
            }
        }

        elseif ($_GET['action'] == 'deleteComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_GET['id'])) {
                    $blog = new Blog();
                    $blog->deleteCom($_GET['id']);
                }
                else {
                    throw new Exeption('Vous n\'avez pas saisi tous les paramètres');
                }
            }
        }

        elseif ($_GET['action'] == 'postReport') {
            if (isset($_GET['id']) && isset($_GET['postId'])) {
                $blog = new Blog();
                $blog->postReport($_GET['id'], $_GET['postId']);
            }
        }

        // Administrateur
        elseif ($_GET['action'] == 'listPostsAdmin') {
            $admin = new Admin();
            $admin->listPostsAdmin();
        }

        if ($_GET['action'] == 'viewAddPost') {
            $admin = new Admin();
            $admin->viewAddPost();
        }
        
        elseif ($_GET['action'] == 'addPost') {
            if (!empty($_SESSION['id']) && !empty($_POST['title']) && !empty($_POST['content'])) {
                $admin = new Admin();
                $admin->addPost($_SESSION['id'], $_POST['title'], $_POST['content']);
            }
            else {
                throw new Exception('Tous les champs ne sont pas remplis !');
            }
        }

        elseif ($_GET['action'] == 'viewEditPost') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $admin = new Admin();
                $admin->viewEditPost();
            }
            else {
                throw new Exception ('Aucun identifiant de billet envoyé');
            }
        }

        elseif ($_GET['action'] == 'editPost') {
            if (!empty($_POST['title']) && !empty($_POST['content'])) {
                $admin = new Admin();
                $admin->editPost($_GET['id'], $_POST['title'], $_POST['content']);
            }
            else {
                throw new Exeption('Tous les champs ne sont pas remplis !');
            }
        }

        elseif ($_GET['action'] == 'deletePost') {
            $admin = new Admin();
            $admin->deletePost($_GET['id']);
        }

        elseif ($_GET['action'] == 'reportedCommentAdmin') {
            $admin = new Admin();
            $admin->reportedCommentAdmin();
        }

        elseif ($_GET['action'] == 'deleteReport') {
            $admin = new Admin();
            $admin->deleteReport($_GET['id']);
        }

        // Membres
        if ($_GET['action'] == 'connexion') {
            $member = new Member();
            $member->connexion();
        }

        elseif ($_GET['action']== 'connexionUser') {
            if (isset($_POST['pseudo']) && isset($_POST['pass'])) {
                $member = new Member();
                $member->connexionUser($_POST['pseudo'], $_POST['pass']);
                
            }
            else {
                throw new Exception('Tous les champs ne sont pas remplis !');
            }
        }

        if ($_GET['action'] == 'registration') {
            $member = new Member();
            $member->registration();
        }

        elseif ($_GET['action'] == 'saveUser') {
            if (isset($_POST['pseudo']) && isset($_POST['pass']) && isset($_POST['email'])) {
                $member = new Member();
                $member->saveUser($_POST['pseudo'], $_POST['pass'], $_POST['email']);
            }
            else {
                throw new Exception('Tous les champs ne sont pas remplis !');
            }
        }

        elseif ($_GET['action'] == 'deconnexion') {
            $member = new Member();
            $member->deconnexion();
        }
        
    }
    else {
        $blog = new Blog();
        $blog->listPosts();   
    }
}
catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}
