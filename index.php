<?php
session_start();
require('controller/frontend.php');

try {
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'listPosts') {
            listPosts();
        }
        
        elseif ($_GET['action'] == 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                post();
            }
            else {
                throw new Exception ('Aucun identifiant de billet envoyé');
            }
        }

        elseif ($_GET['action'] == 'viewAddComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                viewAddComment();
            }
        }
        
        elseif ($_GET['action'] == 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                    addComment($_GET['id'], $_POST['author'], $_POST['comment']);
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
                viewEditComment();
            }
            else {
                throw new Exeption('Aucun commentaire trouvé !');
            }
        }
        
        elseif ($_GET['action'] == 'editComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['comment'])) {
                    editComment($_GET['id'], $_POST['comment']);
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
                    deleteCom($_GET['id']);
                }
                else {
                    throw new Exeption('Vous n\'avez pas saisi tous les paramètres');
                }
            }
        }

        if ($_GET['action'] == 'viewAddPost') {
            viewAddPost();
        }
        
        elseif ($_GET['action'] == 'addPost') {
            if (!empty($_POST['title']) && !empty($_POST['author']) && !empty($_POST['content'])) {
                addPost($_POST['title'], $_POST['author'], $_POST['content']);
            }
            else {
                throw new Exception('Tous les champs ne sont pas remplis !');
            }
        }

        elseif ($_GET['action'] == 'viewEditPost') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                viewEditPost();
            }
            else {
                throw new Exception ('Aucun identifiant de billet envoyé');
            }
        }

        elseif ($_GET['action'] == 'editPost') {
            if (!empty($_POST['title']) && !empty($_POST['author']) && !empty($_POST['content'])) {
                editPost($_GET['id'], $_POST['title'], $_POST['author'], $_POST['content']);
            }
            else {
                throw new Exeption('Tous les champs ne sont pas remplis !');
            }
        }

        elseif ($_GET['action'] == 'deletePost') {
            deletePost($_GET['id']);
        }

        elseif ($_GET['action'] == 'listPostsAdmin') {
            if (isset($_GET['action'])) {
                listPostsAdmin();
            }
        }

        if ($_GET['action'] == 'connexion') {
            connexion();
        }

        elseif ($_GET['action']== 'connexionUser') {
            if (isset($_POST['pseudo']) && isset($_POST['pass'])) {
                connexionUser($_POST['pseudo'], $_POST['pass']);
                
            }
            else {
                throw new Exception('Tous les champs ne sont pas remplis !');
            }
        }

        if ($_GET['action'] == 'registration') {
            registration();
        }

        elseif ($_GET['action'] == 'saveUser') {
            if (isset($_POST['pseudo']) && isset($_POST['pass']) && isset($_POST['email'])) {
                saveUser($_POST['pseudo'], $_POST['pass'], $_POST['email']);
            }
            else {
                throw new Exception('Tous les champs ne sont pas remplis !');
            }
        }
        
    }
    else {
        listPosts();
    }
}
catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}