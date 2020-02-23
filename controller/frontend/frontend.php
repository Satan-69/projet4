<?php
require_once 'model/frontend/Manager.php';
require_once 'model/frontend/ArticleManager.php';

class Frontend
{
    public $url;

    public function __construct()
    {
        $this->getUrl();
    }

    public function getUrl()
    {
        $request = trim($_SERVER['REQUEST_URI'], '/');
        if (isset($request) && !empty($request))
        {
            $this->url = explode('/', $request);
        }
        else
        {
            throw new Exception('invalid URL');
        }
    }

    public function accueil()
    {
        if (isset($this->url))
        {
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

    public function biographie()
    {
        if (isset($this->url))
        {
        require 'view/frontend/biographie.php';
        }
    }

    public function contact()
    {
        if (isset($this->url))
        {
        require 'view/frontend/contact.php';
        }
    }

    public function register()
    {
        if (isset($this->url))
        {
        require 'view/frontend/register.php';
        }
    }
}
