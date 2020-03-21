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
                unset($_COOKIE['pseudo']);
                setcookie('pseudo', '', time() - 3600);
                unset($_COOKIE['password']);
                setcookie('password', '', time() - 3600);
                session_unset();
                session_destroy();
                echo '<body onLoad="alert(\'Vous avez bien été déconnecté\')">';
                echo '<meta http-equiv="refresh" content="0;URL=accueil.php">';
            }
            else
                throw new Exception('Pas d\'identifiants renseignés');
        }
    }

    public function login()
    {
        if (isset($this->url))
        {
            if (isset($_COOKIE['pseudo']) && isset($_COOKIE['password']))
            {
                $userManager = new UserManager();
                $user = $userManager->getUser($_COOKIE['pseudo']);
                if ($user)
                {
                    $name = $user['pseudo'];
                    $password = $user['passwd'];

                    if($name == $_COOKIE['pseudo'] && password_verify($_COOKIE['password'], $password))
                    {                    
                        $_SESSION['name'] = $_COOKIE['pseudo'];
                        $_SESSION['password'] = $_COOKIE['password'];
                        $this->dashboard();
                    }
                }
                else 
                {
                    $form = new Form;
                    require 'view/frontend/login.php';
                }
            }
            else 
            {
                $form = new Form;
                require 'view/frontend/login.php';
            }
        }
    }
    
    public function dashboard()
    {
        if (isset($this->url))
        {
            if (!isset($_SESSION['name']) && !isset($_SESSION['password']))
            {
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['recaptcha'])) 
                {
                    // Build POST request:
                    $secret_key = '6LevuuIUAAAAALxQD3CTY5fkm1GksYPgjyqTCp6_';
                    $recaptcha_response = $_POST['recaptcha'];
                
                    // Make and decode POST request:
                    $recaptcha = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret_key . '&response=' . $recaptcha_response);
                    $recaptcha = json_decode($recaptcha);
                
                    // Take action based on the score returned:
                    if ($recaptcha->score >= 0.7) // run the login check
                    {
                        if (isset($_POST['name']) && !empty($_POST['name']) && isset($_POST['password']) && !empty($_POST['password']))
                        {
                            $userManager = new UserManager();
                            $user = $userManager->getUser($_POST['name']);
                            if ($user)
                            {
                                $name = $user['pseudo'];
                                $password = $user['passwd'];
                                if($name == $_POST['name'] && password_verify($_POST['password'], $password))
                                {
                                    $_SESSION['name'] = $_POST['name'];
                                    $_SESSION['password'] = $_POST['password'];
                                    setcookie('pseudo', $_SESSION['name'], time() + 365*24*60, null, null, false, true);
                                    setcookie('password',$_SESSION['password'], time() + 365*24*60, null, null, false, true);
                
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
                            {
                                echo '<body onLoad="alert(\'Mauvais identifiants !\')">';
                                echo '<meta http-equiv="refresh" content="0;URL=login.php">';
                            }
                        }
                        else
                            throw new Exception('Veuillez renseigner votre nom et votre mot de passe');
                    }
                    else 
                        throw new Exception('robot');
                }
                else
                    throw new Exception('Merci de vous réidentifier');   
            }
            else
                $articleManager = new ArticleManager;
                $req = $articleManager->getArticles();
                require 'view/backend/dashboard.php';
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

    public function articleBackend()
    {
        if (isset($this->url))
        {
            if (isset($_SESSION['name']) && isset($_SESSION['password']))
            {
                $articleManager = new ArticleManager;
                $commentManager = new CommentManager;
                $article = $articleManager->getArticle($_GET['id']);
                $comments = $commentManager->getComments($_GET['id']);

                require 'view/backend/articleBackend.php';
            }
        }
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

    public function modify()
    {
        if (isset($this->url))
        {
            if (isset($_SESSION['name']) && isset($_SESSION['password']))
            {
                $articleManager = new ArticleManager;
                if(isset($_POST['delete']))
                {
                    $articleManager->deleteArticle($_GET['id']);
                    header('Location: dashboard.php');
                }
                else if (isset($_POST['update']))
                {
                    header('Location: dashboard.php');
                }
            }
            else
                throw new Exception('Pas d\'identifiants renseignés');
        }
    }

}