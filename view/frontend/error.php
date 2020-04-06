<?php $title = 'Erreur';
ob_start();
?>

<h1 class="m-4 display-4 text-center">Erreur !</h1>

<p>Erreur : <?=$e?></p>

<?php $content = ob_get_clean();
include 'template.php';