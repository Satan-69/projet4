<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit = no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSS Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- CSS -->
    <link rel="stylesheet" href="public/css/style.css">
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Dancing+Script&display=swap" rel="stylesheet"> 
    <title>Jean Forteroche - <?=$title?></title>
</head>
<body>
    <header>
        <?php include 'header.php';?>
    </header>
    <main class="text-center">
        <?=$content;?>
    </main>
    <footer>
        <?php include 'footer.php';?></footer>
</body>
</html>
