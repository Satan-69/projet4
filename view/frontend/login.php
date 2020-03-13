<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <p>Entrez vos identifiants : </p>

    <form action="auth.php" method="post">
        <p><label for="name">Votre nom : <br><?=$form->input('name');?></label><br></p>
        <p><label for="password">Votre mot de passe : <br><?=$form->password();?></label><br></p>
        <?=$form->submit();?>
    </form>
</body>

</html>