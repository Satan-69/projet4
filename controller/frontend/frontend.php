<?php

// require 'model.php';

class Frontend
{
    // public function getUrl()
    // {
    //     $url = $_SERVER['SCRIPT_NAME'];

    // }

   public function getAccueil()
   {
       require('view/frontend/accueil.php');
   }

   public function getArticles()
   {
       require('view/frontend/articles.php');
   }
}