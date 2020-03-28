<?php $title="Commentaires signalés";
ob_start();
?>
<section id="signaledComments">
    <?php
while ($comment = $req->fetch()) {?>
    <p><strong><?=htmlspecialchars($comment['author'])?></strong>, le <?=$comment['date_posted']?> : </p>
    <p><?=nl2br(htmlspecialchars($comment['comment']))?></p>
    <form method="POST" action="deleteComment.php?id=<?=$comment['id']?>">
        <input type="submit" value="Supprimer">
    </form>
    <?php
}
?>
</section>

<?php $content = ob_get_clean();
include 'template.php';