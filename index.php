<?php
session_start();
require('controller/frontend.php');
require('controller/backend.php');

try {
    // Si on demande la page d'accueil
    if (isset($_GET['accueil.php']))
    {

    }
//     // Si on demande la page biographie
//     if (isset($_GET['biographie.php']))
//     {

//     }
//     // Si on demande la page d'articles
//     if (isset($_GET['articles.php']))
//     {

//     }
//     // Si on demande la page de contact
//     if (isset($_GET['contact.php']))
//     {

//     }
//     // Si on veut se connecter au back-office
//     if (isset ($_GET['admin.php']))
//     {

//     }
//     // Si on veut s'abonner
//     if (isset ($_GET['subscribe.php']))
//     {

//     }

//     //Si une action est demandée ->
//     if (isset($_GET['action']))
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
//     // Par défaut, on charge la page d'accueil
//     else
//     {
//         getArticles();
//     }
// }
catch(Exception $e) 
{
    echo 'Erreur : ' . $e->getMessage();
}