<?php

// Chargement des classes
require_once('model/PostManager.php');
require_once('model/CommentManager.php');

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

function viewComment()
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

function addPost ($title, $author, $content)
{
    $postManager = new PostManager();

    $id = $postManager->newPost($title, $author, $content);
    
    if ($id === false) {
        throw new Exeption('Impossible d\'ajouter le post !');
    }
    else {
        header('Location: index.php?action=post&id=' . $id);
    }
}

function viewPost ()
{
    $postManager = new PostManager();

    require('view/frontend/editPostView.php');
}

function updatePost ($title, $content)
{
    $postManager = new PostManager();

    $id = $postManager ->editPost($title, $content);

    if ($id === false) {
        throw new Exeption('Impossible de modifier le chapitre !');
    }
    else {
        header('location: index.php?action=post&id=' .$id);
    }
}







