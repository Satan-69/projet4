<?php $title = 'Accueil';
ob_start();
?>
<section id="presentation">
    <img id="banniere" class="d-none d-lg-block" src="public/images/header.jpg" alt="empty road and railroad at night">
    <div id="header-text">
        <h1 class="display-4 animated fadeInDown slow">Billet simple pour l'Alaska - Jean Forteroche</h1>
        <br>
        <p class="lead animated fadeIn delay-2s slow">Adepte des nouvelles technologies, je vous propose un nouveau
            concept : celui de publier mon livre chapitre
            par chapitre, directement en ligne. Un peu comme une série en fait !</p>
        <h2 class="h1 mt-4 animated fadeIn delay-3s slow"><a href="article.php?id=1"> Rendez-vous ici pour commencer
                l'histoire...</a></h2>
    </div>
</section>
<hr class="hr-text m-5" data-content="Dernier chapitre">
<!-- Affiche l'extrait dernier article publié -->
<section id="last-article">
    <?php if (strlen($article['content']) <= 400)
      $content = $article['content'];
    else
    {
      $debut = substr($article['content'], 0, 400);
      $debut = substr($debut, 0, strrpos($debut, ' ')) . '...';
      $content = $debut;
    } ?>
    <article class="article">
        <h2 class="h1"><a
                href="article.php?id=<?=$article['id']?>"><?=htmlspecialchars(ucfirst($article['title']));?></a></h2>
        <p class="m-3">Publié le <?=htmlspecialchars($article['date_posted']);?>, par
            <?=htmlspecialchars($article['author']);?></p>
        <?php if($article['date_updated']) {
          echo '<p>Mis à jour le ' . htmlspecialchars($article['date_updated']) . '</p>';
        }?>

        <p><?=nl2br(htmlspecialchars($content));?></p>
    </article>
</section>
<!-- Affiche les autres livres de Jean Forteroche -->
<hr class="hr-text m-5" data-content="Mes autres romans">
<section id="books">
    <div id="cards" class="d-flex flex-column flex-xl-row align-items-center justify-content-around">
        <div class="card">
            <img src="public/images/lepalaisdelalune.jpg" class="card-img-top"
                alt="Couverture du livre Le Palais de la Lune, vue sur le désert de l'Utah">
            <div class="card-body p-3">
                <h5 class="card-title">Le Palais de la Lune</h5>
                <p class="card-text text-dark small">Éditions Actes Ouest - 2018<br> 19.90€</p>
            </div>
        </div>
        <div class="card">
            <img src="public/images/alicesurlefil.jpg" class="card-img-top"
                alt="Couverture du livre Alice sur le fil, fille de dos marchant sur la plage">
            <div class="card-body p-3">
                <h5 class="card-title">Alice sur le fil</h5>
                <p class="card-text text-dark small">Éditions Actes Ouest - 2015<br> 19.90€</p>

            </div>
        </div>
        <div class="card">
            <img src="public/images/lesrevesrouges.jpg" class="card-img-top"
                alt="Couverture du livre Les Rêves rouges, ambiance urbaine de nuit">
            <div class="card-body p-3">
                <h5 class="card-title">Les rêves rouges</h5>
                <p class="card-text text-dark small">Éditions Actes Ouest - 2017<br> 19.90€</p>

            </div>
        </div>
    </div>
</section>

<hr class="hr-text">

<?php $content = ob_get_clean();
require 'template.php';