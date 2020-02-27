<?php
session_start();
require 'controller/frontend/frontend.php';
// require('controller/backend/backend.php');

try {
    $controller = new Frontend;
    if (isset($controller->url)) {
        // Si on demande la page d'accueil
        if (strpos($controller->url,'accueil.php')) 
            $controller->home();

        // Si on demande la page d'articles
        else if (strpos($controller->url, 'articles.php'))
            $controller->articles();

        // Charge l'article demandé et ses commentaires
        else if (strpos($controller->url, 'article.php'))
        {
            if (isset($_GET['id']) && $_GET['id'] > 0) 
                $controller->article(); 
            else
                throw new Exception('Aucun ID d\'article envoyé'); 
            // Si l'utilisateur poste un commentaire sur un article
            if (isset($_GET['action']) && $_GET['action'] == 'addComment')
            {
                if (!empty($_POST['author']) && !empty($_POST['comment']))
                    $controller->addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                else
                    throw new Exception('Tous les champs du commentaire ne sont pas remplis');
            }
        }

        // Si on demande la page biographie
        else if (strpos($controller->url, 'biographie.php')) 
            $controller->biography();

        // Si on demande la page de contact
        else if (strpos($controller->url, 'contact.php')) 
            $controller->contact();
            
        //     // Si on veut se connecter au back-office
        //     else if (isset ($_GET['admin.php']))
        //     {

        //     }
        // Si on veut s'abonner
        else if (strpos($controller->url, 'register.php')) 
            $controller->register();


        // Par défaut, on charge la page d'accueil
        else {
            $controller->home();
            }
    }
} catch (Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}
