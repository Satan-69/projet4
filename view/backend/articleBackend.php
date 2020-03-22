<?php $title = htmlspecialchars($article['title']);
ob_start();?>

<!-- Display de l'article -->
<form action="modify.php?id=<?=$article['id']?>" method="POST">
    <input type="submit" class="btn btn-primary mx-2" name="update" value="Éditer le chapitre">
    <input type="submit" class="btn btn-danger mx-2" name="delete" value="Supprimer le chapitre">
</form>
<hr>
<article class="article">
    <h2 class="display-3"><?=$article['title'];?></h2>
    <p class="m-3">Publié le <?=$article['date_posted'];?> , par <?=$article['author'];?></p>
    <p><?=nl2br(htmlspecialchars($article['content']));?></p>
</article>
<hr>
<!-- Display des commentaires -->
<section id="comments">
    <?php
while ($comment = $comments->fetch()) {?>
    <p><strong><?=htmlspecialchars($comment['author'])?></strong>, le <?=htmlspecialchars($comment['date_posted'])?> : </p>
    <p><?=nl2br(htmlspecialchars($comment['comment']))?></p>
    <?php
}
?>
</section>

<?php
$content = ob_get_clean();
require 'template.php';