<?php ob_start(); ?>

<form action="POST" id="contact">
    <p>
        <label for="name">Votre nom : </label><input type="text" name="name" id="name"><br>
        <label for="email">Votre email : </label><input type="email" name="email" id="email"><br>
        <label for="message"></label><textarea name="message" id="message" cols="30" rows="10" placeholder="Tapez votre message ici"></textarea>
    <input type="submit" value="Envoyez">
    </p>
</form>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>