<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/ClientSide/html.html to edit this template
-->
<html>
<head>
    <title>TODO supply a title</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../js/javascript.js" type="text/javascript"></script>
</head>
<body>
    <?php
    $servername = "localhost:3308"; // Nom du serveur
    $username = "root"; // Nom d'utilisateur
    $password = "XVsikn92"; // Mot de passe
    $dbname = "tmaconnect"; // Nom de la base de données

    try {
        // Connexion à la base de données en utilisant PDO
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

        $nom = $_POST['i_nom'];
        $prenom = $_POST['i_prenom'];
        $matricule = $_POST['i_matricule'];
        $email = $_POST['i_email'];
        $passwd = $_POST['i_passwd'];
        $S_users = $_POST['S_users'];
        $P_users = $_POST['P_users'];
        $D_users = $_POST['D_users'];
        $datefin = $_POST['calendrier'];

        // Préparation de la requête d'insertion en utilisant des paramètres nommés
        $sql = "INSERT INTO tc_utilisateur (nom, prenom, matricule, email, passwd, S_users, P_users, D_users, dateFin) VALUES (:nom, :prenom, :matricule, :email, :passwd, :S_users, :P_users, :D_users, :datefin)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':matricule', $matricule);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':passwd', $passwd);
        $stmt->bindParam(':S_users', $S_users);
        $stmt->bindParam(':P_users', $P_users);
        $stmt->bindParam(':D_users', $D_users);
        $stmt->bindParam(':datefin', $datefin);

        // Exécution de la requête d'insertion
        if ($stmt->execute()) {
            echo "Données insérées avec succès.";
        } else {
            echo "Erreur lors de l'insertion des données.";
        }
    } catch (PDOException $e) {
        echo "Erreur de connexion à la base de données : " . $e->getMessage();
    }
    ?>
</body>
</html>
