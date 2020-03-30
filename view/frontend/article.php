<?php $title = htmlspecialchars($article['title']);
ob_start();?>

<!-- Display de l'article -->
<article class="article">
    <h2 class="display-3"><?=htmlspecialchars($article['title']);?></h2>
    <p class="m-3">Publié le <?=htmlspecialchars($article['date_posted']);?> , par
        <?=htmlspecialchars($article['author']);?></p>
    <p><?=nl2br(htmlspecialchars($article['content']));?></p>
</article>
<hr>
<!-- Display des commentaires -->
<section id="comments" class="d-flex justify-content-around m-5">
    <div class="col-4">
        <h3 class="h2">Commentaires</h3>
        <?php
while ($comment = $comments->fetch()) {?>
    <div class="commentBox m-4">
        <div>
            <p><strong><?=htmlspecialchars($comment['author'])?></strong>, le <?=$comment['date_posted']?> : </p>
            <form method="POST" action="signalComment.php?id=<?=$comment['id']?>&amp;postId=<?=$article['id']?>">
                <input class="signalButton" type="submit" value="Signaler">
            </form>
        </div>
        <p><?=nl2br(htmlspecialchars($comment['comment']))?></p>
        </div>
        <?php
}
?>
    </div>
    <div id="postComment" class="col-4">
        <form class="box" method="POST" action="article.php?action=addComment&amp;id=<?=$article['id']?>">
            <h3 class="h2">Laisser un commentaire</h3>
            <p class="text-left"><input maxlength="15" class="input mt-3" type="text" name="author" id="author" placeholder="votre nom" required></p>
            <textarea class="textarea m-4" name="comment" id="comment" cols="40" rows="5" placeholder="votre commentaire" required></textarea><br>
            <p><input type="submit" value="Envoyer"></p>
        </form>
    </div>
</section>
<?php
$content = ob_get_clean();
require 'template.php';