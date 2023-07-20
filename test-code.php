<?php
$servername = "localhost:3308";
$username = "root";
$password = "XVsikn92";
$dbname = "tmaconnect";

try {
  // Établir une connexion à la base de données avec PDO
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

  // Configuration des options de PDO pour afficher les erreurs SQL
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Connexion réussie
  echo "Connexion à la base de données réussie !";
} catch (PDOException $e) {
  // En cas d'erreur de connexion
  echo "La connexion a échoué : " . $e->getMessage();
}

// Fermer la connexion
$conn = null;
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="css/test-css.css"
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous"><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <title>T-Bootstrap</title>
</head>

<body>
  <!-- Formulaire de connexion -->
  <form action="test-code.php" method="POST">
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

</html>