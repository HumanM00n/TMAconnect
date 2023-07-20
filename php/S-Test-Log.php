<?php
$servername = "localhost:3308";
$username = "root";
$password = "XVsikn92";
$dbname = "tmaconnect";

$error = false;

try {
    $bdd = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "La connexion a échoué : " . $e->getMessage();
}

if (isset($_POST["username"]) && isset($_POST["password"])) {
    $st = $bdd->query("SELECT COUNT(*) FROM tc_utilisateur WHERE matricule='" . $_POST["username"] . "' AND passwd='" . $_POST["password"] . "'")->fetch();
    if ($st['COUNT(*)'] == 1) {
        session_start();
        $_SESSION['username'] = $_POST["username"];
        $_SESSION['password'] = $_POST["password"];
        header("Location: http://localhost/TMAconnect/home.php");
        exit();
    } else {
        $error = true;
    }
}

?>

<!DOCTYPE html>
<html>

<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <title>Page de connexion</title>
</head>

<body>
    <div class="alert">
        <div class="alert alert-primary">
            zefzefzefzefzeffzefzefezfzefzefezfzefzfzfzefzeffzefzefzefzefzefzfzef
        </div>

    </div>












    <?php if ($error) {


        ?>
    <?php } ?>
    <form action="" method="POST">
        <label for="username">Nom d'utilisateur:</label>
        <input type="text" id="username" name="username">
        <br>
        <label for="password">Mot de passe:</label>
        <input type="password" id="password" name="password">
        <br>
        <input type="submit" value="Se connecter">
    </form>
</body>

</html>