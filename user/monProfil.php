<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Other/html.html to edit this template
-->
<html>
    <head>
        <title>Mon Profil</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link href="../css/monProfil.css" rel="stylesheet" type="text/css"/>
        <link rel="icon" href="../img/NLogo2.png"/>
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

// R�cup�ration des informations de l'utilisateur � afficher dans les champs de saisie
            $sql2 = "SELECT U.nom, U.prenom, U.matricule, U.email, S.s_libelle, P.p_libelle, D.d_libelle, U.dateFin
FROM tc_utilisateur U
INNER JOIN tc_service S ON U.S_users = S.IdService
INNER JOIN tc_poste P ON U.P_users = P.IdPoste
INNER JOIN tc_droit D ON U.D_users = D.IdDroit
WHERE matricule = :idUtilisateur";
            $stmt2 = $pdo->prepare($sql2);
            $stmt2->bindParam(':idUtilisateur', $username1, PDO::PARAM_STR);
            $stmt2->execute();

            if ($stmt2->rowCount() > 0) {
                $row = $stmt2->fetch(PDO::FETCH_ASSOC);
                $nom2 = $row['nom'];
                $prenom2 = $row['prenom'];
                $matricule = $row['matricule'];
                $email = $row['email'];
                $service = $row['s_libelle'];
                $poste = $row['p_libelle'];
                $droit = $row['d_libelle'];
                $dateFin = $row['dateFin'];
            }
            ?>

            <section id="profil">
                <form class="formprofil" name="formprofil" action="" method="POST">
                    <fieldset id="profilFieldset1">
                        <div>
                            <label for="i_nom">Nom :</label>
                            <input type="text" name="i_nom2" id="i_nom2" size="35" disabled value="<?php echo $nom2; ?>">
                        </div>

                        <div>
                            <label for="i_prenom">Prénom :</label>
                            <input type="text" name="i_prenom2" id="i_prenom2" size="35" disabled pattern="^[a-zA-Z�����������������������������������������������������ݟƌ\s\-]+$" required oninput="convertToUppercase(this)" value="<?php echo $prenom2; ?>">
                        </div>

                        <div>
                            <label for="i_matricule">Matricule :</label>
                            <input type="text" name="i_matricule2" id="i_matricule2" disabled pattern="C.*" required value="<?php echo $matricule; ?>" maxlength="5">
                        </div>

                        <div>
                            <label for="service">Service :</label>
                            <input type="text" name="service2" id="service2" disabled value="<?php echo $service; ?>">
                        </div>



                        <div>
                            <label for="service">Poste :</label>
                            <input type="text" name="poste2" id="poste2" disabled value="<?php echo $poste; ?>">
                        </div>


                        <div>
                            <label for="service">Droit :</label>
                            <input type="text" name="droit2" id="droit2" disabled value="<?php echo $droit; ?>">
                        </div>


                        <div>
                            <label>Date de fin : </label>
                            <input type="date" name="calendrier2" id="calendrier2" disabled value="<?php echo $dateFin; ?>">
                        </div>

                    </fieldset>
                </form>

                <form class="formprofil2" name="formprofil2" action="" method="POST">
                    <fieldset id="profilFieldset2">


                        <div class="email-container">
                            <label for="i_email">Email :</label>
                            <input type="email" name="i_email2" id="i_email2" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" value="<?php echo $email; ?>">
                        </div>

                        <div class="button-container">
                            <input type="submit" onclick="" name="btn_modifierEmail" id="btn_modifierEmail" value="Modifier l'email">
                        </div>

                        <?php
                        if (isset($_POST['btn_modifierEmail'])) {


                            $nouvelEmail = $_POST['i_email2'];

                            if ($nouvelEmail != $email) {

                                $sql = "UPDATE tc_utilisateur SET email = :nouvelEmail WHERE matricule = :idUtilisateur";
                                $stmt = $pdo->prepare($sql);
                                $stmt->bindParam(':nouvelEmail', $nouvelEmail, PDO::PARAM_STR);
                                $stmt->bindParam(':idUtilisateur', $username1, PDO::PARAM_STR);
                                $result = $stmt->execute();

                                echo 'Le mail a été mis à jour avec succès';
                            } else {
                                echo 'Le nouveau mail est similaire à l\'ancien.';
                            }
                        }
                        ?>


                        <fieldset id="profilFieldset3">


                            <div class="mdp-container">
                                <label for="i_email">Ancien mot de passe :</label>
                                <input type="password" name="oldmdp" id="oldmdp">
                            </div>

                            <div class="mdp-container">
                                <label for="i_email">Nouveau mot de passe :</label>
                                <input type="password" name="newmdp" id="newmdp">
                            </div>

                            <div class="mdp-container">
                                <label for="i_email">Confirmer mot de passe :</label>
                                <input type="password" name="confmdp" id="confmdp">
                            </div>

                            <div class="button-container">
                                <input type="submit" onclick="" name="btn_modifierMdp" id="btn_modifierMdp" value="Modifier le mot de passe">
                            </div>


                            <?php
                            if (isset($_POST['btn_modifierMdp'])) {
                                $o_passwd = filter_input(INPUT_POST, 'oldmdp', FILTER_SANITIZE_FULL_SPECIAL_CHARS); //  Permet de filtrer et nettoyer des caractères spéciaux dangereux -> sécurité (équivalent : $_POST['o_passwd'];)      
                                $n_passwd = filter_input(INPUT_POST, 'newmdp', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                                $c_passwd = filter_input(INPUT_POST, 'confmdp', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                                if (empty($o_passwd) || empty($n_passwd) || empty($c_passwd)) {
                                    echo "Veuillez remplir tous les champs des mots de passe.";
                                    exit;
                                }

                                if ($n_passwd !== $c_passwd) {
                                    echo "Les nouveaux mots de passe ne correspondent pas.";
                                    exit;
                                }

                                $query = "SELECT passwd FROM tc_utilisateur WHERE matricule = :matricule";
                                $stmt3 = $pdo->prepare($query);
                                $stmt3->bindParam(':matricule', $username1, PDO::PARAM_STR); // PDO::param_str renforce la sécurité de l'application et évite les injections sql
                                $stmt3->execute();
                                $hashedPassword0 = $stmt3->fetchColumn();

                                if ($hashedPassword0 === $o_passwd || password_verify($o_passwd, $hashedPassword0)) {
                                    $hashedPassword = password_hash($n_passwd, PASSWORD_DEFAULT);

                                    $updateQuery = "UPDATE tc_utilisateur SET passwd = :n_passwd WHERE matricule = :matricule";
                                    $updateStmt = $pdo->prepare($updateQuery);
                                    $updateStmt->bindParam(':n_passwd', $hashedPassword, PDO::PARAM_STR);
                                    $updateStmt->bindParam(':matricule', $username1, PDO::PARAM_STR);
                                    $result = $updateStmt->execute();

                                    echo "Le mot de passe a été modifié avec succès.";
                                } else {
                                    echo "L'ancien mot de passe est incorrect.";
                                }
                            }
                            ?>


                        </fieldset>
                    </fieldset>
                </form>

                <?php
            } catch (PDOException $e) {
                die("La connexion a �chou�: " . $e->getMessage());
            }
            ?>
        </section>
    </body>
</html>
