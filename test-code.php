<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/ClientSide/html.html to edit this template
-->
<html>

<head>
  <title>TC1</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" type="text/css" href="css/test-css.css" />
  <link rel="stylesheet" type="text/css" href="css/csshome.css" />
  <link rel="stylesheet" type="text/css" href="css/AffichageDemande.css" />
  <link rel="icon" href="img/NLogo2.png" />
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>

  <?php include('includes/header.html.inc.php') ?>
  <?php include('includes/connexion.inc.php') ?>

<!----------------------------------------
|             Filtres des demandes       | 
------------------------------------------>
  <?php
  // Requ�tes SQL pour le filtre de recherche des demandes 
  
  $sql0 = "SELECT libelle FROM tc_domaine";
  $stmt0 = $pdo->query($sql0);
  $result0 = $stmt0->fetchAll(PDO::FETCH_ASSOC);

  // Requ�tes SQL pour r�cup�rer les donn�es de la table tc_etat
  $sql1 = "SELECT libelle FROM tc_etat";
  $stmt1 = $pdo->query($sql1);
  $result1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
  ?>

  <section class="modif">
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
            foreach ($result1 as $row) {
              $lib_etat = $row['libelle'];
              echo "<option value=$id_etat>$lib_etat</option>";
            }
            ?>
          </select>
        </div>

        <div class="label-container">
          <label for="num-dmd">N°Demande</label>
          <input type="number" id="num-dmd" name="num-dmd" size="35">
        </div>

        <div>
          <!-- Nouveaux champs de texte -->
          <label for="input_lib">Libellé de la Demande</label>
          <input type="text" name="input-lib" id="input_lib">
        </div>


        <div class="bloc-btn">
          <button type="submit">Appliquer</button>
          <button type="reset">Réinitialiser</button>
        </div>
      </fieldset>
    </form>
  </section>

<!----------------------------------------
|  Requêtes pour récupérer les demandes  | 
------------------------------------------>
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

      $stmt = $pdo->prepare($sql);
      $stmt->execute();
    }
  } catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
  }
  ?>

<!----------------------------------------
|           Tableau Des demandes          | 
------------------------------------------>
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
          <tr class="afficherDetails">
            <td><button id="monBouton" data-id=<?= $row[0] ?>>🔎</button></td>
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

  <?php else: ?>
    <div>Aucune demande trouvée</div>
  <?php endif; ?>

<!--------------------------------------------
|             Pagination Du Tableau          |  
--------------------------------------------->

  <nav class="div--pagination" aria-label="...">
    <ul class="pagination">
      <li class="page-item disabled">
        <a class="page-link">Précédent</a>
      </li>
      <li class="page-item"><a class="page-link" href="#">1</a></li>
      <li class="page-item active" aria-current="page">
        <a class="page-link" href="#">2</a>
      </li>
      <li class="page-item"><a class="page-link" href="#">3</a></li>
      <li class="page-item">
        <a class="page-link" href="#">Suivant</a>
      </li>
    </ul>
  </nav>

  <!-- <div id="alertContainer"></div> -->

  <!-- <script src="js/detailDemande.js"></script> Script js pour afficher les détails -->
  <script src="js/date.js"></script> <!-- Script js pour modifier le format des input date -->
  <script src="js/Filtre-dmd.js"></script> <!-- Script js pour la recherche des demandes avec le filtre -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
