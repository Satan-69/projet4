<?php

class ArticleManager extends Manager
{
    public function getArticles()
    {
        $db = $this>dbConnect();
        $req = $db->query('SELECT * FROM articles ORDER BY date_posted DESC');

        return $req;
    }

    public function getArticle($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT * FROM articles WHERE id = ?');
        $req->execute(array([$id]));
    }
}