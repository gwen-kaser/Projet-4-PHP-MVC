<?php
require_once('model/PostManager.php');
require_once('model/CommentManager.php');

// Affichage des articles, accueil
function listPosts()
{
    $postManager = new PostManager(); // Création d'un objet
    
    $posts = $postManager->getPosts(); // Appel d'une fonction de cet objet

    require('view/frontend/listPostsView.php');
}

// Méthode pour afficher un article avec le/les commentaires associés
function post()
{
    $postManager = new PostManager();
    $commentManager = new CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);

    require('view/frontend/postView.php');
}

// Page pour ajouter un commentaire
function viewAddComment()
{
    require('view/frontend/addCommentView.php');
}

// Méthode pour ajouter un commentaire
function addComment($postId, $userId, $comment)
{
    if(!isset($_SESSION['id'])) { // Sécurité pour que l'utilisateur soit bien un membre sinon dirigé vers la page de connexion
        header('Location: index.php?action=connexion');
        die();
    }
    
    $commentManager = new CommentManager();

    $affectedLines = $commentManager->postComment($postId, $userId, $comment);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=post&id=' . $postId);
    }
}

// Page pour modifier un commentaire + récupérer celui-ci
function viewEditComment()
{
    $commentManager = new CommentManager();

    $comment = $commentManager->getComment($_GET['id']);

    require('view/frontend/editCommentView.php');
}

// Méthode pour modifier un commentaire 
function editComment($id, $comment)
{
    if(!isset($_SESSION['id'])) { // Sécurité pour que l'utilisateur soit bien un membre sinon dirigé vers la page de connexion
        header('Location: index.php?action=connexion');
        die();
    }
    if(isset($_SESSION['id'])) { // Sécurité bouton modifié uniquement pour l'administrateur et le membre qui à posté le commentaire 
        if(isset($_SESSION['id']) == ($comment['user_id']) OR $_SESSION['admin'] == true) {

            $commentManager =  new CommentManager();

            $newComment = $commentManager->updateComment($id, $comment);
                
            if ($newComment == false) {
                throw new Exeption('Impossible de modifier le commentaire !');
            }
            else {
                echo 'commentaire :' . $_POST['comment'];
                header('Location: index.php?action=post&id=' . $_GET['postId']);
            }
        }
    }
}

// Méthode pour supprimer un commentaire
function deleteCom($id)
{
    if(!isset($_SESSION['id'])) { // Sécurité pour que l'utilisateur soit bien un membre sinon dirigé vers la page de connexion
        header('Location: index.php?action=connexion');
        die();
    }
    if(isset($_SESSION['id'])) { // Sécurité bouton supprimé uniquement pour l'administrateur et le membre qui à posté le commentaire
        if(isset($_SESSION['id']) == ($comment['user_id']) OR $_SESSION['admin'] == true) {

            $commentManager = new CommentManager();

            $delete = $commentManager->deleteComment($id);

            header('Location: index.php?action=post&id=' . $_GET['postId']);
        }
    }
}

// Méthode pour signaler un commentaire 
function postReport($id, $postId)
{
    $commentManager = new CommentManager();

    $report = $commentManager->postReport($id);

    header('Location: index.php?action=post&id='. $postId);
}