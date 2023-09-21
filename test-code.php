<!DOCTYPE html>
<html>

<head>
  <title>TMA - Affichage des demandes</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link href="css/csshome.css" rel="stylesheet" type="text/css" />
  <link href="css/test-css.css" rel="stylesheet" type="text/css" />
  <link rel="icon" href="img/NLogo2.png" />
</head>

<?php include('includes/connexion.inc.php') ?> <!--Connexion à la base de données-->
<?php include('includes/header.html.inc.php'); ?> <!-- Ajout de la barre de navigation-->

<body>
  <!-- Liste déroulante pour le domaine -->
  <section id="modif">
    <form class="formmodif" name="formmodif" action="" method="POST">
      <fieldset id="infos">
        <legend>Filtres</legend>

        <!-- Liste déroulante pour le domaine -->
        <div class="label-container">
          <label for="select_domaine">Domaine</label>
          <select name="select_domaine" id="select_domaine">
            <?php
            echo "<option value='' disabled selected hidden></option>";
            foreach ($result0 as $row) {
              $lib_dom = $row['libelle'];
              echo "<option value=$id_dom>$lib_dom</option>";
            }
            ?>
          </select>
        </div>

        <div class="label-container">
          <label for="select_etat">Etat</label>
          <select name="select_etat" id="select_etat">
            <?php
            echo "<option value='' disabled selected hidden></option>";
            foreach ($result2 as $row) {
              $lib_etat = $row['libelle'];
              echo "<option value=$id_etat>$lib_etat</option>";
            }
            ?>
          </select>
        </div>
        
        <div class="label-container">
          <label for="num-dmd">N°Demande</label>
          <input type="number" size="35">
        </div>

        <div>
          <!-- Nouveaux champs de texte -->
          <label for="">Libellé la Demande</label>
          <input type="text" size="35">
        </div>


        <div class="block-btn">
          <button type="submit">Appliquer</button>
          <button type="reset">Réinitialiser</button>
        </div>
      </fieldset>
    </form>
  </section>

  <?php
  try {
    $sql = "SELECT D.IdDemande , DOM.libelle , D.libelle , Q.libelle , D.date_crea , E.libelle 
              FROM tc_demandes D, tc_domaine DOM , tc_qualif Q , tc_etat E
              WHERE D.dom_dmd = DOM.IdDomaine 
              AND D.qual_dmd = Q.IdQual
              AND D.etat_dmd = E.IdEtat";

    $stmt = $pdo->query($sql);

    if ($stmt === false) {
      die("Erreur dans la requête SQL");
    }

    // Vérification des résultats
    if ($stmt->rowCount() > 0) {
      $count = $stmt->rowCount();

      // Nombre d'enregistrements par page
      $nombreParPage = 8;

      // Récupérer le numéro de page à partir des paramètres de requête GET
      $page = isset($_GET['page']) ? $_GET['page'] : 1;

      // Calculer la position de départ
      $positionDepart = ($page - 1) * $nombreParPage;

      // $sql = "SELECT IdDemande , dom_dmd , libelle , qual_dmd , date_crea , etat_dmd FROM tc_demandes
      //     LIMIT :positionDepart, :nombreParPage";
  
      $stmt = $pdo->prepare($sql);
      // $stmt->bindValue(':positionDepart', $positionDepart, PDO::PARAM_INT);
      // $stmt->bindValue(':nombreParPage', $nombreParPage, PDO::PARAM_INT);
      $stmt->execute();
    }
  } catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
  }
  ?>

  <?php if ($stmt->rowCount() > 0): ?>
    <table class='table' id='table'>
      <thead>
        <tr>
          <th>🔎</th>
          <th>N°demande</th>
          <th>Domaine</th>
          <th>Libellé</th>
          <th>Type</th>
          <th>Demande créée</th>
          <th>Charge</th>
          <th>Etat</th>
          <th>Date MEP</th>
          <th>Télécharger</th>
        </tr>
      </thead>
      <tbody>

        <?php while ($row = $stmt->fetch(PDO::FETCH_BOTH)): ?>
          <tr>
            <td>🔎</td>
            <td>
              <?= $row[0] ?>
            </td>
            <td>
              <?= $row[1] ?>
            </td>
            <td>
              <?= $row[2] ?>
            </td>
            <td>
              <?= $row[3] ?>
            </td>
            <td>
              <?= $row[4] ?>
            </td>
            <td>2</td>
            <td>
              <?= $row[5] ?>
            </td>
            <td>30-09-2023</td>
            <td><i class='bx bx-download'></i></td>
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




</body>

</html>