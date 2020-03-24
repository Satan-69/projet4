<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Jean Forteroche - Contactez moi !</title>
    <link rel="icon" type="image/png" href="public/images/logoJF.png" />
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
    <!-- GOOGLE RECAPTCHA -->
    <script src="https://www.google.com/recaptcha/api.js?render=6LevuuIUAAAAAKxQw3x37Lciz4csaSItqk2g6e82"></script>
</head>

<body>
    <header>
        <?php include 'header.php';?>
    </header>
    <main class="text-center">
        <section id="contact">
            <h1 class="display-4">Contactez moi !</h1>

            <h3 class="m-4">Une question ? Une critique ? Une suggestion ? N'hésitez pas à m'en faire part.</h3>

            <form action="mailto.php" method="post">
                <p><label for="name">Votre nom : <br><?=$form->input('name');?></label><br></p>
                <p><label for="email">Votre email : <br><?=$form->input('email');?></label><br></p>
                <p><label for="name">Sujet : <br><?=$form->input('subject');?></label><br></p>
                <p>Votre message :</p>
                <?=$form->textArea('message');?> <br>
                <?=$form->submit();?>
                <input type="hidden" name="recaptcha" id="recaptcha">
            </form>
        </section>
    </main>
    <footer>
        <?php include 'footer.php';?>
    </footer>

    <!-- JS Recaptcha  -->
    <script src="public/js/recaptcha.js"></script>
    <!-- JS Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
</body>

</html>