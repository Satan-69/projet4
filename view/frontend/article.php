<?php $title = htmlspecialchars($article['title']);
ob_start();?>

<!-- Display de l'article -->
<article class="article">
    <h2 class="display-3"><?=htmlspecialchars($article['title']);?></h2>
    <p class="m-3">Publié le <?=htmlspecialchars($article['date_posted']);?> , par <?=htmlspecialchars($article['author']);?></p>
    <p><?=nl2br(htmlspecialchars($article['content']));?></p>
</article>
<hr>
<!-- Display des commentaires -->
<section id="comments">
    <?php
while ($comment = $comments->fetch()) {?>
    <p><strong><?=htmlspecialchars($comment['author'])?></strong>, le <?=$comment['date_posted']?> : </p>
    <p><?=nl2br(htmlspecialchars($comment['comment']))?></p>
    <form method="POST" action="signalComment.php?id=<?=$comment['id']?>&amp;postId=<?=$article['id']?>">
        <input type="submit" value="Signaler">
    </form>
    <?php
}
?>
</section>
<section id="postComment" class="mt-4">
    <form method="POST" action="article.php?action=addComment&amp;id=<?=$article['id']?>">
        <p>
            <label for="author">Auteur : </label><br>
            <input type="text" name="author" id="author"><br>
            <label for="comment">Commentaire : </label><br>
            <textarea name="comment" id="comment" cols="30" rows="5"></textarea><br>
            <input type="submit" value="Envoyer">
        </p>
    </form>
</section>
<?php
$content = ob_get_clean();
require 'template.php';