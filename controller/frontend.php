<?php

// Chargement des classes
require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/MemberManager.php');

function listPosts()
{
    $postManager = new PostManager(); // Création d'un objet
    
    $posts = $postManager->getPosts(); // Appel d'une fonction de cet objet

    require('view/frontend/listPostsView.php');
}

function post()
{
    $postManager = new PostManager();
    $commentManager = new CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);

    require('view/frontend/postView.php');
}

function viewAddComment()
{
    require('view/frontend/addCommentView.php');
}

function addComment($postId, $author, $comment)
{
    $commentManager = new CommentManager();

    $affectedLines = $commentManager->postComment($postId, $author, $comment);

    if ($affectedLines === false) {
        throw new Exeption('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=post&id=' . $postId);
    }
}

function viewEditComment()
{
    $commentManager = new CommentManager();

    $comment = $commentManager->getComment($_GET['id']);

    require('view/frontend/editCommentView.php');
}

function editComment($id, $comment)
{
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

function deleteCom($id)
{
    $commentManager = new CommentManager();

    $delete = $commentManager->deleteComment($id);

    header('Location: index.php?action=post&id=' . $_GET['postId']);
    
}

function viewAddPost ()
{
    require('view/frontend/addPostView.php');
}

function addPost ($title, $author, $content)
{
    $postManager = new PostManager();

    $id = $postManager->newPost($title, $author, $content);
    
    if ($id === false) {
        throw new Exeption('Impossible d\'ajouter le post !');
    }
    else {
        header('Location: index.php?action=listPostsAdmin'); 
    }
}

function viewEditPost ()
{
    $postManager = new PostManager();

    $post = $postManager->getPost($_GET['id']);

    require('view/frontend/editPostView.php');
}

function editPost ($id, $title, $author, $content)
{
    $postManager = new PostManager();

    $postManager ->updatePost($id, $title, $author, $content);
    
    header('location: index.php?action=listPostsAdmin');
}

function deletePost($id)
{
    $postManager = new PostManager();
    
    $deletedLines = $postManager->deletePost($id);

    header('Location: index.php?action=listPostsAdmin');
}

function listPostsAdmin()
{
    $postManager = new PostManager();

    $posts = $postManager->getPosts();

    require('view/frontend/listPostsAdmin.php');
}

function connexion()
{
    require('view/frontend/connexion.php');
}

function connexionUser($pseudo, $pass)
{
    $memberManager = new MemberManager();
    
    $resultat = $memberManager->connexionUser($pseudo, $pass);
    
    $isPasswordCorrect = password_verify($_POST['pass'], $resultat['pass']);

    if (!$resultat) {
        $errorPseudo = 'Erreur d\'identifiant ou mot de passe';
        require('view/frontend/connexion.php');
    } elseif (!$isPasswordCorrect) {
        $errorPassword = 'Erreur d\'identifiant ou mot de passe';
        require('view/frontend/connexion.php');
    } else {        
        $_SESSION['id'] = $resultat['id'];
        $_SESSION['pseudo'] = $_POST['pseudo'];
        header('location: index.php?action=listPosts');
    }
}


