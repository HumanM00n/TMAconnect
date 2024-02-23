<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link href="css/csshome.css" rel="stylesheet" type="text/css" />
    <link rel="icon" href="img/NLogo2.png" />
    <title>TMAconnect - Accueil</title>
</head>

<body>
    <header>
        <?php include('includes/connexion.inc.php'); ?>
        <?php include('includes/header.html.inc.php'); ?>
        <?php include('php/S-Remember.php');?>
    </header>

    <section class="imgArriere">
        <img src="img/NLogo">
    </section>



    <section id="pageprincipale">
    </section>

    <script>
        $(document).ready(function () {
            $('.toast').toast('show');
        });
    </script>

</body>

</html>