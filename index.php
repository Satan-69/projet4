<?php
session_start();
require 'controller/frontend/frontend.php';
require 'controller/backend/backend.php';

try {
    $frontend = new Frontend;
    $backend = new Backend;
    if (isset($frontend->url)) 
    {
        // ROUTES POUR LE FRONT
        if (strpos($frontend->url,'accueil.php')) 
            $frontend->home();
            
        else if (strpos($frontend->url, 'articles.php'))
            $frontend->articles();

        else if (strpos($frontend->url, 'article.php'))
        {
                $frontend->article(); 
            // Si l'utilisateur poste un commentaire sur un article
            if (isset($_GET['action']) && $_GET['action'] == 'addComment')
                $frontend->addComment($_GET['id'], $_POST['author'], $_POST['comment']);
        }
        else if (strpos($frontend->url, 'signalComment.php'))
            $frontend->signalComment($_GET['id'], $_GET['postId']);

        else if (strpos($frontend->url, 'biography.php')) 
            $frontend->biography();

        else if (strpos($frontend->url, 'contact.php')) 
            $frontend->contact();

        else if (strpos($frontend->url, 'mentions.php')) 
            $frontend->mentions();

        else if (strpos($frontend->url, 'sitemap.php')) 
            $frontend->sitemap();

        else if (strpos($frontend->url, 'mailto.php'))
            $frontend->mailto();
        
        else if (strpos($frontend->url, 'error.php'))
            $frontend->error($e);

        // ROUTES POUR LE BACKOFFICE
        else if (strpos($backend->url, 'login.php'))
            $backend->login();

        else if (strpos($backend->url, 'logout.php'))
            $backend->logout();

        else if (strpos($backend->url, 'dashboard.php'))
            $backend->dashboard();

        else if (strpos($backend->url, 'articlesBackend.php'))
            $backend->articlesBackend();

         else if (strpos($backend->url, 'articleBackend.php'))
            $backend->articleBackend();

        else if (strpos($backend->url, 'signaledComments.php'))
            $backend->signaledComments();

        else if (strpos($backend->url, 'deleteComment.php'))
            $backend->deleteComment($_GET['id']);

        else if (strpos($backend->url, 'moderateComment.php'))
            $backend->moderateComment($_GET['id']);
        
        else if (strpos($backend->url, 'deleteSignaledComments.php'))
            $backend->deleteSignaledComments();

        else if (strpos($backend->url, 'write.php'))
            $backend->write();

        // Enregistrer un nouvel article
        else if (strpos($backend->url, 'newArticle.php'))
            $backend->newArticle($_POST['title'], $_POST['textcontent']);

        else if (strpos($backend->url, 'update.php'))
            $backend->update($_POST['title'], $_POST['textcontent'], $_GET['id']);

        else if (strpos($backend->url, 'modify.php'))
            $backend->modify();

        // PAR DEFAULT, CHARGEMENT DE LA PAGE D'ACCUEIL
        else
            $frontend->home();
    }
} 
catch (Exception $e) {
    $frontend->error($e);
}
