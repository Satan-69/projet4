<?php
require_once 'Manager.php';

class ArticleManager extends Manager
{
    public function getArticles()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, author, title, content, DATE_FORMAT(date_posted, \'%d/%m/%Y\') AS date_posted, DATE_FORMAT(date_updated, \'%d/%m/%Y\') AS date_updated FROM articles ORDER BY id ASC');

        return $req;
    }

    public function getArticle($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, author, title, content, DATE_FORMAT(date_posted, \'%d/%m/%Y\') AS date_posted, DATE_FORMAT(date_updated, \'%d/%m/%Y\') AS date_updated FROM articles WHERE id = ?');
        $req->execute(array($id));

        $article = $req->fetch();

        return $article;
    }

    public function getLastArticle()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT author, title, content, id, DATE_FORMAT(date_posted, \'%d/%m/%Y\') AS date_posted, DATE_FORMAT(date_updated, \'%d/%m/%Y\') AS date_updated FROM articles ORDER BY id DESC LIMIT 1');
        $article = $req->fetch();

        return $article;
    }

    public function postArticle($title, $textcontent)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO articles(title, content, date_posted) VALUES(?, ?, NOW())');
        $input = $req->execute(array($title, $textcontent));

        return $input;
    }

    public function deleteArticle($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE from articles WHERE id = :id');
        $req->execute(array('id' => $id));
    }

    public function updateArticle($title, $textcontent, $id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE articles SET title = :title, content = :textcontent, date_updated = NOW() WHERE id = :id');
        $req->execute(array(
            'title' => $title,
            'textcontent' => $textcontent,
            'id' => $id,
        ));
    }

    public function countArticles()
    {
        $db = $this->dbConnect();
        $req= $db->query('SELECT COUNT(*) AS nb FROM articles');

        return $req->fetch();
        
    }
}