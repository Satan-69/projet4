<?php $title = htmlspecialchars($article['title']);
ob_start();?>

<!-- Display de l'article -->
<article class="article">
    <h3><?=$article['title'];?></h3>
    <p>Publié le <?=$article['date_posted'];?> , par <?=$article['author'];?></p>

    <p><?=nl2br(htmlspecialchars($article['content']));?></p>
</article>
<hr>
<!-- Display des commentaires -->
<section id="comments">
    <?php
while ($comment = $comments->fetch()) {?>
    <p><strong><?=htmlspecialchars($comment['author'])?></strong>, le <?=$comment['date_posted']?> : </p>
    <p><?=nl2br(htmlspecialchars($comment['comment']))?></p>
    <?php
}
?>
</section>
<section id="postComment" class="mt-4">
    <form method="post" action="article.php?action=addComment&amp;id=<?=$article['id']?>">
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
?>