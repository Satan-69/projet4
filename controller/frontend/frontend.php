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
        $request = $_SERVER['REQUEST_URI'];
        if (isset($request) && !empty($request))
            $this->url = $request;
        else
            throw new Exception('invalid URL');
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
            $articleManager = new ArticleManager;
            $commentManager = new CommentManager;
            $article = $articleManager->getArticle($_GET['id']);
            $comments = $commentManager->getComments($_GET['id']);

            require 'view/frontend/article.php';
        }
    }

    public function biography()
    {
        if (isset($this->url))
            require 'view/frontend/biographie.php';
    }

    public function contact()
    {
        if (isset($this->url))
        {
            $form = new Form;
            require 'view/frontend/contact.php';
        }
    }

    public function register()
    {
        if (isset($this->url))
        {
            $form = new Form;
            require 'view/frontend/register.php';
        }
    }

    public function addComment($postId, $author, $comment)
    {
        if (isset($_POST['author']) && !empty($_POST['author']) && isset($_POST['comment']) && !empty($_POST['comment']))
        {
            $commentManager = new CommentManager;    
            $input = $commentManager->postComment($postId, $author, $comment);
            header('Location: article.php?id='.$postId);
        }
        else
            throw new Exception('Tous les champs du commentaire ne sont pas remplis');
    }

    public function mailto()
    {
        if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['subject'])  && isset($_POST['message'])
            && !empty($_POST['subject']) && !empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['message']))
            {
                $to = 'hopfner.charles@gmail.com';
                $subject = htmlspecialchars($_POST['subject']);
                $msg = wordwrap(htmlspecialchars($_POST['message']), 70);
                $headers = htmlspecialchars('Mail de ' . $_POST['name'] . ', ' .$_POST['email']);
                mail($to, $subject, $msg, $headers);
                header('Location: contact.php');
            }
        else
            throw new Exception('Merci de remplir tous les champs');
    }
}

