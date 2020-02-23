<?php $title = 'Accueil';
ob_start();
?>
<section id="presentation" class= "m-3">
      <h1>Jean Forteroche - Le Blog.</h1>

      <h2> Bienvenue !</h2>

      <p>Ayant marre d'écrire sur du papier, j'ai décidé de créer un nouveau concept : celui de publier mon livre chapitre par chapitre, directement en ligne. Un peu comme une série en fait !</p>
      <p>Bientôt la publication du premier chapitre ! Soyez patients...</p>
</section>
<hr>
<section id="last-article">
<!-- Get the last article published -->

</section>
<hr>
<section id="books">
  <h2>Mes autres livres</h2>
  <div id="cards" class="d-flex flex-column flex-xl-row align-items-center justify-content-around">
    <div class="card">
      <img src="..." class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">1st book</h5>
        <p class="card-text text-dark">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
      </div>
    </div>
    <div class="card">
      <img src="..." class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">2nd book</h5>
        <p class="card-text text-dark">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
      </div>
    </div>
    <div class="card">
      <img src="..." class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">3rd book</h5>
        <p class="card-text text-dark">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
      </div>
    </div>
  </div>
</section>

<hr>

<?php $content = ob_get_clean();
require 'template.php';
?>