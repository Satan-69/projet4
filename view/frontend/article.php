<?php ob_start();
$title = htmlspecialchars($article['title']);
?>
<!-- Display de l'article -->
<article class="article">
    <h2 class="display-3 m-3"><?=htmlspecialchars(ucfirst($article['title']));?></h2>
    <p><?=nl2br(htmlspecialchars($article['content']));?></p>
    <p class="text-right mt-5">Publié le <?=htmlspecialchars($article['date_posted']);?>, par <?=htmlspecialchars($article['author']);?></p>
    <?php if($article['date_updated']) {
          echo '<p class="text-right">Mis à jour le ' . htmlspecialchars($article['date_updated']) . '</p>';
        }?>
</article>
<hr>
<!-- Display des commentaires -->
<section id="comments" class="d-flex flex-lg-row flex-column justify-content-around m-5">
    <div id="getComments" class="col-12 col-lg-6">
        <h3 class="h2">Commentaires</h3>
        <?php
if ($comments->rowCount() > 0) {
    while ($comment = $comments->fetch()) {?>
        <div class="commentBox m-4">
            <div>
                <p><strong><?=htmlspecialchars($comment['author'])?></strong>, le <?=htmlspecialchars($comment['date_posted'])?> : </p>
                <form method="POST" action="signalComment.php?id=<?=$comment['id']?>&amp;postId=<?=$article['id']?>">
                    <input class="signalButton" type="submit" value="Signaler">
                </form>
            </div>
            <p><?=nl2br(htmlspecialchars($comment['comment']))?></p>
        </div>
<?php
    }
} else {?>
    <h4 class="h3">Aucun commentaire</h4>
<?php }?>
    </div>
    <div id="postComment" class="col-12 col-lg-6 mt-5 mt-lg-0">
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

