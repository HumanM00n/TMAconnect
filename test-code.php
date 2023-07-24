<?php
$username = "root";
$password = "XVsikn92";
$dbname = "tmaconnect";
$error = false;
$dsn = "mysql:host=localhost:3308;dbname=tmaconnect";

if (isset($_POST['login'])) {
  // Vérifier les informations de connexion (par exemple, vérifier dans la base de données)
  $matricule = $_POST['username'];
  $passwd = $_POST['password'];

  try {
    $pdo = new PDO($dsn, $username, $password);

    $selectQuery = "SELECT passwd FROM tc_utilisateur WHERE matricule = :matricule";
    $selectStmt = $pdo->prepare($selectQuery);
    $selectStmt->execute(['matricule' => $matricule]);
    $row = $selectStmt->fetch();

    if (!empty($row) && password_verify($passwd, $row['passwd'])) {
      // L'utilisateur est authentifié avec succès

      if (isset($_POST['remember']) && $_POST['remember'] === 'on') {
        // Si l'utilisateur a coché "Rester Connecté", créer un cookie avec une durée de validité plus longue (par exemple, 30 jours)
        $cookieValue = uniqid(); // Vous pouvez générer un identifiant unique pour l'utilisateur
        setcookie('remember_token', $cookieValue, time() + (30 * 24 * 60 * 60)); // Le cookie expirera dans 30 jours
      }

      // Rediriger vers la page de profil ou le tableau de bord de l'utilisateur
      // header('Location: profil.php');
      // exit;
    } else {
      // Les informations d'authentification sont invalides
      echo 'Nom d\'utilisateur ou mot de passe incorrect.';
    }
  } catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/index.css">
  <link rel="icon" href="../TMAconnect/img/NLogo2.png" />
  <title>Authentification - TMAconnect</title>
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
        <a href="../TMAconnect/change-mdp.php" class="tma-btn">Mot de passe oublié</a>
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
        <a href="../TMAconnect/home.php"><input class="tma-btn" type="submit" value="Se Connecter"></a>
      </section>
    </form>
    <label class="remember"><input type="checkbox">Se souvenir de moi</label>
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