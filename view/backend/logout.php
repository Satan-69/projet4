<?php
session_unset();
session_destroy();
echo '<body onLoad="alert(\'Vous avez bien été déconnecté\')">';
echo '<meta http-equiv="refresh" content="0;URL=accueil.php">';