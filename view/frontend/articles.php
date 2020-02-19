<?php ob_start(); ?>
<h2>Le premier chapitre</h2>

<p>Publié le <!-- date -->, par <!--auteur--></p>

<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto sit, magni error aliquam quaerat beatae repellat? Eos, similique ad voluptates,<br> facilis quis, itaque aliquam laborum dicta corporis accusantium repudiandae ullam?</p>
<?php $content = ob_get_clean();
      include 'template.php'?>