<?php
session_start();
require 'controller/frontend/frontend.php';
require 'controller/backend/backend.php';

try {
    $frontend = new Frontend;
    $backend = new Backend;
    if (isset($frontend->url)) {
        // Si on demande la page d'accueil
        if (strpos($frontend->url,'accueil.php')) 
            $frontend->home();

        // Si on demande la page d'articles
        else if (strpos($frontend->url, 'articles.php'))
            $frontend->articles();

        // Charge l'article demandé et ses commentaires
        else if (strpos($frontend->url, 'article.php'))
        {
            if (isset($_GET['id']) && $_GET['id'] > 0) 
                $frontend->article(); 
            else
                throw new Exception('Aucun ID d\'article envoyé'); 
            // Si l'utilisateur poste un commentaire sur un article
            if (isset($_GET['action']) && $_GET['action'] == 'addComment')
            {
                if (!empty($_POST['author']) && !empty($_POST['comment']))
                    $frontend->addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                else
                    throw new Exception('Tous les champs du commentaire ne sont pas remplis');
            }
        }

        // Si on demande la page biographie
        else if (strpos($frontend->url, 'biographie.php')) 
            $frontend->biography();

        // Si on demande la page de contact
        else if (strpos($frontend->url, 'contact.php')) 
            $frontend->contact();

        // Si on veut s'abonner
        else if (strpos($frontend->url, 'register.php')) 
            $frontend->register();

        // Si on veut se connecter au back-office
        else if (strpos($frontend->url, 'login.php'))
            $frontend->login();
        
        //Checking des identifiants de connexion au back end
        else if (strpos($backend->url, 'auth.php'))
            $backend->auth();
        
        //Déconnexion
        else if (strpos($backend->url, 'logout.php'))
            $backend->logout();

        //dashboard
        else if (strpos($backend->url, 'dashboard.php'))
            $backend->dashboard();

        //nouvel article
        else if (strpos($backend->url, 'create.php'))
        {
            $backend->createArticle();
        }

        // Déconnexion
        else if (strpos($backend->url, 'logout.php'))
        {
            $backend->logout();
        }
        // Par défaut, on charge la page d'accueil
        else {
            $frontend->home();
            }
    }
} catch (Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}
