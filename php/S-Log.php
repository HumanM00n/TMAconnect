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
// $servername = "localhost:3308";
// $username = "root";
// $password = "XVsikn92";
// $dbname = "tmaconnect";
// $error = false;

// try {
//     $bdd = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
//     $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// } catch (PDOException $e) {
//     echo "La connexion a échoué : " . $e->getMessage();
// }

// if (isset($_POST["username"]) && isset($_POST["password"])) {
//     $st = $bdd->query("SELECT COUNT(*) FROM tc_utilisateur WHERE matricule='" . $_POST["username"] . "' AND passwd='" . $_POST["password"] . "'")->fetch();
//     if ($st['COUNT(*)'] == 1) {
//         session_start();
//         $_SESSION['username'] = $_POST["username"];
//         $_SESSION['password'] = $_POST["password"];
//         header("Location: http://localhost/TMAconnect/home.php");
//         exit();
//     } else {
//         $error = true;
//     }
// }
?> 