<?php
session_start();

// informations de connexion à la base de données MySQL
$servername = "localhost:3308"; // nom du serveur
$username = "root"; // nom d'utilisateur
$password = "XVsikn92"; // mot de passe
$dbname = "tmaconnect"; // nom de la base de données
// création d'une connexion à la base de données


try {
  $bdd = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo "La connexion a �chou� : " . $e->getMessage();
}

if (isset($_POST["username"]) && isset($_POST["password"])) {
  $st = $bdd->prepare("SELECT passwd FROM tc_utilisateur WHERE matricule=:username");
  $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
  $st->bindParam(':username', $username);

  if ($st->execute()) {
    $hashedPassword = $st->fetchColumn();

    if ($hashedPassword && password_verify($_POST["password"], $hashedPassword)) {
      $username1 = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
      $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

      $_SESSION['username'] = $username1;
      $_SESSION['password'] = $password;

      $st1 = $bdd->prepare("UPDATE tc_utilisateur SET derniere_connect = now() WHERE matricule=:username");
      $st1->bindParam(':username', $_POST["username"]);
      $st1->execute();

      header("Location: http://localhost/TMAconnect/home.php");
      exit();
    } else {
      $error = true;
    }
  } else {
    $error = true;
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/test-css.css">
  <link rel="icon" href="../TMAconnect/img/NLogo2.png" />
  <title>TMAconnect - test-code</title>
</head>
<header>
  <center><img class="logo" src="img/NLogo.png"></center>
</header>

<body>

  <div class="container">
    <h2>
      <center>Connexion à votre compte</center>
    </h2>
    <?php
    if (isset($error) && $error) {

      echo '<center><p class="error--id">Identifiant ou mot de passe incorrecte</p></center>';
    }
    ?>

    <!-- CHAMPS DE FORMULAIRE -->
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
      <section class="bloc_id">
        <div class="identifiant">
          <p>Identifiant</p>
          <input class="champs_txt" type="text" name="username" required minlength="5" max="5">
          <span class="icon">
            <ion-icon name="person"></ion-icon>
          </span>
        </div>
      </section>

      <div class="lmdp">
        <a href="./change-mdp.php" class="tma-btn">Mot de passe oublié</a>
      </div>

      <section class="bloc_mdp">
        <div class="mdp">
          <label>
            <p>Mot de passe</p>
            <input class="champs_txt" type="password" name="password" required minlength="" maxlength="30">

            <!-- ICONES -->
            <div class="password-icon">
              <i data-feather="eye"></i>
              <i data-feather="eye-off"></i>
            </div>
          </label>

          <script src="https://unpkg.com/feather-icons"></script>
          <script>
            feather.replace();
          </script>

          <script>
            const eye = document.querySelector('.feather-eye');
            const eyeoff = document.querySelector(' .feather-eye-off');
            const passwordField = document.querySelector('input[type=password]');

            eye.addEventListener('click', () => {
              eye.style.display = "none";
              eyeoff.style.display = "block";
              passwordField.type = "text";
            });

            eyeoff.addEventListener('click', () => {
              eyeoff.style.display = "none";
              eye.style.display = "block";
              passwordField.type = "password";
            });
          </script>
        </div>
      </section>
      <label>
        <input type="checkbox" name="remember" value="1" />
        Se souvenir de moi
      </label>
      <a href="./home.php"><input class="tma-btn" type="submit" value="Se Connecter"></a>
    </form>

  </div>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>

</body>

</html>






<!-- <!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="css/test-css.css" <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <title>T-Bootstrap</title>
</head>

<body>
  <-- Formulaire de connexion -->
<!-- <form action="test-code.php" method="POST">
    <label for="username">Nom d'utilisateur:</label>
    <input type="text" type="text" name="username" required minlength="5" max="5">

    <label for="password">Mot de passe:</label>
    <input type="password" type="password" name="password" required minlength="4" maxlength="30">

    <button type="submit">Se connecter</button>
  </form>

  <button type="button" class="btn btn-primary">Primary</button>
  <a href="#" class="btn btn-primary disabled" tabindex="-1" role="button" aria-disabled="true">Primary link</a>
  <a href="#" class="btn btn-secondary disabled" tabindex="-1" role="button" aria-disabled="true">Link</a>

</body>

</html>  -->



<?php
// $semaine = array();
// $semaine['premier_jour'] = 'lundi';
// $semaine['deuxième_jour'] = 'mardi';
// $semaine['troisième_jour'] = 'mercredi';
// $semaine['quatrième_jour'] = 'jeudi';
// $semaine['cinquième_jour'] = 'vendredi';
// $semaine['sixième_jour'] = 'samedi';
// $semaine['septième_jour'] = 'dimanche';

// echo $semaine['premier_jour'], $semaine['deuxième_jour'] = 'mardi', $semaine['quatrième_jour'] = 'jeudi',
// $semaine['cinquième_jour'] = 'vendredi',
// $semaine['sixième_jour'] = 'samedi',
// $semaine['septième_jour'] = 'dimanche';
?>