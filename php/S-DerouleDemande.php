<?php include('../includes/header.html.inc.php') ?>

<?php
// informations de connexion à la base de données MySQL
$servername = "localhost:3308"; // nom du serveur
$username = "root"; // nom d'utilisateur
$password = "XVsikn92"; // mot de passe
$dbname = "tmaconnect"; // nom de la base de données
// création d'une connexion à la base de données
try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Votre code ici...
} catch (PDOException $e) {
    echo "La connexion a �chou� : " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link href="../css/csshome.css" rel="stylesheet" type="text/css" />
    <link rel="icon" href="../img/NLogo2.png" />
    <title>Déroulement Demandes</title>
</head>
<?php include('../includes/header.html.inc.php') ?>

<body>



</body>
</html>