<?php
require_once 'Manager.php';

class CommentManager extends Manager
{
    public function getComments($postId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, author, comment, signaled, DATE_FORMAT(date_posted, \'%d/%m/%Y, %Hh%i\') as date_posted FROM comments WHERE post_id = ? ORDER BY date_posted DESC');
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
        $req = $db->prepare('DELETE FROM comments WHERE post_id = :postId');
        $req->execute(array('postId' => $postId));
    }

    public function deleteComment($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM comments WHERE id = :id');
        $req->execute(array('id' => $id));
    }

    public function signal($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE comments SET signaled = :signaled, date_signaled = NOW() WHERE id = :id');
        $req->execute(array(
            'signaled' => 'yes',
            'id' => $id));
    }

    public function getSignaledComments()
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, author, comment, DATE_FORMAT(date_posted, \'%d/%m/%Y, %Hh%i\') as date_posted, DATE_FORMAT(date_signaled, \'%d/%m/%Y, %Hh%i\') as date_signaled FROM comments WHERE signaled = :signaled ORDER BY date_signaled DESC');
        $req->execute(array(
            'signaled' => 'yes'
        ));

        return $req;
    }

    public function countSignaledComments()
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT COUNT(*) as signaled FROM comments WHERE signaled = :signaled');
        $req->execute(array(
            'signaled' => 'yes'
        ));

        return $req->fetch();
    }

    public function deleteSignaledComments()
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM comments WHERE signaled = :signaled');
        $req->execute(array(
            'signaled' => 'yes'
        ));
    }

    public function moderateSignaledComment($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE comments SET signaled = :signaled WHERE id = :id');
        $req->execute(array(
            'signaled' => 'ok',
            'id' => $id
        ));
    }
}
