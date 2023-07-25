<?php
$username = "root";
$password = "XVsikn92";
$dbname = "tmaconnect";
$error = false;
$dsn = "mysql:host=localhost:3308;dbname=tmaconnect";


if (isset($_POST['username'])) {
    $matricule = $_POST['username'];
    $passwd = $_POST['password'];

    try {
        $pdo = new PDO($dsn, $username, $password);

        $selectQuery = "SELECT passwd FROM tc_utilisateur WHERE matricule = :matricule";
        $selectStmt = $pdo->prepare($selectQuery);
        $selectStmt->execute(['matricule' => $matricule]);
        $row = $selectStmt->fetch();
        if ($row && password_verify($passwd, $row['passwd'])) {
            // Mot de passe correct, vous pouvez permettre la connexion
            header("Location: http://localhost/TMAconnect/home.php");
        } else {
            // Mot de passe incorrect
            $error = true;
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>


<?php 
    function encryptPassword( $password ) {
        $encrypted = "";
        for( $i = strlen($password) - 1; $i >= 0 ; $i-- ) {
            $encrypted .= chr(ord($password[$i]) + 1);
        }
        return $encrypted;
    }
    
    function decryptPassword( $password ) {
        $decrypted = "";
        for( $i = strlen($password) - 1; $i >= 0 ; $i-- ) {
            $decrypted .= chr(ord($password[$i]) - 1);
        }
        return $decrypted;
    }
?>


