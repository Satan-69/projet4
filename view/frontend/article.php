<?php $title = htmlspecialchars($article['title']);
ob_start(); ?>

<!-- Display de l'article -->
<article class="article">
<h3><?= $article['title'];?></h3>
<p>Publié le <?= $article['date_posted'];?> , par <?= $article['author'];?></p>

<p><?= nl2br(htmlspecialchars($article['content']));?></p>
</article>
<hr>
<!-- Display des commentaires -->
<section id="comments">
<?php while ($comment = $comments->fetch())
{ ?>
<p><strong><?= htmlspecialchars($comment['author']) ?></strong>, le <?=$comment['date_posted']?> : </p>
<p><?=nl2br(htmlspecialchars($comment['comment'])) ?></p>
<?php
}
?>
</section>

<?php
$content = ob_get_clean();
include 'template.php';
?>
