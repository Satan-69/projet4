<?php

// require 'model.php';

class Frontend
{
    public $url;

    public function __construct()
    {
        $this->getUrl();
    }

    // On récupère l'url, qu'on découpe suivant les / et on place les morceaux dans un tableau
    public function getUrl()
    {
        $request = trim($_SERVER['REQUEST_URI'], '/');
        if (!empty($request))
        {
            $this->url = explode('/', $request);
            
        }
    }

   public function accueil()
   {
       require('view/frontend/accueil.php');
   }

   public function articles()
   {
       require('view/frontend/articles.php');
   }

   public function biographie()
   {
       require('view/frontend/biographie.php');
   }

   public function contact()
   {
       require('view/frontend/contact.php');
   }

   public function register()
   {
       require('view/frontend/register.php');
   }
}