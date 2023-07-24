<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/ClientSide/html.html to edit this template
-->
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link href="../css/csshome.css" rel="stylesheet" type="text/css" />
    <link rel="icon" href="../img/NLogo2.png" />

    <?php
    $scriptName = filter_input(INPUT_SERVER, 'SCRIPT_NAME');
    $pageActuelle = basename($scriptName); // Récupère le nom de fichier sans le chemin
    $pageActuelle = pathinfo($pageActuelle, PATHINFO_FILENAME); // Récupère le nom de fichier sans l'extension
    
    echo "<title>TMAconnect - $pageActuelle</title>";
    ?>
</head>

<body>
    <header>
        <?php include('../includes/header.html.inc.php'); ?>
    </header>

    <div id="alertContainer2"></div>

    <section id="nvldemande">
        <form id="form_nvldemande" name="form_nvlemploye" action="" method="POST">
            <fieldset id="coordo">
                <legend>Ajouter un utilisateur</legend>
                <div>
                    <label for="i_nom">Nom :</label>
                    <input type="text" name="i_nom" id="i_nom" size="35"
                        pattern="^[a-zA-Záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœ�?ÀÂÄÃÅÇÉÈÊË�?ÌÎ�?ÑÓÒÔÖÕÚÙÛÜ�?ŸÆŒ\s\-]+$" required
                        required oninput="convertToUppercase(this)">
                </div>
                <script>
                    function convertToUppercase(input) {
                        input.value = input.value.toUpperCase();
                    }
                </script>
                <div>
                    <label for="i_prenom">Prénom :</label>
                    <input type="text" name="i_prenom" id="i_prenom" size="35"
                        pattern="^[a-zA-Záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœ�?ÀÂÄÃÅÇÉÈÊË�?ÌÎ�?ÑÓÒÔÖÕÚÙÛÜ�?ŸÆŒ\s\-]+$" required
                        required oninput="convertFirstLetter(this)">
                </div>
                <script>
                    function convertFirstLetter(input) {
                        var value = input.value;
                        var firstLetter = value.charAt(0).toUpperCase();
                        var restOfString = value.substring(1);
                        input.value = firstLetter + restOfString;
                    }
                </script>
                <div>
                    <label for="i_url">Matricule :</label>
                    <input type="text" name="i_matricule" id="i_matricule" pattern="C[0-9]+" required>
                </div>
                <div>
                    <label for="i_email">Email :</label>
                    <input type="email" name="i_email" id="i_email" pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                        required>
                    <div class="input-validation"></div>
                </div>
                <div>
                    <label for="i_passwd">Mot de passe :</label>
                    <input type="text" name="i_passwd" id="i_passwd">
                </div>

                <?php
                // Informations de connexion � la base de donn�es MySQL
                $servername = "localhost:3308"; // nom du serveur
                $username = "root"; // nom d'utilisateur
                $password = "XVsikn92"; // mot de passe
                $dbname = "tmaconnect"; // nom de la base de donn�es
                
                try {
                    // Cr�ation d'une connexion � la base de donn�es avec PDO
                    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

                    // Configuration des attributs de PDO
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    // Requ�tes SQL pour r�cup�rer les donn�es des tables tc_service, tc_poste et tc_droit
                    $sql0 = "SELECT IdService, s_libelle FROM tc_service";
                    $stmt0 = $pdo->query($sql0);
                    $result0 = $stmt0->fetchAll(PDO::FETCH_ASSOC);

                    $sql1 = "SELECT IdPoste, p_libelle FROM tc_poste";
                    $stmt1 = $pdo->query($sql1);
                    $result1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);

                    $sql2 = "SELECT IdDroit, d_libelle FROM tc_droit";
                    $stmt2 = $pdo->query($sql2);
                    $result2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
                    ?>

                    <div>
                        <label for="S_users">Service :</label>
                        <select name="S_users" id="S_users">
                            <?php
                            foreach ($result0 as $row) {
                                $idService = $row['IdService'];
                                $libelle1 = $row['s_libelle'];
                                echo "<option value='$idService'>$libelle1</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div>
                        <label for="P_users">Poste :</label>
                        <select name="P_users" id="P_users">
                            <?php
                            foreach ($result1 as $row) {
                                $idPoste = $row['IdPoste'];
                                $libelle2 = $row['p_libelle'];
                                echo "<option value='$idPoste'>$libelle2</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div>
                        <label for="D_users">Droit :</label>
                        <select name="D_users" id="D_users">
                            <?php
                            foreach ($result2 as $row) {
                                $idDroit = $row['IdDroit'];
                                $libelle3 = $row['d_libelle'];
                                echo "<option value='$idDroit'>$libelle3</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div>
                        <label for="calendrier">Date de fin (optionnel) :</label>
                        <input type="date" name="calendrier" id="calendrier">
                    </div>

                    <div class="btnajout">
                        <button type="submit" name="btnajout">CR&Eacute;ER</button>
                    </div>
                </fieldset>
            </form>
        </section>

        <?php
        if (isset($_POST['btnajout'])) {
            // Le bouton "btnajouter" a �t� cliqu�
            $nom = isset($_POST['i_nom']) ? $_POST['i_nom'] : '';
            $prenom = isset($_POST['i_prenom']) ? $_POST['i_prenom'] : '';
            $matricule = isset($_POST['i_matricule']) ? $_POST['i_matricule'] : '';
            $email = isset($_POST['i_email']) ? $_POST['i_email'] : '';
            $passwd = isset($_POST['i_passwd']) ? password_hash($_POST['i_passwd'], PASSWORD_DEFAULT) : '';
            $S_users = isset($_POST['S_users']) ? $_POST['S_users'] : '';
            $P_users = isset($_POST['P_users']) ? $_POST['P_users'] : '';
            $D_users = isset($_POST['D_users']) ? $_POST['D_users'] : '';
            $datefin = isset($_POST['calendrier']) ? $_POST['calendrier'] : '';

            $sql = "INSERT INTO tc_utilisateur (nom, prenom, matricule, email, passwd, S_users, P_users, D_users, dateFin) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$nom, $prenom, $matricule, $email, $passwd, $S_users, $P_users, $D_users, $datefin]);

            if ($stmt->rowCount() > 0) {
                ?>
                <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000">
                    <div class="toast-header">
                        <i class="far fa-check-circle" style="color: #ffffff;"></i>
                        <strong class="text-white">&ensp;TMA Connect</strong>
                    </div>
                    <div class="toast-body">
                        L'utilisateur a été créé avec succès.
                    </div>
                </div>

                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
                <script>
                    $(document).ready(function () {
                        $('.toast').toast('show');
                    });
                </script>
                <?php
            } else {
                ?>
                <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="10000">
                    <div class="toast-header1">
                        <i class="fas fa-times" style="color: #ffffff;"></i>
                        <strong class="text-white">&ensp;TMA Connect</strong>
                    </div>
                    <div class="toast-body">
                        Erreur lors de la création de l'utilisateur
                    </div>
                </div>

                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
                <script>
                    $(document).ready(function () {
                        $('.toast').toast('show');
                    });
                </script>
                <?php
            }
        }
                } catch (PDOException $e) {
                    die("La connexion a �chou�: " . $e->getMessage());
                }
                ?>

</body>

</html>