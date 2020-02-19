<?php $title = 'Accueil';
      ob_start(); 
?>
<h1>Jean Forteroche - Le Blog.</h1>

<h2> Bienvenue !</h2>

<p>Ayant marre d'écrire sur du papier, j'ai décidé de créer un nouveau concept : celui de publier mon livre chapitre par chapitre, directement en ligne. Un peu comme une série en fait !</p>
<p>Bientôt la publication du premier chapitre ! Soyez patients...</p>

<?= $_SERVER['HTTP_HOST'], $_SERVER['REQUEST_URI'] . '<br>';?>
<?= $_SERVER['SCRIPT_NAME']; ?>


<?php $content = ob_get_clean();
      require 'template.php';
?>