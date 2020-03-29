<?php $title="Commentaires signalés";
ob_start();
?>
<section id="signaledComments ">
    <h1 class="m-4 display-4 animated fadeIn slow">Commentaires signalés</h1>
    <?php
    if ($req->rowCount() > 0) 
    {
        while ($comment = $req->fetch()) {
        ?>
    <div class="row justify-content-center">
        <div class="commentBox m-4 col-4">
            <div>
                <p><strong><?=htmlspecialchars($comment['author'])?></strong>, le <?=$comment['date_posted']?> : </p>
                <form method="POST" action="deleteComment.php?id=<?=$comment['id']?>&amp;postId=<?=$article['id']?>">
                    <input id="signalButton" class="deleteButton" type="submit" value="Supprimer">
                </form>
            </div>
            <p><?=nl2br(htmlspecialchars($comment['comment']))?></p>
        </div>
    </div>
    <?php
    }
} else { 
?>
    <h2>Aucun commentaire n'a été signalé !</h2>
    <?php
    }

?>
</section>

<?php $content = ob_get_clean();
include 'template.php';