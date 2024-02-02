<!DOCTYPE html>

<html>

<head>
  <title>Affichage Demande - TMAconnect</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="../css/csshome.css" rel="stylesheet" type="text/css" />
  <link href="../css/AffichageDemande.css" rel="stylesheet" type="text/css">
  <link rel="icon" href="../img/NLogo2.png" />
</head>

<body>
  <?php include('../includes/connexion.inc.php') ?>
  <?php include('../includes/header.html.inc.php') ?>

  <?php

  // Requ�tes SQL pour le filtre de recherche des demandes 
  $sql0 = "SELECT IdDomaine , libelle FROM tc_domaine";
  $stmt0 = $pdo->query($sql0);
  $result0 = $stmt0->fetchAll(PDO::FETCH_ASSOC);

  // Requ�tes SQL pour r�cup�rer les donn�es de la table tc_etat
  $sql1 = "SELECT IdEtat , libelle FROM tc_etat";
  $stmt1 = $pdo->query($sql1);
  $result1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);

  ?>

  <!------------------------------------------
  |             BOUTON "RETOUR"              | 
  ------------------------------------------->

  <a href="creationDemande.php" class="btnajout">
    <button onClick="window.location.href='creationDemande.php';"> Créer une demande</button>
  </a>

  <!------------------------------------------
  |      FILTRE ET TABLEAU DES DEMANDES      | 
  ------------------------------------------->

  <section class="modif">
    <form id="formFiltre" class="formmodif" name="formmodif" action="" method="POST">
      <fieldset id="infos">
        <legend>Filtres</legend>

        <!-- Liste déroulante pour le domaine -->
        <div class="label-container">
          <label for="select_domaine">Domaine</label>
          <select name="select_domaine" id="select_domaine" data-filter>
            <?php
            echo "<option value=''></option>";
            foreach ($result0 as $row) {
              $id_dom = $row['IdDomaine'];
              $lib_dom = $row['libelle'];
              echo "<option value='$lib_dom'>$lib_dom</option>";
            }
            ?>
          </select>
        </div>

        <div class="label-container">
          <label for="select_etat">Etat</label>
          <select name="select_etat" id="select_etat" data-filter>
            <?php
            echo "<option value=''></option>";
            foreach ($result1 as $row) {
              $id_etat = $row['IdEtat'];
              $lib_etat = $row['libelle'];
              echo "<option value='$lib_etat'>$lib_etat</option>";
            }
            ?>
          </select>
        </div>

        <div class="label-container">
          <label for="num_dmd">N°Demande</label>
          <input type="number" id="num_dmd" name="num_dmd" size="35">
        </div>

        <div class="label-container" id="divLibelle">
          <label for="lib_dmd">Libellé de la Demande</label>
          <input type="text" name="lib_dmd" id="lib_dmd">
        </div>


        <div class="bloc-btn">
          <button type="submit" id="submit" name="appliquer">Appliquer</button>
          <button type="reset">Réinitialiser</button>
        </div>
      </fieldset>
    </form>
  </section>

  <!-----------------------------------------
|           Tableau Des demandes          | 
------------------------------------------>

  <?php if ($stmt->rowCount() > 0): ?>

    <div id="table-container" class='table'>
      <?php include_once('../php/S-Filtre.php'); ?>
    </div>

  <?php else: ?>
    <div>Aucune demande trouvée</div>
  <?php endif; ?>

  <!--------------------------------------------
|             Pagination Du Tableau          |  
--------------------------------------------->

  <nav class="div--pagination" aria-label="Page navigation example">
    <ul class="pagination">
      <li class="page-item">
        <a class="page-link" href="#" aria-label="Previous">
          <span aria-hidden="true">&laquo;</span>
        </a>
      </li>
      <li class="page-item"><a class="page-link" href="#">1</a></li>
      <li class="page-item"><a class="page-link" href="#">2</a></li>
      <li class="page-item"><a class="page-link" href="#">3</a></li>
      <li class="page-item">
        <a class="page-link" href="#" aria-label="Next">
          <span aria-hidden="true">&raquo;</span>
        </a>
      </li>
    </ul>
  </nav>

  <!-- Lien vers jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

  <!-- Lien vers Bootstrap.js -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Lien vers les script JS -->
  <script src="../js/AJAX.js"></script>

</body>

</html>