<?php
// informations de connexion à la base de données MySQL
$servername = "localhost:3308"; // nom du serveur
$username = "root"; // nom d'utilisateur
$password = "XVsikn92"; // mot de passe
$dbname = "tmaconnect"; // nom de la base de données
$dsn = "mysql:host=localhost:3308;dbname=tmaconnect"; //Regroupement des informations de connexion
// création d'une connexion à la base de données
try {
  $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Votre code ici...
} catch (PDOException $e) {
  echo "La connexion a �chou� : " . $e->getMessage();
}
?>

<<!DOCTYPE html>
  <html>

  <head>
    <title>TMA - Affichage des demandes</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="css/csshome.css" rel="stylesheet" type="text/css" />
    <link href="css/test-css.css" rel="stylesheet" type="text/css" />
    <link rel="icon" href="img/NLogo2.png" />
  </head>

  <?php
  include('includes/header.html.inc.php'); ?>

  <body>
    <section id="modif">
      <form class="formmodif" name="formmodif" action="" method="POST">
        <fieldset id="infos">
          <legend>Filtres</legend>
          <div>
            <label for="accesDemande">Accès Direct à la Demande</label>
            <input type="text" size="35">
          </div>
          <!-- Nouveaux champs de texte -->
          <div>
            <label for="">Contenant du texte</label>
            <input type="text" size="35">
          </div>

          <!-- Nouvelles listes déroulantes -->
          <div>
            <label for="select_departement">Domaine</label>
            <select>
              <option value=""></option>
              <option value=""></option>
              <option value=""></option>
              <!-- Ajoutez d'autres options selon vos besoins -->
            </select>
          </div>
          <div>
            <label for="select_poste">Demandes du groupe</label>
            <select name="select_poste" id="select_poste">
              <option value=""></option>
              <option value=""></option>
              <option value=""></option>
              <!-- Ajoutez d'autres options selon vos besoins -->
            </select>
          </div>
        </fieldset>
      </form>
    </section>

    <section id="modif">
      <form class="formmodif" name="formmodif" action="" method="POST">
        <!-- Votre formulaire -->
        <button type="submit" class="btn btn-primary">Soumettre</button>
      </form>
    </section>

    <?php
    try {
      // Informations de connexion à la base de données MySQL
      $dsn = "mysql:host=localhost:3308;dbname=tmaconnect";
      $username = 'root';
      $password = 'XVsikn92';
      // Création d'une connexion à la base de données avec PDO
      $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      // récupérer tous les utilisateurs
      $sql = "SELECT * FROM tc_utilisateur";
      $stmt = $pdo->query($sql);

      if ($stmt === false) {
        die("Erreur dans la requête SQL");
      }

    } catch (PDOException $e) {
      echo "Erreur de connexion à la base de données : " . $e->getMessage();
    }

    // Vérification des résultats
    if ($stmt->rowCount() > 0) {
      $count = $stmt->rowCount();

      // Création du tableau HTML
      echo "<table class='table' id='table'>
          <thead>
              <tr>
                <th>🔎</th>
                <th>N°demande</th>
                <th>Domaine</th>
                <th>Libellé</th>
                <th>Demande crée</th>
                <th>Charge</th>
                <th>Etat</th>
                <th>Date MEP</th>
              </tr>
          </thead>
          <tbody>";

      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>
                <td>" . $row["IdDemande"] . "</td>
                <td>" . $row["dom_dmd"] . "</td>
                <td>" . $row["libelle"] . "</td>
                <td>" . $row["qual_dmd"] . "</td>
            </tr>";
      }

      echo "</tbody></table>";

      // Affichage du nombre de demandes en titre de tableau
      if ($count <= 1) {
        echo "<div id='table'>$count  enregistré</div>";
      } else {
        echo "<div id='table'>$count demandes enregistrés</div>";
      }
    } else {
      echo "Aucune demande trouvé";
    }
    ?>

  </body>

  </html>