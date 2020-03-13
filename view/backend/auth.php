<?php

$login = 'charles';
$password = '123';

if (isset($_POST['name']) && isset($_POST['password']))
{
    if($login == $_POST['name'] && $password == $_POST['password'])
    {
        $_SESSION['login'] = $_POST['login'];
        $_SESSION['password'] = $_POST['password'];
        header('location: dashboard.php');
    }
    else
    {
        echo '<body onLoad="alert(\'Mauvais identifiants !\')">';
        echo '<meta http-equiv="refresh" content="0;URL=accueil.php">';
    }
}
else
{
    throw new Exception('Veuillez renseigner votre nom et votre mot de passe');
}