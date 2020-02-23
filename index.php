<?php
session_start();
require 'controller/frontend/frontend.php';
// require('controller/backend/backend.php');

try {
    $controller = new Frontend;
    if (isset($controller->url)) {
        // Si on demande la page d'accueil
        if (strpos($controller->url,'accueil.php')) 
        {
            $controller->accueil();
        }
        // Si on demande la page d'articles
        else if (strpos($controller->url, 'articles.php'))
        {
            $controller->articles();
        }
        // Charge l'article demandé et ses commentaires
        else if (strpos($controller->url, 'article.php'))
        {
            if (isset($_GET['id']) && $_GET['id'] > 0)
            {
                $controller->article();
            }
            else
            {
                throw new Exception('Aucun ID d\'article envoyé');
            }
        }
        // Si on demande la page biographie
        else if (strpos($controller->url, 'biographie.php')) 
        {
            $controller->biographie();
        }
        // Si on demande la page de contact
        else if (strpos($controller->url, 'contact.php')) 
        {
            $controller->contact();
        }
        //     // Si on veut se connecter au back-office
        //     else if (isset ($_GET['admin.php']))
        //     {

        //     }
        // Si on veut s'abonner
        else if (strpos($controller->url, 'register.php')) 
        {
            $controller->register();
        }
        //         // Si l'utilisateur poste un commentaire sur un article
        //         else if ($_GET['action'] == 'addComment')
        //         {
        //             if (isset($_GET['id']) AND $_GET['id'] > 0)
        //             {
        //                 if (!empty($_POST['author']) AND !empty($_POST['comment']))
        //                 {
        //                     addComment($_GET['id'], $_POST['author'], $_POST['comment']);
        //                 }
        //                 else
        //                 {
        //                     throw new Exception('Tous les champs du commentaires ne sont pas remplis');
        //                 }
        //             }
        //             else
        //             {
        //                 throw new Exception('Aucun ID de billet envoyé');
        //             }
        //         }
        //     }
        // Par défaut, on charge la page d'accueil
        else {
            $controller->accueil();
            }
    }
} catch (Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}
