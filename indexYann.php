<?php
session_start();

// informations de connexion à la base de données MySQL
$servername = "localhost"; // nom du serveur
$username = "root"; // nom d'utilisateur
$password = ""; // mot de passe
$dbname = "tmaconnect"; // nom de la base de données
// création d'une connexion à la base de données


try {
    $bdd = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "La connexion a �chou� : " . $e->getMessage();
}

if (isset($_POST["username"]) && isset($_POST["password"])) {
    $st = $bdd->prepare("SELECT passwd FROM tc_utilisateur WHERE matricule=:username");
    $st->bindParam(':username', $_POST["username"]);

    if ($st->execute()) {
        $hashedPassword = $st->fetchColumn();



        if ($hashedPassword && password_verify($_POST["password"], $hashedPassword)) {
            $_SESSION['username'] = $_POST["username"];
            $_SESSION['password'] = $_POST["password"];

            $st1 = $bdd->prepare("UPDATE tc_utilisateur SET derniere_connect = now() WHERE matricule=:username");
            $st1->bindParam(':username', $_POST["username"]);
            $st1->execute();

            header("Location: http://tmaconnect/TMAConnect/public_html/home.php");
            exit();
        } else {
            $error = true;
        }
    } else {
        $error = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/NLogo2.png" />
    <link rel="stylesheet" href="css/index.css">
    <title>Authentification - TMAconnect</title>
</head>
<header>
    <center><img class="logo" src="img/NLogo.png"></center>
</header>

<body>
    <div class="container">
        <h2>
            <center>Connexion à votre compte</center>
        </h2>
        <?php
        if (isset($error) && $error) {
            echo '<div class="alert alert-warning d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
            <div>
            Identifiant ou mot de passe incorrect.
            </div>
          </div>';
        }
        ?>

        <!-- CHAMPS DE FORMULAIRE -->
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <section class="bloc_id">
                <div class="identifiant">
                    <p>Identifiant</p>
                    <input class="champs_txt" type="text" name="username" required minlength="5" max="5">
                    <span class="icon">
                        <ion-icon name="person"></ion-icon>
                    </span>
                </div>
            </section>

            <div class="lmdp">
                <a href="pages/change-mdp.php" class="tma-btn">Mot de passe oublié</a>
            </div>

            <section class="bloc_mdp">
                <div class="mdp">
                    <label>
                        <p>Mot de passe</p>
                        <input class="champs_txt" type="password" name="password" required minlength="4" maxlength="30">

                        <!-- ICONES -->
                        <div class="password-icon">
                            <i data-feather="eye"></i>
                            <i data-feather="eye-off"></i>
                        </div>
                    </label>

                    <script src="https://unpkg.com/feather-icons"></script>
                    <script>
                        feather.replace();
                    </script>

                    <script>
                        const eye = document.querySelector('.feather-eye');
                        const eyeoff = document.querySelector(' .feather-eye-off');
                        const passwordField = document.querySelector('input[type=password]');

                        eye.addEventListener('click', () => {
                            eye.style.display = "none";
                            eyeoff.style.display = "block";
                            passwordField.type = "text";
                        });

                        eyeoff.addEventListener('click', () => {
                            eyeoff.style.display = "none";
                            eye.style.display = "block";
                            passwordField.type = "password";
                        });
                    </script>
                </div>
                <a href="../TMAconnect/home.php"><input class="tma-btn" type="submit" value="Se Connecter"></a>
            </section>
        </form>
        <label class="remember"><input type="checkbox">Se souvenir de moi</label>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>



</body>

</html>