<?php

class UserManager extends Manager
{
    public function getUser($name)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT pseudo, passwd, ranked FROM users WHERE pseudo = ?');
        $req->execute(array($name));
        $res = $req->fetch();

        return $res;
    }
}