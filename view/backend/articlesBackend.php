<?php
$title = 'Les chapitres - Panneau d\'administration';
ob_start();?>

<h1 class="display-4 m-4 animated fadeIn slow">Les Chapitres</h1>
<?php
while ($donnees = $req->fetch()) {
    if (strlen($donnees['content']) <= 400)
      $content = $donnees['content'];
    else
    {
      $debut = substr($donnees['content'], 0, 400);
      $debut = substr($debut, 0, strrpos($debut, ' ')) . '...';
      $content = $debut;
    }
?>
<div class="articleBox">
    <article class="article">
        <h2 class="mb-3"><a href="articleBackend.php?id=<?=$donnees['id']?>"><?=htmlspecialchars($donnees['title']);?></a></h2>
        <p>Publié le <?=htmlspecialchars($donnees['date_posted']);?> , par <?=htmlspecialchars($donnees['author']);?>
        </p>

        <p class="text-center"><?=nl2br(htmlspecialchars($content));?></p>
        
    </article>
</div>
<hr class="hr-shine shine">
<?php
}
$req->closeCursor();
?>

<?php $content = ob_get_clean();
include 'template.php';