<!DOCTYPE html>
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

  <?php include('includes/connexion.inc.php') ?> <!--Connexion à la base de données-->
  <?php include('includes/header.html.inc.php'); ?> <!-- Ajout de la barre de navigation-->

  <body>
<?php
    try {
      include('includes/connexion.inc.php'); 
    
      // Récupère toutes les demandes
      $sql = "SELECT IdDemande , dom_dmd , libelle , qual_dmd , date_crea , etat_dmd FROM tc_demandes";
      $stmt = $pdo->query($sql);

      if ($stmt === false) {
        die("Erreur dans la requête SQL");
      }

    } catch (PDOException $e) {
      echo "Erreur de connexion à la base de données : " . $e->getMessage();
    }
    ?>

    <!-- Affichage des résultats -->
    <?php if ($stmt->rowCount() > 0): ?>
      <?php
      $count = $stmt->rowCount();
      ?>

      <!-- Création du tableau HTML -->
      <table class='table' id='table'>
        <thead>
          <tr>
            <th>🔎</th>
            <th>N°demande</th>
            <th>Domaine</th>
            <th>Libellé</th>
            <th>Type</th>
            <th>Demande créée</th>
            <th>Etat</th>
          </tr>
        </thead>
        <tbody>

          <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
            <tr>
              <td>🔎</td>
              <td><?= $row["IdDemande"] ?></td>
              <td><?= $row["dom_dmd"] ?></td>
              <td><?= $row["libelle"] ?></td>
              <td><?= $row["qual_dmd"] ?></td>
              <td><?= $row["date_crea"] ?></td>
              <td><?= $row["etat_dmd"] ?></td>
            </tr>
          <?php endwhile; ?>

        </tbody>
      </table>

      <!-- Affichage du nombre de demandes en titre de tableau -->
      <div id='table'>
        <?= $count > 1 ? "$count demandes enregistrées" : "$count demandes enregistrées" ?>
      </div>

    <?php else: ?>
      <div>Aucune demande trouvée</div>
    <?php endif; ?>

    <div class="btnexcel">
        <button><span class="fa fa-arrow-circle-down fa-lg" aria-hidden="true"></span> Télécharger au formatExcel</button>
    </div>

    <script>
        document.querySelector(".btnexcel button").addEventListener("click", function () {
            // Rediriger vers la page telechargement.php
            window.location.href = "includes/telech.excel.php";
        });
    </script>


  </body>

  </html>