<?php $title = "Nouvel article";
ob_start();
?>

<h1 class="display-4 m-4 animated fadeIn slow">Écrire un nouveau chapitre</h1>

<div class="d-flex justify-content-center mt-4">
    <form action="newArticle.php" method="post">
        <p><label class=" mt-3 h3" for="title"><u>Titre du chapitre</u> :</label></p>
        <p><input type="text" name="title" class="titleinput" required></p>
        <p class=" m-4 h3"><u>Votre texte</u> : </p>
        <textarea name="textcontent" required>Écrivez votre récit ici.</textarea>
        <input type="submit" value="Publier" class="btn btn-info mt-3 px-5">
    </form>
</div>

<? $content =ob_get_clean();
include 'template.php';
