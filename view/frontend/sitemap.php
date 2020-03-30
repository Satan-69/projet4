<?php $title = 'Sitemap';
ob_start();
?>

<h1 class="m-4 display-4 animated fadeIn slow">Plan du site</h1>
<ul class="h2 text-left ml-5">
<li class="m-2"><a href="accueil.php">Accueil</a></li>
<li class="m-2"><a href="articles.php">Les Chapitres</a></li>
<li class="m-2"><a href="biography.php">Ma Biographie</a></li>
<li class="m-2"><a href="contact.php">Contact</a></li>
</ul>

<? $content = ob_get_clean();
include 'template.php';