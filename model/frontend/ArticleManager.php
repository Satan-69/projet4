<?php
require_once 'Manager.php';

class ArticleManager extends Manager
{
    public function getArticles()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, author, title, content, DATE_FORMAT(date_posted, \'%d/%m/%Y, %Hh%i\') AS date_posted FROM articles ORDER BY date_posted ASC');

        return $req;
    }

    public function getArticle($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, author, title, content, date_posted FROM articles WHERE id = ?');
        $req->execute(array($id));

        $article = $req->fetch();

        return $article;
    }

    public function getLastArticle()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT author, title, content, id, DATE_FORMAT(date_posted, \'%d/%m/%Y, %Hh%i\') AS date_posted FROM articles ORDER BY id DESC LIMIT 1');
        
        $article = $req->fetch();
        return $article;
    }
}