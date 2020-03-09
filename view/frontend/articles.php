<?php $title = 'Les chapitres';
ob_start();?>
<h2>Les chapitres</h2>

<?php
while ($donnees = $req->fetch()) {
    if (strlen($donnees['content']) <= 400)
    {
      $content = $donnees['content'];
    }
    else
    {
      $debut = substr($donnees['content'], 0, 400);
      $debut = substr($debut, 0, strrpos($debut, ' ')) . '...';
    
      $content = $debut;
    }
?>
<article class="article">
    <h3 class="m-3"><a href="article.php?id=<?=$donnees['id']?>"><?=$donnees['title'];?></a></h3>
    <p>Publié le <?=$donnees['date_posted'];?> , par <?=$donnees['author'];?></p>

    <p class=" text-center"><?=nl2br(htmlspecialchars($content));?></p>
    <hr>
</article>
<?php
}
$req->closeCursor();
?>

<?php $content = ob_get_clean();
include 'template.php';

