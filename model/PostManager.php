<?php

require_once("model/Manager.php");

class PostManager extends Manager
{
    // Requête pour afficher les chapitres / page d'acceuil + gestion administrateur
    public function getPosts()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT members.pseudo, posts.id, posts.title, posts.user_id, posts.content, 
        DATE_FORMAT(`posts`.`created_date`, "%d/%m/%Y à %Hh%imin%ss") AS created_date_fr 
        FROM members 
        INNER JOIN posts
        ON posts.user_id = members.id
        ORDER BY posts.created_date DESC LIMIT 0, 10');
        
        return $req;
    }

    // Requête pour afficher un chapitre / afficher le chapitre à modifier
    public function getPost($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT members.pseudo, posts.id, posts.title, posts.user_id, posts.content, 
        DATE_FORMAT(`posts`.`created_date`, "%d/%m/%Y à %Hh%imin%ss") AS created_date_fr 
        FROM members
        INNER JOIN posts
        ON posts.user_id = members.id
        WHERE posts.id = ?');
        $req->execute(array($postId));
        $post = $req->fetch();

        return $post;
    }

    // Requête pour ajouter un chapitre / gestion administrateur
    public function newPost($userId, $title, $content)
    {
        $db = $this->dbConnect();
        $posts = $db->prepare('INSERT INTO posts(title, user_id, content, created_date) VALUES(?, ?, ?, NOW())');
        $posts->execute(array($title, $userId, $content));
    
        return $db->lastInsertId();
    }

    // Requête pour modifier un chapitres / gestion adminidtrateur
    public function updatePost($id, $title, $content)
    {
        $db = $this->dbConnect();
        $posts = $db->prepare('UPDATE posts SET title = ?, content= ? WHERE id = ?');
        $posts->execute(array($title, $content, $id));
    }

    // Requête pour supprimer un chapitre / gestion administrateur
    public function deletePost($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM posts WHERE id = ?');
        $deletedLines = $req->execute(array($id));

        return $deletedLines;
    }

}

