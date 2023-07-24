<?php
// Sommes-nous sur l'index ? Récupération du nom de page dans $pageActuelle
$scriptName = filter_input(INPUT_SERVER, 'SCRIPT_NAME');
$pageActuelle = substr($scriptName, strrpos($scriptName, '/') + 1);
if ($pageActuelle === 'home.php') {
    $dirIndex = './';
    $dirPages = './pages/';
} else {
    $dirIndex = '../';
    $dirPages = './';
}


$scriptName = filter_input(INPUT_SERVER, 'SCRIPT_NAME');
$pageActuelle = basename($scriptName); // Récupère le nom de fichier sans le chemin
$pageActuelle = pathinfo($pageActuelle, PATHINFO_FILENAME); // Récupère le nom de fichier sans l'extension

echo "<title>TMAconnect - $pageActuelle</title>";

session_start();

try {
    // Votre code de connexion � la base de donn�es
    // ...
// informations de connexion à la base de données MySQL
    $servername = "localhost:3308"; // nom du serveur
    $username = "root"; // nom d'utilisateur
    $password = "XVsikn92"; // mot de passe
    $dbname = "tmaconnect"; // nom de la base de données
// création d'une connexion à la base de données


    $bdd = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // R�cup�rer le nom d'utilisateur � partir de la variable de session
    $username1 = $_SESSION['username'];

    var_dump($_SESSION['username']);

    // Vérifier si l'utilisateur est connecté
    if (!isset($_SESSION['username'])) {
        // Rediriger l'utilisateur vers la page de connexion.
        header("Location: http://localhost/TMAconnect/index.php");
        exit();
    }

    $sql0 = "SELECT prenom, nom FROM tc_utilisateur WHERE matricule = :username";
    $stmt0 = $bdd->prepare($sql0);
    $stmt0->bindParam(':username', $username1);
    $stmt0->execute();

    $result = $stmt0->fetch(PDO::FETCH_ASSOC);

    $nom = $result['nom'];
    $initNom = substr($nom, 0, 1);

    $prenom = $result['prenom'];
    $initPrenom = substr($prenom, 0, 1);

    $affichage = $initPrenom . $initNom;

    // Requ�te SQL pour v�rifier les droits de l'utilisateur
    $sql = "SELECT d_users FROM tc_utilisateur WHERE matricule = :username AND d_users = 1";
    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(':username', $username1);
    $stmt->execute();

    try {
        // V�rifier si l'utilisateur a le droit 1
        if ($stmt0->rowCount() && $stmt->rowCount() > 0) {

            // L'utilisateur a le droit 1
            ?>

            <head>
                <meta charset="UTF-8">
            </head>
            <nav class="barre-arianne">


                <ul>
                    <li class="Onglet"><a href="<?php echo $dirPages; ?>../home">Accueil</a></li>
                    <li class="Onglet"><a href="#" class="deroulant">Demandes ▼</a>
                        <ul class="sous">
                            <li><a href="<?php echo $dirPages; ?>../demande/creationDemande.php">Créer une demande</a></li>
                        </ul>
                    </li>
                    <li class="Onglet"><a href="<?php echo $dirPages; ?>../user/Utilisateurs.php">Utilisateurs</a></li>

                    <li class="NomPage">
                        <?php $pageActuelle ?>
                    </li>

                    <li class="MonCompte"><a href="#">
                            <?php echo $affichage ?>
                        </a>
                        <ul class="sous2">
                            <li><a href="<?php echo $dirPages; ?>../user/MonProfil.php">Mon Profil</a></li>
                            <li><a href="#" id="logout-link">Se d&eacute;connecter</a></li>

                            <script>
                                document.getElementById('logout-link').addEventListener('click', function (event) {
                                    event.preventDefault(); // Empêche l'ouverture de lien

                                    // Effectuer une requête AJAX vers le script de déconnexion
                                    var xhr = new XMLHttpRequest();
                                    xhr.open('GET', 'pages/<?php echo $dirIndex; ?>../php/S-Deconnect.php', true);
                                    xhr.onreadystatechange = function () {
                                        if (xhr.readyState === XMLHttpRequest.DONE) {
                                            if (xhr.status === 200) {
                                                window.location.href = '<?php echo $dirPages; ?>../index.php'; // Rediriger vers la page index.php
                                            } else {
                                                // Erreur lors de l'exécution du script de déconnexion
                                                console.error('Erreur de déconnexion');
                                            }
                                        }
                                    };
                                    xhr.send();
                                });
                            </script>
                        </ul>
                    </li>
                </ul>
            </nav>
            <?php
        } elseif ($stmt0->rowCount()) {
            ?>
            <nav class="barre-arianne">
                <ul>

                    <li class="Onglet"><a href="<?php echo $dirPages; ?>../home.php">Accueil</a></li>
                    <li class="Onglet"><a href="#" class="deroulant">Demandes ▼</a>
                        <ul class="sous">
                            <li><a href="#">Créer une demande</a></li>
                        </ul>
                    </li>

                    <li class="MonCompte"><a href="#">
                            <?php echo $affichage ?>
                        </a>
                        <ul class="sous2">
                            <li><a href="<?php echo $dirPages; ?>../user/monProfil.php">Mon Profil</a></li>
                            <li><a href="#" id="logout-link">Se d&eacute;connecter</a></li>

                            <script>
                                document.getElementById('logout-link').addEventListener('click', function (event) {
                                    event.preventDefault(); // Empêche l'ouverture de lien

                                    // Effectuer une requête AJAX vers le script de déconnexion
                                    var xhr = new XMLHttpRequest();
                                    xhr.open('GET', 'php/<?php echo $dirIndex; ?>S-Deconnect.php', true);
                                    xhr.onreadystatechange = function () {
                                        if (xhr.readyState === XMLHttpRequest.DONE) {
                                            if (xhr.status === 200) {
                                                window.location.href = '<?php echo $dirPages; ?>index.php'; // Rediriger vers la page index.php
                                            } else {
                                                // Erreur lors de l'exécution du script de déconnexion
                                                console.error('Erreur de déconnexion');
                                            }
                                        }
                                    };
                                    xhr.send();
                                });
                            </script>
                        </ul>
                    </li>
                </ul>
            </nav>

            <?php
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
} catch (PDOException $e) {
    echo "La connexion a �chou� : " . $e->getMessage();
}
?>