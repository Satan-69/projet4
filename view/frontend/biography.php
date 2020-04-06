<?php $title = 'Ma vie';
ob_start();
?>
<h1 class="m-4 display-4 animated fadeIn slow">Biographie</h1>
<hr class="hr-text m-5" data-content="Histoire">
<p>Louis De La Forte Roche, plus connu sous son nom d'écrivain Jean Forteroche (qu'il choisit en clin d'oeil à son idole
    <a href="https://fr.wikipedia.org/wiki/Jean_Rochefort"><u>Jean Rochefort</u></a>) est un écrivain français né à
    Toulon en le 17 Juillet 1971.
    Issu d'un père comédien et d'une mère professeure des écoles, il s'intéresse assez tôt au théâtre et au cinéma
    français, où
    il découvre son acteur préféré.
    Il commence à écrire quelques petites pièces de théâtre vers l'âge de 15 ans, puis quelques années plus tard
    s'essaye à de nouveaux styles. </p>
<p> En 1992, il décide de voyager un peu à travers le monde afin de vivre de nouvelles expériences pour peaufiner ses
    histoires.
    Il tombe amoureux de New York, et décide de s'installer dans le quartier de Brooklyn où il rencontre la journaliste
    américaine Suzanne Bauer. 5 ans et quelques voyages plus tard, ils s'installent tous les deux à Paris, où il réside
    encore actuellement. En 1998, Suzanne donne naissance à Julie Forteroche.
    En 2010, il décide de revenir à sa première passion : l'écriture. Il
    enchaîne quelques pièces de théâtre en tant que scénariste, écrit des bandes dessinnées, un livre de nouvelles
    autobiographiques, puis quelques romans. Il coproduit aussi deux documentaires avec son épouse. </p><br>
<p> En 2020, il décide de s'essayer à un autre style d'écriture, et crée ce site sur lequel il publie son nouveau roman
    chapitre par chapitre : <a href="chapitres.php"><u>Billet simple pour l'Alaska</u></a>.
</p><p>Il a reçu le grand prix des lecteurs de "Elle"
    pour son deuxième roman <a href="accueil.php?#anchorBooks"><u>Alice sur le fil</u></a> en 2015 et le prix Maison de la
    presse pour <a href="accueil.php?#anchorBooks"><u>Le Palais de la lune</u></a> en 2018.
</p>
<hr class="hr-text m-5" data-content="Bibliographie">
<ul id="booktypes" class="list-unstyled">
    <li class="booktypes">
        <h5>Pièces de théâtre</h5>
    </li>
    <ul>
        <li> 1988 : L'amour des trois capitaines</li>
        <li> 1990 : Une vie de comédien</li>
        <li> 1992 : L'école buissonnière</li>
    </ul>
    <li class="booktypes">
        <h5>Nouvelles</h5>
    </li>
    <ul>
        <li>2010 : Les nouvelles de Jean</li>
    </ul>
    <li class="booktypes">
        <h5>Bandes dessinées</h5>
    </li>
    <ul>
        <li>2015 : Les invisibles, avec Julie Forteroche</li>
    </ul>
    <li class="booktypes">
        <h5>Romans</h5>
    </li>
    <ul>
        <li>2013 : Les Routes d'Amato</li>
        <li>2015 : Alice sur le Fil, récompensé par le prix des lecteurs de "Elle"</li>
        <li>2017 : Les Rêves Rouges</li>
        <li>2018 : Le Palais de la Lune, récompensé par le prix Maison de la Presse</li>
        <li>2020 : Billet simple pour l'Alaska</li>
    </ul>
    <li class="booktypes">
        <h5>Documentaires</h5>
    </li>
    <ul>
        <li>2005 : Ireki - ville oubliée, en collaboration avec Suzanne Bauer</li>
        <li>2008 : Japon - Terre et Mer, en collaboration avec Suzanne Bauer</li>
    </ul>
</ul>
<hr class="hr-text mt-5">

<?php $content = ob_get_clean();
require 'template.php';