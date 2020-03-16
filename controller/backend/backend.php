<?php
require_once 'lib/form.php';
require_once 'model/frontend/UserManager.php';

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
            if (isset($_POST['name']) && strlen($_POST['name']) > 0 && isset($_POST['password']) && strlen($_POST['password']) > 0)
            {
                $userManager = new UserManager();
                $user = $userManager->getUser($_POST['name']);
                $name = $user['pseudo'];
                $password = $user['passwd'];
                $pass_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

                if($name == $_POST['name'] && $password == $_POST['password'])
                {
                    $_SESSION['name'] = $_POST['name'];
                    $_SESSION['password'] = $_POST['password'];
                    header('Location: dashboard.php');
                }
                else
                {
                    
                    echo '<body onLoad="alert(\'Mauvais identifiants !\')">';
                    echo '<meta http-equiv="refresh" content="0;URL=accueil.php">';
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
            require 'view/backend/dashboard.php';
    }

    public function createArticle()
    {
        if (isset($this->url))
            require "view/backend/create.php";
    }
}