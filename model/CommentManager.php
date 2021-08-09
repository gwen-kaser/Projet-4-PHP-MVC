<?php
require_once("model/Manager.php");

class CommentManager extends Manager
{
    public function getComments($postId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT membres.pseudo, comments.comment, comments.id, comments.user_id, comments.reported,
        DATE_FORMAT(`comments`.`comment_date`, "%d/%m/%Y à %Hh%imin%ss") AS comment_date_fr 
        FROM membres
        INNER JOIN comments
        ON comments.user_id = membres.id 
        WHERE post_id = ? 
        ORDER BY comments.comment_date DESC');
        $comments->execute(array($postId));

        return $comments;
    }

    public function postComment($postId, $userId, $comment)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO comments(post_id, user_id, comment, comment_date) VALUES(?, ?, ?, NOW())');
        $affectedLines = $comments->execute(array($postId, $userId, $comment));

        return $affectedLines;
    }

    public function getComment($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE id = ?');
        $req->execute(array($id));
        $comment = $req->fetch();
    
        return $comment;
    }

    public function updateComment($id, $comment)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE comments SET comment = ?, comment_date = NOW() WHERE id = ?');
        $newComment = $req->execute(array($comment, $id));
        
        return $newComment;
    }

    public function deleteComment($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM comments WHERE id = ?');
        $delete= $req->execute(array($id));
   
        return $delete;
    }

    public function postReport($id) 
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE comments SET reported = 1 WHERE id = ?');
        $report = $req->execute(array($id));

        return $report;
    }

    public function deleteReport($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE comments SET reported = 0 WHERE id = ?');
        $deleteReported = $req->execute(array($id));

        return $deleteReported;
    }

    public function reportedCommentAdmin()
    {
        $db = $this->dbConnect();
        $reportedComments = $db->query('SELECT membres.pseudo, comments.comment, comments.id, comments.user_id, 
        DATE_FORMAT(`comments`.`comment_date`, "%d/%m/%Y à %Hh%imin%ss") AS comment_date_fr
        FROM membres
        INNER JOIN comments
        ON comments.user_id = membres.id 
        WHERE reported = 1
        ORDER BY comments.comment_date DESC');
        
        return $reportedComments;
    }
}