<?php
require_once("model/Manager.php");

class PostManager extends Manager
{
    public function getPosts()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, author, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT 0, 10');

        return $req;
    }

    public function getPost($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, author, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE id = ?');
        $req->execute(array($postId));
        $post = $req->fetch();

        return $post;
    }

    public function newPost($title, $author, $content)
    {
        $db = $this->dbConnect();
        $posts = $db->prepare('INSERT INTO posts(title, author, content, creation_date) VALUES(?, ?, ?, NOW())');
        $posts->execute(array($title, $author, $content));
    
        return $db->lastInsertId();
    }

    public function updatePost($id, $title, $author, $content)
    {
        $db = $this->dbConnect();
        $posts = $db->prepare('UPDATE posts SET title = ?, author = ?, content= ? WHERE id = ?');
        $posts->execute(array($title, $author, $content, $id));
    }

    public function deletePost($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM posts WHERE id = ?');
        $deletedLines = $req->execute(array($id));

        return $deletedLines;
    }

}

