<?php

class Admin 
{
    // Méthode pour afficher tous les chapitres
    public function listPostsAdmin()
    {
        if(isset($_SESSION['admin']) && $_SESSION['admin'] == true) { // Sécurité pour que uniquement l'admin puisse voir la liste de la gestion des chapitres

            $postManager = new PostManager(); // Création d'un objet
             
            $posts = $postManager->getPosts(); // Appel d'une fonction de cet objet

            require('view/frontend/listPostsAdmin.php');
        }
    }

    // Méthode / page pour ajouter un chapitre
    public function viewAddPost ()
    {
        if(isset($_SESSION['admin']) && $_SESSION['admin'] == true) { // Sécurité pour que uniquement l'admin puisse ajouter un chapitre
            
            require('view/frontend/addPostView.php');
        }
    }

    // Méthode pour ajouter un chapitre
    public function addPost ($userId, $title, $content)
    { 
        if(isset($_SESSION['admin']) && $_SESSION['admin'] == true) { // Sécurité pour que uniquement l'admin puisse ajouter un chapitre

            $postManager = new PostManager();
            
            $id = $postManager->newPost($userId, $title, $content);
            
            if ($id === false) {
                throw new Exeption('Impossible d\'ajouter le post !');
            }
            else {
                header('Location: index.php?action=listPostsAdmin'); 
            }
        }
    }

    // Méthode pour afficher le chapitre à modifier
    public function viewEditPost ()
    {
        if(isset($_SESSION['admin']) && $_SESSION['admin'] == true) { // Sécurité pour que uniquement l'admin puisse modifier un chapitre

            $postManager = new PostManager();
            
            $post = $postManager->getPost($_GET['id']);

            require('view/frontend/editPostView.php');
        }
    }

    // Méthode pour modifier un chapitre
    public function editPost ($id, $title, $content)
    {
        if(isset($_SESSION['admin']) && $_SESSION['admin'] == true) { // Sécurité pour que uniquement l'admin puisse modifier un chapitre

            $postManager = new PostManager();
            
            $postManager->updatePost($id, $title, $content);
            
            header('location: index.php?action=listPostsAdmin');
        }
    }

    // Méthode pour supprimer un chapitre
    public function deletePost($id)
    {
        if(isset($_SESSION['admin']) && $_SESSION['admin'] == true) { // Sécurité pour que uniquement l'admin puisse supprimer un chapitre

            $postManager = new PostManager();
            
            $deletedLines = $postManager->deletePost($id);

            header('Location: index.php?action=listPostsAdmin');
        }
    }

    // Méthode pour afficher le/les commentaires signalés
    public function reportedCommentAdmin()
    {
        if(isset($_SESSION['admin']) && $_SESSION['admin'] == true) { // Sécurité pour que uniquement l'admin puisse voir la liste de la gestion des commentaires signalés
            
            $commentManager = new CommentManager();
            
            $reportedComments = $commentManager->reportedCommentAdmin();
            
            require('view/frontend/reportedCommentAdmin.php');
        }
    }

    // Méthode pour supprimer le signalement d'un commentaire
    public function deleteReport($id)
    {
        if(isset($_SESSION['admin']) && $_SESSION['admin'] == true) { // Sécurité pour que uniquement l'admin puisse supprimer un commentaire signalé

            $commentManager = new CommentManager();

            $deleteReported = $commentManager->deleteReport($id);

            header('Location: index.php?action=reportedCommentAdmin');
        }
    }
}