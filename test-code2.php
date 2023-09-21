<?php

// Informations de connexion � la base de donn�es MySQL
$servername = "localhost:3308"; // nom du serveur
$username = "root"; // nom d'utilisateur
$password = "XVsikn92"; // mot de passe
$dbname = "tmaconnect"; // nom de la base de donn�es

try {
    // Cr�ation d'une connexion � la base de donn�es avec PDO
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    // Configuration des attributs de PDO
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Votre code ici...
} catch (PDOException $e) {
    die("La connexion a �chou�: " . $e->getMessage());
}
;
?>

<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/ClientSide/html.html to edit this template
-->
<html>

<head>
    <title>TMA </title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="css/csshome.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="css/test.css">
    <link rel="icon" href="img/NLogo2.png" />
</head>

<body>
    <?php include('includes/connexion.inc.php') ?>
    <?php include('includes/header.html.inc.php') ?>

    <?php
    // Requ�tes SQL pour le filtre de recherche des demandes 
    
    $sql0 = "SELECT libelle FROM tc_domaine";
    $stmt0 = $pdo->query($sql0);
    $result0 = $stmt0->fetchAll(PDO::FETCH_ASSOC);

    // Requ�tes SQL pour r�cup�rer les donn�es de la table tc_etat
    $sql1 = "SELECT libelle FROM tc_etat";
    $stmt1 = $pdo->query($sql1);
    $result1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);

    // Requ�tes SQL pour r�cup�rer les libellés de la table tc_demandes
    $sql2 = "SELECT libelle FROM tc_demandes";
    $stmt2 = $pdo->query($sql2);
    //$result2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
    $result2 = $stmt2->fetch(PDO::FETCH_ASSOC);
    ?>

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
            <?php
            //echo "<option value='' disabled selected hidden></option>";
            //foreach ($result2 as $row) {
              //$lib_dmd = $row['libelle'];
              //echo "<option value=$id_dmd>$lib_dmd</option>";
            //}
            ?>  
        </div>


        <div class="bloc-btn">
          <button type="submit">Appliquer</button>
          <button type="reset">Réinitialiser</button>
        </div>
      </fieldset>
    </form>
  </section>

    <script src="./js/Filtre-dmd.js"></script>
</body>

</html>