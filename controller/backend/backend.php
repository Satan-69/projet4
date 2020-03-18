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

    public function logout()
    {
        if (isset($this->url))
        {
            if (isset($_SESSION['name']) && isset($_SESSION['password']))
            {
                session_unset();
                session_destroy();
                echo '<body onLoad="alert(\'Vous avez bien été déconnecté\')">';
                echo '<meta http-equiv="refresh" content="0;URL=accueil.php">';
            }
            else
                throw new Exception('Pas d\'identifiants renseignés');
        }
    }

    public function dashboard()
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

                    $articleManager = new ArticleManager;
                    $req = $articleManager->getArticles();
                    require 'view/backend/dashboard.php';
                }
                else
                {
                    echo '<body onLoad="alert(\'Mauvais identifiants !\')">';
                    echo '<meta http-equiv="refresh" content="0;URL=login.php">';
                }
            }
            else
                throw new Exception('Veuillez renseigner votre nom et votre mot de passe');
        }
    }

    public function write()
    {
        if (isset($this->url))
        {
            if (isset($_SESSION['name']) && isset($_SESSION['password']))
            require "view/backend/write.php";
        }
        else
            throw new Exception('Pas d\'identifiants renseignés');
    }

    public function newArticle($title, $textcontent)
    {
        if (isset($this->url))
        {
            if (isset($_SESSION['name']) && isset($_SESSION['password']))
            {
                if (isset($_POST['title']) && !empty($_POST['title']) && isset($_POST['textcontent']) && !empty($_POST['textcontent']))
                {
                    $articleManager = new ArticleManager;
                    $input = $articleManager->postArticle($title, $textcontent);
                    header('Location: dashboard.php');
                }
                else
                    throw new Exception('Veuillez renseigner le titre ET le contenu !');
            }
            else
                throw new Exception('Pas d\'identifiants renseignés');
        }
    }

}