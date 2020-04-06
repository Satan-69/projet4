<?php $title = htmlspecialchars($article['title']);
ob_start();?>

<!-- Display de l'article -->
<article class="article">
    <h2 class="display-3 m-3"><?=htmlspecialchars(ucfirst($article['title']));?></h2>
    <p><?=nl2br(htmlspecialchars($article['content']));?></p>
    <p class="text-right mt-5">Publié le <?=htmlspecialchars($article['date_posted']);?>, par
        <?=htmlspecialchars($article['author']);?></p>
    <?php if ($article['date_updated']) {
    echo '<p class="text-right">Mis à jour le ' . htmlspecialchars($article['date_updated']) . '</p>';
}?>
</article>
<form class="my-5" action="modify.php?id=<?=$article['id']?>" method="POST">
    <input type="submit" class="btn mx-3" name="update" value="Éditer le chapitre">
    <input type="submit" class="btn deleteButton mx-3" name="delete" value="Supprimer le chapitre">
</form>
<hr>
<!-- Display des commentaires -->
<section id="comments" class="d-flex justify-content-around m-5">
    <div class="col-6">
        <h3 class="h2">Commentaires</h3>
        <?php
while ($comment = $comments->fetch()) {?>
        <div class="commentBox m-4">
            <div>
                <p><strong><?=htmlspecialchars($comment['author'])?></strong>, le
                    <?=htmlspecialchars($comment['date_posted'])?> : </p>
                <form method="POST" action="deleteComment.php?id=<?=$comment['id']?>&amp;postId=<?=$article['id']?>">
                    <input name="articleBackend" class="signalButton deleteButton" type="submit" value="Supprimer">
                </form>
            </div>
            <p><?=nl2br(htmlspecialchars($comment['comment']))?></p>
        </div>
        <?php
}
?>
</section>
<?php
$content = ob_get_clean();
require 'template.php';