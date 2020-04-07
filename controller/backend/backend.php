<?php
require_once 'lib/form.php';
require_once 'model/frontend/UserManager.php';
require_once 'model/frontend/ArticleManager.php';
require_once 'model/frontend/CommentManager.php';

class Backend
{
    public $url;
    
    public function __construct()
    {
        $this->getUrl();
    }

    public function getUrl()
    {   
        try {
            $request = $_SERVER['REQUEST_URI'];
            if (isset($request) && !empty($request))
                $this->url = $request;
            else
                throw new Exception('404');
        } catch (Excpetion $e) {
            $this->error($e);
        }
    }

    public function error($e)
    {
        if (isset($this->url))
        {
            $message = $e->getMessage();
            if ($message == '404')
                $e = 'La page demandée n\'existe pas huhu';
            else if ($message == 'emptyInputs')
                $e = 'Tous les champs du commentaire ne sont pas remplis'; 
            else if ($message == 'robot')
                $e = 'you are a robot';

            require 'view/frontend/error.php';
        }
    }

    private function badId()
    {
        echo '<body onLoad="alert(\'Mauvais identifiants !\')">';
        echo '<meta http-equiv="refresh" content="0;URL=login.php">';
        exit();
    }
    
    private function checkingCookies()
    {
        if (isset($_COOKIE['pseudo']) && isset($_COOKIE['loggedin']) && $_COOKIE['loggedin'] == 'true')
        {
            $userManager = new UserManager();
            $user = $userManager->getUser($_COOKIE['pseudo']);
            if ($user)
                if ($user['ranked'] == 'admin')
                    return true;
        }
    }

    public function logout()
    {
        if (isset($this->url))
        {
            if ($this->checkingCookies())
            {
                unset($_COOKIE['pseudo']);
                setcookie('pseudo', '', time() - 3600);
                unset($_COOKIE['loggedin']);
                setcookie('loggedin', '', time() - 3600);
                session_destroy();
                session_unset();
                echo '<body onLoad="alert(\'Vous avez bien été déconnecté\')">';
                echo '<meta http-equiv="refresh" content="0;URL=accueil.php">';
            }
            else
                $this->loginView();
        }
    }

    private function loginView()
    {
        $form = new Form;
        require 'view/frontend/login.php'; 
    }

    public function login()
    {
        if (isset($this->url))
        {
            if ($this->checkingCookies())
                header('Location: dashboard.php');
            else 
                $this->loginView();
        }
    }

    private function dashboardView()
    {
        $articleManager = new ArticleManager;
        $commentManager = new CommentManager;
        $req = $articleManager->getArticles();
        $comments = $commentManager->countSignaledComments();
        require 'view/backend/dashboard.php';
    }

    private function recaptcha()
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
                if ($recaptcha->score >= 0.5) // run the login check
                    return true;
            }
    }
    // Fonction qui checke le login d'admin, et si il est bon, crée les cookies correspondants et redirige sur le dashboard. 
    public function dashboard()
    {
        if (isset($this->url))
        {
            // Si checkingCookies return true, redirige direct sur le dashboard
            if (!$this->checkingCookies())
            {   
                try {
                    if ($this->recaptcha())
                    {
                        if (isset($_POST['name']) && !empty($_POST['name']) && isset($_POST['password']) && !empty($_POST['password']))
                        {
                            $userManager = new UserManager();
                            $user = $userManager->getUser($_POST['name']);
                            if ($user) // On checke si l'user existe bien dans la db
                            {
                                $name = $user['pseudo'];
                                $password = $user['passwd'];
                                if($name == $_POST['name'] && password_verify($_POST['password'], $password))
                                {
                                    setcookie('pseudo', $name, time() + 365*24*60, null, null, false, true);
                                    setcookie('loggedin', 'true', time() + 365*24*60, null, null, false, true);
                                    $this->dashboardView();
                                }
                                else
                                    $this->badId();
                            }
                            else
                                $this->badId();
                        }
                        else
                            $this->badId();
                    }
                    else 
                        throw new Exception('robot');
                } catch(Exception $e)
                {
                    $this->error($e);
                }
            }
            else
                $this->dashboardView();
        }
    }

    public function articleBackend()
    {
        if (isset($this->url))
        {
            if ($this->checkingCookies())
            {
                $articleManager = new ArticleManager;
                $commentManager = new CommentManager;
                $article = $articleManager->getArticle($_GET['id']);
                $comments = $commentManager->getComments($_GET['id']);

                require 'view/backend/articleBackend.php';
            }
        }
    }

    public function signaledComments()
    {
        if (isset($this->url))
        {
            if ($this->checkingCookies())
            {
                $commentManager = new CommentManager;
                $req = $commentManager->getSignaledComments();
                
                require 'view/backend/signaledcomments.php';
            }
        }
    }

    public function deleteComment($id)
    {
        if (isset($this->url))
        {
            if ($this->checkingCookies())
            {
            $commentManager = new CommentManager;
            $commentManager->deleteComment($id);
            if (isset($_POST['articleBackend']))
                header('Location: articleBackend.php?id='.$_GET['postId']);
            else if (isset($_POST['signaledComments']))
                header('Location: signaledComments.php');
            }
        }
    }

    public function deleteSignaledComments()
    {
        if (isset($this->url))
        {
            if ($this->checkingCookies())
            {
                $commentManager = new CommentManager;
                $commentManager->deleteSignaledComments();

                header('Location: dashboard.php');
            }
        }
    }

    public function moderateComment($id)
    {
        if (isset($this->url))
        {
            if ($this->checkingCookies())
            {
            $commentManager = new CommentManager;
            $commentManager->moderateSignaledComment($id);
            if (isset($_POST['articleBackend']))
                header('Location: articleBackend.php?id='.$_GET['postId']);
            else if (isset($_POST['signaledComments']))
                header('Location: signaledComments.php');
            }
        }
    }

    public function write()
    {
        if (isset($this->url))
        {
            if ($this->checkingCookies())
            require "view/backend/write.php";
        }
        else
            $this->loginView();
    }

    public function articlesBackend()
    {
        if (isset($this->url))
        {
            if ($this->checkingCookies()) {
            $articleManager = new ArticleManager;
            $req = $articleManager->getArticles();

            require "view/backend/articlesBackend.php";
            }
            else
                $this->loginView();
        }
        else
            $this->loginView();
    }

    public function newArticle($title, $textcontent)
    {
        if (isset($this->url))
        {
            if ($this->checkingCookies())
            {
                if (isset($_POST['title']) && !empty($_POST['title']) && isset($_POST['textcontent']) && !empty($_POST['textcontent']))
                {
                    $articleManager = new ArticleManager;
                    $input = $articleManager->postArticle($title, nl2br(strip_tags($textcontent)));
                    header('Location: articlesBackend.php');
                }
                else
                    throw new Exception('Veuillez renseigner le titre ET le contenu !');
            }
            else
                $this->loginView();
        }
    }

    public function update($title, $textcontent, $id)
    {
        if (isset($this->url))
        {
            if ($this->checkingCookies())
            {   
                try {
                    if (isset($_GET['id']))
                    {
                        if (isset($_POST['title']) && !empty($_POST['title']) && isset($_POST['textcontent']) && !empty($_POST['textcontent']))
                        {
                            $articleManager = new ArticleManager;
                            $input = $articleManager->updateArticle($title, strip_tags($textcontent), $id);
                            header('Location: articlesBackend.php');
                        }
                        else
                            throw new Exception('emptyInputs');
                    }
                    else
                        throw new Exception('404');
                } catch(Exception $e) {
                    $this->error($e);
                }
            }
            else
                $this->loginView();
        }
    }

    public function modify()
    {
        if (isset($this->url))
        {
            if ($this->checkingCookies())
            {
                $articleManager = new ArticleManager;
                if(isset($_POST['delete']))
                {
                    $commentManager = new CommentManager;
                    $articleManager->deleteArticle($_GET['id']);
                    $commentManager->deleteComments($_GET['id']);

                    header('Location: articlesBackend.php');
                }
                else if (isset($_POST['update']))
                {
                    $article = $articleManager->getArticle($_GET['id']);
                    require "view/backend/edit.php";
                }
            }
            else
                $this->loginView();
        }
    }

}