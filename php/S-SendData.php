<?php
    //La connexion à la base de données
    $servername = "localhost:3308";
    $username = "root";
    $password = "XVsikn92";
    $dbname = "form";

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "La connexion a bien été établie ! ";
    } catch (PDOException $e) {
        echo "La connexion a échoué : " . $e->getMessage();
    }

    if (isset($_POST['envoyer'])) {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $age = $_POST['age'];

        $sql = "INSERT INTO `users`(`nom`, `prenom`, `age`) VALUES (:nom , :prenom , :age)";
        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':nom', $nom);
        $stmt->bindValue(':prenom', $prenom);
        $stmt->bindValue(':age', $age);
        $stmt->execute();
    }
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CCS/Form">
    <title>Form</title>
</head>

<body>
    <h1>Envoyer des données du form vers MySQL database</h1>

    <form action="Form.php" method="post">

        <label for="text">Nom :</label>
        <input type="text" name="nom">
        <label for="text">Prénom :</label>
        <input type="text" name="prenom">
        <label for="text">Age :</label>
        <input type="text" name="age">
        <input type="submit" value="Envoyer" name="envoyer">
    </form>

</body>

</html>