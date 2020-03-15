<?php $title = "Enregistrez-vous!";
ob_start();
?>

<p class="h3 m-4">Vous voulez être tenu au courant des publications des derniers chapitres et actualités ?</p>
<p class="h3">Inscrivez-vous à la newsletter en remplissant ce petit formulaire !</p>

<form action="#" method="post">
        <p><label for="name">Votre nom : <br><?=$form->input('name');?></label><br></p>
        <p><label for="email">Votre email : <br><?=$form->input('email');?></label><br></p>
        <?=$form->submit();?>
    </form>

<?php
$content = ob_get_clean();
include 'template.php';