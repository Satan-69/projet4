<?php
session_start();
require('controller/frontend/frontend.php');
// require('controller/backend/backend.php');

try {
    $controller = new Frontend;
    
    // Si on demande la page d'accueil
    if (in_array('accueil.php', $controller->url))
    {
        $controller->accueil();
    }
    // Si on demande la page d'articles
    else if (in_array('articles.php', $controller->url))
    {
        $controller->articles();
    }
    // Si on demande la page biographie
    else if (in_array('biographie.php', $controller->url))
    {
        $controller->biographie();
    }
    // Si on demande la page de contact
    else if (in_array('contact.php', $controller->url))
    {
        $controller->contact();
    }
//     // Si on veut se connecter au back-office
//     else if (isset ($_GET['admin.php']))
//     {

//     }
    // Si on veut s'abonner
    else if (in_array('register.php', $controller->url))
    {
        $controller->register();
    }

//     //Si une action est demandée ->
//     else if (isset($_GET['action']))
//     {   
//         // Charge les articles
//         if ($_GET['action'] == 'listArticles')
//         {
//             getArticles();
//         }
//         // Charge l'article demandé
//         else if ($_GET['action'] == 'Article')
//         {
//             if (isset($_GET['id']) AND $_GET['id'] > 0)
//             {
//                 getArticle();
//             }
//             else
//             {
//                 throw new Exception('Aucun ID d\'article envoyé');
//             }
//         }
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
    else
    {
        $controller->accueil();
    }
}
catch(Exception $e) 
{
    echo 'Erreur : ' . $e->getMessage();
}