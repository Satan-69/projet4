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
                $frontend->addComment($_GET['id'], $_POST['author'], $_POST['comment']);
        }
        else if (strpos($frontend->url, 'signalComment.php'))
            $frontend->signalComment($_GET['id'], $_GET['postId']);

        else if (strpos($frontend->url, 'biographie.php')) 
            $frontend->biography();

        else if (strpos($frontend->url, 'contact.php')) 
            $frontend->contact();

        else if (strpos($frontend->url, 'mentions.php')) 
            $frontend->mentions();

        else if (strpos($backend->url, 'mailto.php'))
            $frontend->mailto();

        else if (strpos($frontend->url, 'login.php'))
            $backend->login();
        
        else if (strpos($backend->url, 'logout.php'))
            $backend->logout();

        else if (strpos($backend->url, 'dashboard.php'))
            $backend->dashboard();

        //View back end de l'article (avec les boutons supprimer et éditer)
        else if (strpos($backend->url, 'articleBackend.php'))
            $backend->articleBackend();

        else if (strpos($backend->url, 'signaledComments.php'))
            $backend->signaledComments();

        else if (strpos($backend->url, 'deleteComment.php'))
            $backend->deleteComment($_GET['id']);

        // écrire un nouvel article
        else if (strpos($backend->url, 'write.php'))
            $backend->write();

        // Enregistrer un nouvel article
        else if (strpos($backend->url, 'newArticle.php'))
            $backend->newArticle($_POST['title'], $_POST['textcontent']);

        // Mettre à jour l'article
        else if (strpos($backend->url, 'update.php'))
            $backend->update($_POST['title'], $_POST['textcontent'], $_GET['id']);

        // Supprimer ou éditer un article
        else if (strpos($backend->url, 'modify.php'))
            $backend->modify();

        // Par défaut, on charge la page d'accueil
        else
            $frontend->home();
    }
} 
catch (Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}
