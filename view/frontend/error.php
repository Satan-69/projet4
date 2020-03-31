<?php $title = 'Erreur';
ob_start();
?>

<h1 class="m-4 display-4 text-center animated fadeIn slow">Erreur</h1>


<?php $content = ob_get_clean();
include 'template.php';