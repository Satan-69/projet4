<?php $title = 'Panneau d\'administration';
ob_start();?>

<h1 class="display-4 m-4 animated fadeIn slow">Panneau d'administration</h1>
<div class="d-flex flex-row justify-content-around mt-5">
    <div class="box adminBox">
        <h3 class="h1">Chapitres</h3>
        <ul class="list-unstyled mt-3">
            <li><a href="write.php">Nouveau chapitre</a></li>
            <li><a href="articlesBackend.php">Liste des chapitres <?= '<span class="small arial">('.$nbArticles['nb'].')</span>'?></a></li>
        </ul>
    </div>
    <div class="box adminBox">
        <h3 class="h1">Commentaires</h3>
        <ul class="list-unstyled mt-3">
            <li><?php if ($comments['signaled'] > 0) {echo '<a class="red" href="signaledComments.php">Commentaires signalés <span class="small arial">('.$comments['signaled'].')</span></a>';} 
            else { echo '<a href="signaledComments.php">Commentaires signalés</a>';}?>
            </li>
        </ul>
    </div>
</div>
<?php $content = ob_get_clean();
include 'template.php';