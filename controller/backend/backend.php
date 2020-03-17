<?php
require_once 'lib/form.php';
require_once 'model/frontend/UserManager.php';
require_once 'model/frontend/ArticleManager.php';

class Backend
{
    public $url;

    public function __construct()
    {
        $this->getUrl();
    }

    public function getUrl()
    {
        $request = $_SERVER['REQUEST_URI'];
        if (isset($request) && !empty($request))
            $this->url = $request;
        else
            throw new Exception('invalid URL');
    }

    public function auth()
    {
        if (isset($this->url))
        {
            if (isset($_POST['name']) && !empty($_POST['name']) && isset($_POST['password']) && !empty($_POST['password']))
            {
                $userManager = new UserManager();
                $user = $userManager->getUser($_POST['name']);
                $name = $user['pseudo'];
                $password = $user['passwd'];

                if($name == $_POST['name'] && password_verify($_POST['password'], $password))
                {
                    $_SESSION['name'] = $_POST['name'];
                    $_SESSION['password'] = $_POST['password'];
                    header('Location: dashboard.php');
                }
                else
                {
                    echo '<body onLoad="alert(\'Mauvais identifiants !\')">';
                    echo '<meta http-equiv="refresh" content="0;URL=login.php">';
                }
            }
            else
            {
                throw new Exception('Veuillez renseigner votre nom et votre mot de passe');
            }
        }
    }

    public function logout()
    {
        if (isset($this->url))
        {
            session_unset();
            session_destroy();
            echo '<body onLoad="alert(\'Vous avez bien été déconnecté\')">';
            echo '<meta http-equiv="refresh" content="0;URL=accueil.php">';
        }
    }

    public function dashboard()
    {
        if (isset($this->url))
        {   
            $articleManager = new ArticleManager;
            $req = $articleManager->getArticles();
            require 'view/backend/dashboard.php';
        }
    }

    public function write()
    {
        if (isset($this->url))  
            require "view/backend/write.php";
    }

    public function newArticle($title, $textcontent)
    {
        if (isset($this->url))
        {
            if (isset($_POST['title']) && !empty($_POST['title']) && isset($_POST['textcontent']) && !empty($_POST['textcontent']))
            {
                $articleManager = new ArticleManager;
                $input = $articleManager->postArticle($title, $textcontent);

                if ($input === false)
                    throw new Exception('Impossible d\'ajouter le contenu');
                else
                    header('Location: dashboard.php');
            }
            else
            throw new Exception('Veuillez renseigner le titre ET le contenu !');
        }
    }

}