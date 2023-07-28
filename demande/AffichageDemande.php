<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/ClientSide/html.html to edit this template
-->
<html>

<head>
    <title>TMA - Création Demande</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="../css/AffichageDemande.css" rel="stylesheet" type="text/css" />
    <link rel="icon" href="../img/NLogo2.png" />
</head>

<body>
    <?php
    include('../includes/header.html.inc.php');

    // Informations de connexion � la base de donn�es MySQL
    $servername = "localhost:3308"; // nom du serveur
    $username = "root"; // nom d'utilisateur
    $password = "XVsikn92"; // mot de passe
    $dbname = "tmaconnect"; // nom de la base de donn�es
    // Cr�ation d'une connexion � la base de donn�es avec PDO
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    // Configuration des attributs de PDO