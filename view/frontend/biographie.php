<?php $title = 'Ma vie';
ob_start();
?>
<h1 class="m-4 display-4 animated fadeIn slow">Voici ma vie.</h1>

<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dicta nihil ducimus mollitia velit itaque distinctio dolore
    molestiae ratione veritatis placeat eum sed,
    temporibus illo, officia maiores hic qui, repudiandae consequuntur!</p>



<?php $content = ob_get_clean();
require 'template.php';