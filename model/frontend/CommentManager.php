<?php
require_once 'Manager.php';

class CommentManager extends Manager
{
    public function getComments($postId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, author, comment, DATE_FORMAT(date_posted, \'%d/%m/%Y, %Hh%i\') as date_posted FROM comments WHERE post_id = ? ORDER BY date_posted DESC');
        $comments->execute(array($postId));

        return $comments;
    }

    public function postComment($postId, $author, $comment)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO comments(post_id, author, comment, date_posted) VALUES(?, ?, ?, NOW())');
        $input = $comments->execute(array($postId, $author, $comment));

        return $input;
    }

    public function deleteComments($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE from comments WHERE post_id = :postId');
        $req->execute(array('postId' => $postId));
    }
}
