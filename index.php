<?php
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
        
        elseif ($_GET['action'] == 'viewComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                viewComment();
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
        
        elseif ($_GET['action'] == 'addPost') {
            if (!empty($_POST['title']) && !empty($_POST['author']) && !empty($_POST['content'])) {
                addPost($_POST['title'], $_POST['author'], $_POST['content']);
            }
            else {
                throw new Exception('Tous les champs ne sont pas remplis !');
            }
        }

        if ($_GET['action'] == 'viewPost') {
            viewPost();
        }

        elseif ($_GET['action'] == 'updatePost') {
            if (!empty($_POST['title']) && !empty($_POST['content'])) {
                updatePost($_POST['title'], $_POST['content']);
            }
            else {
                throw new Exeption('Tous les champs ne sont pas remplis !');
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