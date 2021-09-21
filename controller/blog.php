<?php

class Blog 
{
    // Méthode pour afficher les chapitres / page d'accueil
    public function listPosts()
    {
        $postManager = new PostManager(); 
        $posts = $postManager->getPosts(); 

        require('view/frontend/listPostsView.php');
    }

    // Méthode pour afficher un chapitre avec le/les commentaires associés
    public function post()
    {
        $postManager = new PostManager();
        $commentManager = new CommentManager();

        $post = $postManager->getPost($_GET['id']);
        
        if(!$post) { // Sécurité si le chapitre n'existe pas redirection vers la page d'accueil
            header('Location: index.php?action=listPosts');
        }
        
        $comments = $commentManager->getComments($_GET['id']);

        require('view/frontend/postView.php');
    }

    // Méthode / page pour ajouter un commentaire
    public function viewAddComment()
    {
        if(!isset($_SESSION['id'])) { // Sécurité si ce n'est pas un membre redirection vers la page de connexion
            header('Location: index.php?action=connexion');
            die();
        }
            require('view/frontend/addCommentView.php');
    }

    // Méthode pour ajouter un commentaire
    public function addComment($postId, $userId, $comment)
    {
        if(!isset($_SESSION['id'])) { // Sécurité si ce n'est pas un membre redirection vers la page de connexion
            header('Location: index.php?action=connexion');
            die();
        }
            $commentManager = new CommentManager();

            $affectedLines = $commentManager->postComment($postId, $userId, $comment);

        if($affectedLines === false) {
            throw new Exception('Impossible d\'ajouter le commentaire !');
        }
        else {
            header('Location: index.php?action=post&id=' . $postId);
        }
    }

    // Méthode pour récupérer le commentaire à modifier
    public function viewEditComment()
    {
        if(!isset($_SESSION['id'])) { // Sécurité si ce n'est pas un membre redirection vers la page de connexion
            header('Location: index.php?action=connexion');
            die();
        }
        
        if (isset($_SESSION['id'])) { // Vérification si l'utilisateur est connecté
            $commentManager = new CommentManager();
            $comment = $commentManager->getComment($_GET['id']); 
            
            if (($_SESSION['id']) == ($comment['user_id']) || $_SESSION['admin'] == true) { // Sécurité bouton modifié uniquement visible par l'administrateur et le membre qui à posté le commentaire
                require('view/frontend/editCommentView.php');
            }
        }
    }

    // Méthode pour modifier un commentaire 
    public function editComment($id, $comment)
    {
        if(!isset($_SESSION['id'])) { // Sécurité si ce n'est pas un membre redirection vers la page de connexion
            header('Location: index.php?action=connexion');
            die();
        }

        if (isset($_SESSION['id'])) { // Vérification si l'utilisateur est connecté
            $commentManager = new CommentManager();
            $oldComment = $commentManager->getComment($id); 
            
            if(!$oldComment) { // Sécurité si le commentaire n'existe pas ou que le membre n'est pas l'auteur redirection vers la page d'accueil
                header('Location: index.php?action=listPostsView');
            }
            
            if (($_SESSION['id']) == ($oldComment['user_id']) || $_SESSION['admin'] == true) { // Sécurité bouton modifié uniquement visible par l'administrateur et le membre qui à posté le commentaire 
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
    public function deleteCom($id)
    {
        if(!isset($_SESSION['id'])) { // Sécurité si ce n'est pas un membre redirection vers la page de connexion
            header('Location: index.php?action=connexion');
            die();
        }
        
        if (isset($_SESSION['id'])) { // Vérification si l'utilisateur est connecté
            $commentManager = new CommentManager();
            $oldComment = $commentManager->getComment($id); 
            
            if (($_SESSION['id']) == ($oldComment['user_id']) || $_SESSION['admin'] == true) { // Sécurité bouton supprimé uniquement visible par l'administrateur et le membre qui à posté le commentaire
                $delete = $commentManager->deleteComment($id);
        
                if (isset($_SESSION['admin']) && $_SESSION['admin'] == false) { // Redirection page chapitre si ce n'est pas l'administrateur qui supprime le commentaire
                    header('Location: index.php?action=post&id=' . $_GET['postId']);
                }
                elseif (isset($_SESSION['admin']) && $_SESSION['admin'] == true) { // Redirection page gestion commentaires adminitrateur si celui-ci supprime un commentaire
                    header('Location: index.php?action=reportedCommentAdmin');
                }
            }
        }
    }

    // Méthode pour signaler un commentaire 
    public function postReport($id, $postId)
    {
        $commentManager = new CommentManager();

        $report = $commentManager->postReport($id);

        header('Location: index.php?action=post&id='. $postId);
    }
}