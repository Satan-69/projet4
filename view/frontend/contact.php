<?php
$title = 'Contactez moi !';
ob_start();
?>


<section id="contact">
    <h1>Contactez moi !</h1>

    <p class="m-4">Une question ? Une critique ? Une suggestion ? N'hésitez pas à m'en faire part.</p>

    <form action="#" method="post">
        <p><label for="name">Votre nom : <br><?=$form->input('name');?></label><br></p>
        <p><label for="email">Votre email : <br><?=$form->input('email');?></label><br></p>
        <p>Votre message :</p>
        <?=$form->textArea();?> <br>
        <?=$form->submit();?>
    </form>
</section>

<?php
$content = ob_get_clean();
require 'template.php';