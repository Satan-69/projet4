<?php $title = 'Admin Panel';
ob_start();?>

<h2>Bienvenue sur le panneau d'administration</h2>

<?php $content = ob_get_clean();
include 'template.php';