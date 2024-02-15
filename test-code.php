<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" />
    <link href="css/test.css" rel="stylesheet" type="text/css" />
    <link rel="icon" href="img/NLogo2.png" />


    <?php
    $scriptName = filter_input(INPUT_SERVER, 'SCRIPT_NAME');
    $pageActuelle = basename($scriptName); // Récupère le nom de fichier sans le chemin
    $pageActuelle = pathinfo($pageActuelle, PATHINFO_FILENAME); // Récupère le nom de fichier sans l'extension
    
    // echo "<title>TMAconnect - $pageActuelle</title>";
    echo "<title>TC1</title>";
    ?>
</head>

<body>
    <header>
        <?php include('includes/header.html.inc.php'); ?>
    </header>

    <?php
    // Informations de connexion à la base de données MySQL
    $servername = "localhost:3308"; // nom du serveur
    $username = "root"; // nom d'utilisateur
    $password = "XVsikn92"; // mot de passe
    $dbname = "tmaconnect"; // nom de la base de données
    
    try {
        // Création d'une connexion à la base de données avec PDO
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

        // Configuration des attributs de PDO
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Récupération des informations de l'utilisateur à afficher dans les champs de saisie
        $idUtilisateur = $_GET['id'];
        $sql = "SELECT U.nom, U.prenom, U.matricule, U.email, S.IdService, P.IdPoste, D.IdDroit, U.dateFin
            FROM tc_utilisateur U
            INNER JOIN tc_service S ON U.S_users = S.IdService
            INNER JOIN tc_poste P ON U.P_users = P.IdPoste
            INNER JOIN tc_droit D ON U.D_users = D.IdDroit
            WHERE U.IdUtil = :idUtilisateur";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':idUtilisateur', $idUtilisateur, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $nom = $row['nom'];
            $prenom = $row['prenom'];
            $matricule = $row['matricule'];
            $email = $row['email'];
            $service = $row['IdService'];
            $poste = $row['IdPoste'];
            $droit = $row['IdDroit'];
            $dateFin = $row['dateFin'];
        }
    ?>
    <section id="modif">
        <form class="formmodif" name="formmodif" action="" method="POST">
            <fieldset id="infos">
                <legend>Modifier un utilisateur</legend>

                <div class="form-check">
                    <div class="checkActif">
                        <label class="form-check-label" for="checkBoxActif">Actif</label>
                        <input class="form-check-input" type="checkbox" value="" id="checkBoxActif">
                    </div>

                    <div class="dateFin">
                        <label for="dateDeFin">Date de fin : </label>
                        <input type="date" name="calendrier" id="calendrier" value="">
                    </div>
                </div>

                <?php
                if (isset($_POST['btn_modifier'])) {
                    $idUtilisateur = $_GET['id'];
                    $nouvelleDate = $_POST['calendrier'];
                
                    $sql = "UPDATE tc_utilisateur SET dateFin = :nouvelleDate WHERE IdUtil = :idUtilisateur";
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':nouvelleDate', $nouvelleDate, PDO::PARAM_STR);
                    $stmt->bindParam(':idUtilisateur', $idUtilisateur, PDO::PARAM_INT);
                    $result = $stmt->execute();
                }
                ?>

                <div class="infosRow">
                    <label for="i_nom">Nom :</label>
                    <input type="text" class="form-control" name="i_nom" id="i_nom" size="35" disabled>

                    <label for="i_prenom">Prénom :</label>
                    <input type="text" class="form-control" name="i_prenom" id="i_prenom" size="35"
                        pattern="^[a-zA-Z�����������������������������������������������������ݟƌ\s\-]+$" required
                        disabled oninput="convertToUppercase(this)" value="">

                    <label for="i_matricule">Matricule :</label>
                    <input type="text" class="form-control" name="i_matricule" id="i_matricule" pattern="C.*" required
                        disabled value="" maxlength="5">
                </div>

                <?php
                if (isset($_POST['btn_modifier'])) {
                    $idUtilisateur = $_GET['id'];
                    $nouvelEmail = $_POST['i_email'];
                
                    $sql = "UPDATE tc_utilisateur SET email = :nouvelEmail WHERE IdUtil = :idUtilisateur";
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':nouvelEmail', $nouvelEmail, PDO::PARAM_STR);
                    $stmt->bindParam(':idUtilisateur', $idUtilisateur, PDO::PARAM_INT);
                    $result = $stmt->execute();
                }

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

                <div class="infoRow2">
                    <div class="row g-3 align-items-center">
                        <div class="col-auto">
                            <label for="i_email" class="col-form-label">Email :</label>
                            <input type="email" id="inputEmail" class="form-control"
                                aria-describedby="passwordHelpInline">
                        </div>

                        <div class="col-auto">
                            <label for="i_passwd" class="col-form-label">Mot de passe :</label>
                            <input type="password" id="inputPasswd" class="form-control"
                                aria-describedby="passwordHelpInline">
                        </div>

                        <div class="col-auto">
                            <label for="i_confirm" class="col-form-label" id="labelConfirm">Confirmation mot de passe
                                :</label>
                            <input type="password" id="inputConfirm" class="form-control"
                                aria-describedby="passwordHelpInline">
                        </div>
                    </div>
                </div>

                <div class="infosRow3">
                    <label for="lst_droit" class="labelService">Service :</label>
                    <select class="form-select" id="S_users" name="S_users" aria-label="Default select example">
                        <?php
                        echo "<option value=''></option>";
                        foreach ($result0 as $row) {
                            $idService = $row['IdService'];
                            $libelle1 = $row['s_libelle'];
                            $selected = ($idService == $service) ? 'selected' : '';
                            echo "<option value='$idService' $selected>$libelle1</option>";
                        }
                        ?>
                    </select>

                    <?php
                    if (isset($_POST['btn_modifier'])) {
                        $idUtilisateur = $_GET['id'];
                        $nouveauServ = $_POST['S_users'];

                        $sql = "UPDATE tc_utilisateur SET S_users = :nouveauServ WHERE IdUtil = :idUtilisateur";
                        $stmt = $pdo->prepare($sql);
                        $stmt->bindParam(':nouveauServ', $nouveauServ, PDO::PARAM_INT);
                        $stmt->bindParam(':idUtilisateur', $idUtilisateur, PDO::PARAM_INT);
                        $result = $stmt->execute();
                    }
                    ?>

                    <label for="lst_droit">Poste :</label>
                    <select class="form-select" id="P_users" name="P_users" aria-label="Default select example">
                        <?php
                        echo "<option value=''></option>";
                        foreach ($result1 as $row) {
                            $idPoste = $row['IdPoste'];
                            $libelle2 = $row['p_libelle'];
                            $selected = ($idPoste == $poste) ? 'selected' : '';
                            echo "<option value='$idPoste' $selected>$libelle2</option>";
                        }
                        ?>
                    </select>

                    <?php
                    if (isset($_POST['btn_modifier'])) {
                        $idUtilisateur = $_GET['id'];
                        $nouveauPoste = $_POST['P_users'];

                        $sql = "UPDATE tc_utilisateur SET P_users = :nouveauPoste WHERE IdUtil = :idUtilisateur";
                        $stmt = $pdo->prepare($sql);
                        $stmt->bindParam(':nouveauPoste', $nouveauPoste, PDO::PARAM_INT);
                        $stmt->bindParam(':idUtilisateur', $idUtilisateur, PDO::PARAM_INT);
                        $result = $stmt->execute();
                    }
                    ?>

                    <label for="lst_droit" class="labelDroit">Droit :</label>
                    <select class="form-select" id="D_users" name="D_users" aria-label="Default select example">
                        <?php
                        echo "<option value=''></option>";
                        foreach ($result2 as $row) {
                            $idDroit = $row['IdDroit'];
                            $libelle3 = $row['d_libelle'];
                            $selected = ($idDroit == $droit) ? 'selected' : '';
                            echo "<option value='$idDroit' $selected>$libelle3</option>";
                        }
                        ?>
                    </select>
                </div>

                <?php
                if (isset($_POST['btn_modifier'])) {
                    $idUtilisateur = $_GET['id'];
                    $nouveauDroit = $_POST['D_users'];

                    $sql = "UPDATE tc_utilisateur SET D_users = :nouveauDroit WHERE IdUtil = :idUtilisateur";
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':nouveauDroit', $nouveauDroit, PDO::PARAM_INT);
                    $stmt->bindParam(':idUtilisateur', $idUtilisateur, PDO::PARAM_INT);
                    $result = $stmt->execute();
                }
                ?>

                <div class="btnajout">
                    <input type="submit" onclick="" name="btn_modifier" id="btn_modifier" value="Modifier">
                    <input type="reset" name="btn_annuler" id="btn_annuler" value="Annuler"
                        onclick="window.location.href = 'user/Utilisateurs.php';">
                </div>

                <?php
                if (isset($_POST['btn_modifier'])) {
                    // Le bouton "btnajouter" a été cliqué
                    if ($result) {
                        ?>
                        <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000">
                            <div class="toast-header">
                                <i class="far fa-check-circle" style="color: #ffffff;"></i>
                                <strong class="text-white">&ensp;TMA Connect</strong>
                            </div>
                            <div class="toast-body">
                                Les informations ont été modifiées.
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

                        <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000">
                            <div class="toast-header">
                                <i class="far fa-times-circle" style="color: #ffffff;"></i>
                                <strong class="text-white">&ensp;TMA Connect</strong>
                            </div>
                            <div class="toast-body">
                                Une erreur s'est produite lors de la modification.
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
                die("La connexion a échoué: " . $e->getMessage());
            }
            ?>
            </fieldset>
        </form>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
