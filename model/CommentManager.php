<?php
require_once("model/Manager.php"); // Appel du fichier connexion bdd

class CommentManager extends Manager
{
    // Requête pour afficher les commentaires associés au chapitre / jointure interne pour afficher le pseudo du membre
    public function getComments($postId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT members.pseudo, comments.comment, comments.id, comments.user_id, comments.reported,
        DATE_FORMAT(`comments`.`comment_date`, "%d/%m/%Y à %Hh%imin%ss") AS comment_date_fr 
        FROM members
        INNER JOIN comments
        ON comments.user_id = members.id 
        WHERE post_id = ? 
        ORDER BY comments.comment_date DESC');
        $comments->execute(array($postId));

        return $comments;
    }

    // Requête pour ajouter un commentaire 
    public function postComment($postId, $userId, $comment)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO comments(post_id, user_id, comment, comment_date) VALUES(?, ?, ?, NOW())');
        $affectedLines = $comments->execute(array($postId, $userId, $comment));

        return $affectedLines;
    }

    // Requête pour afficher le commentaire à modifier 
    public function getComment($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE id = ?');
        $req->execute(array($id));
        $comment = $req->fetch();
    
        return $comment;
    }

    // Requête pour modifier le commentaire
    public function updateComment($id, $comment)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE comments SET comment = ?, comment_date = NOW() WHERE id = ?');
        $newComment = $req->execute(array($comment, $id));
        
        return $newComment;
    }

    // Requête pour supprimer un commentaire
    public function deleteComment($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM comments WHERE id = ?');
        $delete= $req->execute(array($id));
   
        return $delete;
    }

    // Requête pour signaler un commentaire
    public function postReport($id) 
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE comments SET reported = 1 WHERE id = ?');
        $report = $req->execute(array($id));

        return $report;
    }

    // Requête pour supprimer le signalement d'un commentaire / gestion administrateur
    public function deleteReport($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE comments SET reported = 0 WHERE id = ?');
        $deleteReported = $req->execute(array($id));

        return $deleteReported;
    }

    // Requête pour afficher les commentaires signalés / gestion administrateur
    public function reportedCommentAdmin()
    {
        $db = $this->dbConnect();
        $reportedComments = $db->query('SELECT members.pseudo, comments.comment, comments.id, comments.user_id, 
        DATE_FORMAT(`comments`.`comment_date`, "%d/%m/%Y à %Hh%imin%ss") AS comment_date_fr
        FROM members
        INNER JOIN comments
        ON comments.user_id = members.id 
        WHERE reported = 1
        ORDER BY comments.comment_date DESC');
        
        return $reportedComments;
    }
}