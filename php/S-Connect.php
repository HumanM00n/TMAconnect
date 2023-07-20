<?php
$dsn = "mysql:host=localhost:3308;dbname=tmaconnect";
$username = 'root';
$password = 'XVsikn92';

if (isset($_POST['login'])) {
    $matricule = $_POST['matricule'];
    $passwd = $_POST['passwd'];

    try {
        $pdo = new PDO($dsn, $username, $password);

        $selectQuery = "SELECT passwd FROM tc_utilisateur WHERE matricule = :matricule";
        $selectStmt = $pdo->prepare($selectQuery);
        $selectStmt->execute(['matricule' => $matricule]);
        $row = $selectStmt->fetch();

        if ($row && password_verify($passwd, $row['passwd'])) {
            // Mot de passe correct, vous pouvez permettre la connexion
            echo "Authentification réussie.";
        } else {
            // Mot de passe incorrect
            echo "Identifiant ou mot de passe incorrect.";
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>