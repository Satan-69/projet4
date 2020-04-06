<?php $title = 'Les chapitres';
ob_start();?>

<h1 class="display-4 m-4 animated fadeIn slow">Les Chapitres</h1>
<!-- Boucle qui réduit l'affichage à 500 caractères max -->
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
<!-- Display de l'article -->
<hr class="style-seven">  
<div class="articleBox animated fadeIn slow">
    <article class="article">
        <h2 class="mb-3 h1 h3-sm"><a href="article.php?id=<?=$donnees['id']?>"><?=ucfirst(htmlspecialchars(ucfirst($donnees['title'])));?></a></h2>
        <p class="text-center my-4"><?=nl2br(htmlspecialchars($content));?></p>
        <p class="text-right">Publié le <?=htmlspecialchars($donnees['date_posted']);?>, par <?=htmlspecialchars($donnees['author']);?></p>
        <?php if($donnees['date_updated']) {
          echo '<p class="text-right">Mis à jour le ' . htmlspecialchars($donnees['date_updated']) . '</p>';
        }?>
    </article>
</div>
<?php
}
$req->closeCursor();
?>

<?php $content = ob_get_clean();
include 'template.php';