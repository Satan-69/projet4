<?php $title = 'Connectez-vous';
ob_start();
?>

<p>Entrez vos identifiants : </p>

<form action="auth.php" method="post">
    <p><label for="name">Votre nom : <br><?=$form->input('name');?></label><br></p>
    <p><label for="password">Votre mot de passe : <br><?=$form->password();?></label><br></p>
    <?=$form->submit();?>
</form>

<?php
$content = ob_get_clean();
include 'template.php';