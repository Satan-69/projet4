<?php
session_start();
require 'controller/frontend/frontend.php';
require 'controller/backend/backend.php';

try {
    $frontend = new Frontend;
    $backend = new Backend;
    if (isset($frontend->url)) 
    {
        if (strpos($frontend->url,'accueil.php')) 
            $frontend->home();
            
        else if (strpos($frontend->url, 'articles.php'))
            $frontend->articles();

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

        else if (strpos($frontend->url, 'biographie.php')) 
            $frontend->biography();

        else if (strpos($frontend->url, 'contact.php')) 
            $frontend->contact();

        else if (strpos($frontend->url, 'register.php')) 
            $frontend->register();

        else if (strpos($frontend->url, 'login.php'))
            $frontend->login();
        
        //Checking des identifiants de connexion au back end
        else if (strpos($backend->url, 'auth.php'))
            $backend->auth();
        
        else if (strpos($backend->url, 'logout.php'))
        {
            if (isset($_SESSION['name']) && isset($_SESSION['password']))
                    $backend->logout();
            else
                throw new Exception('Pas d\'identifiants renseignés');
        }

        else if (strpos($backend->url, 'dashboard.php'))
        {
            if (isset($_SESSION['name']) && isset($_SESSION['password']))
                $backend->dashboard();
            else
                throw new Exception('Pas d\'identifiants renseignés');
        }

        // écrire un nouvel article
        else if (strpos($backend->url, 'write.php'))
        {
            if (isset($_SESSION['name']) && isset($_SESSION['password']))
                $backend->write();
            else
                throw new Exception('Pas d\'identifiants renseignés');
        }

        // Enregistrer un nouvel article
        else if (strpos($backend->url, 'newArticle.php'))
        {
            if (isset($_SESSION['name']) && isset($_SESSION['password']))
                $backend->newArticle($_POST['title'], $_POST['textcontent']);
            else
                throw new Exception('Pas d\'identifiants renseignés');
        }

        // Par défaut, on charge la page d'accueil
        else
            $frontend->home();
    }
} 
catch (Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}
