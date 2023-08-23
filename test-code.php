<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/ClientSide/html.html to edit this template
-->

<?php
// Informations de connexion � la base de donn�es MySQL
$servername = "localhost:3308"; // nom du serveur
$username = "root"; // nom d'utilisateur
$password = "XVsikn92"; // mot de passe
$dbname = "tmaconnect"; // nom de la base de donn�es
// Cr�ation d'une connexion � la base de donn�es avec PDO

// Configuration des attributs de PDO
$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
?>

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

<body>
  <?php
  include('includes/header.html.inc.php');
  ?>
  <section id="modif">
    <form class="formmodif" name="formmodif" action="" method="POST">
      <fieldset id="infos">
        <legend>Filtres</legend>
        <div>
          <label for="accèsDemande">Accès Directe à la Demande</label>
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
</body>

</html>