<?php
require_once 'model/frontend/Manager.php';
require_once 'model/frontend/ArticleManager.php';
require_once 'model/frontend/CommentManager.php';
require_once 'model/frontend/UserManager.php';
require_once 'lib/form.php';

class Frontend
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
                $e = 'La page demandée n\'existe pas.';
            else if ($message == 'emptyInputs')
                $e = 'Tous les champs du commentaire ne sont pas remplis.'; 
            else if ($message == 'robot')
                $e = 'you are a robot';

            require 'view/frontend/error.php';
        }
    }

    public function home()
    {
        if (isset($this->url))
        {
            $articleManager = new ArticleManager;
            $article = $articleManager->getLastArticle();
            
            require 'view/frontend/accueil.php';
        }
    }

    public function articles()
    {
        if (isset($this->url))
        {
            $articleManager = new ArticleManager;
            $req = $articleManager->getArticles();

            require 'view/frontend/articles.php';
        }
    }

    public function article()
    {
        if (isset($this->url))
        {
            try {
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                $articleManager = new ArticleManager;
                $commentManager = new CommentManager;
                $article = $articleManager->getArticle($_GET['id']);
                $comments = $commentManager->getComments($_GET['id']);

                require 'view/frontend/article.php';
                }  else
                    throw new Exception('404');
            } catch(Exception $e) {
                $this->error($e);
            }
        }
    }

    public function biography()
    {
        if (isset($this->url))
            require 'view/frontend/biography.php';
    }

    public function contact()
    {
        if (isset($this->url))
        {
            $form = new Form;
            require 'view/frontend/contact.php';
        }
    }

    public function mentions()
    {
        if (isset($this->url))
            require 'view/frontend/mentions.php';
        
    }

    public function sitemap()
    {
        if (isset($this->url))
            require 'view/frontend/sitemap.php';
    }
    
    public function addComment($postId, $author, $comment)
    {
        try {
            if (isset($_POST['author']) && !empty($_POST['author']) && isset($_POST['comment']) && !empty($_POST['comment']))
            {
                $commentManager = new CommentManager;    
                $input = $commentManager->postComment($postId, $author, $comment);
                header('Location: article.php?id='.$postId);
            }
            else
                throw new Exception('emptyInputs');
        } catch(Exception $e) {
            $this->error($e);
        }
    }
    // Fonction qui fait appel à la vérification de l'utilisateur (si robot ou non) par le service de recaptcha de Google
    private function recaptcha()
    {
        try {
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
                else
                    throw new Exception('robot');
            }
        } catch(Exception $e) {
            $this->error($e);
        }
    }

    public function mailto()
    {
        try {
            if ($this->recaptcha())
            {
                if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['subject'])  && isset($_POST['message'])
                    && !empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['subject']) && !empty($_POST['message']))
                    {
                        $encoding = "utf-8";
                        $to = 'hopfner.charles@gmail.com';
                        $name = htmlspecialchars($_POST['name']);
                        $email = htmlspecialchars($_POST['email']);
                        $subject = htmlspecialchars($_POST['subject']);
                        $msg = wordwrap(htmlspecialchars($_POST['message']), 70);
                        $header = "Content-type: text/plain; charset=".$encoding."\n";
                        $header .= "From: ".$name." <".$email.">\n";
                        $header .= "MIME-Version: 1.0\n";
                        $header .= "Content-Transfer-Encoding: 8bit\n";
                        $header .= "Date: ".date("r (T)")."\n";
                        mail($to, $subject, $msg, $header);
                        header('Location: contact.php');
                    }
                else
                    throw new Exception('emptyInputs');
            }
        } catch (Exception $e) {
            $this->errror($e);
        }
    }

    public function signalComment($id, $postId)
    {
        $commentManager = new CommentManager;
        $commentManager->signal($id);
        header('Location: article.php?id='.$postId);    
    }
}

