<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../img/NLogo2.png" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
        <symbol id="check-circle-fill" viewBox="0 0 16 16">
            <path
                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
        </symbol>
    </svg>
    <link rel="stylesheet" href="../css/csshome.css">
    <link rel="stylesheet" href="../css/mise-en-prod.css">
    
    <title>TMA - Mise en production</title>
</head>

<?php include('../includes/connexion.inc.php') ?>

<body>
  <!------------------------------------------
  |             BOUTON "RETOUR"              | 
  ------------------------------------------->
    <div class="btnretour">
        <button onClick=" history.back();">Retour</button>
    </div>

   <!------------------------------------------
  |             REQUETE SQL                   | 
   -------------------------------------------->
    <?php

    $id_Demande = $_GET['idDemande'];

    // Requête pour récupérer le libellé de la demande
    $sql0 = "SELECT libelle FROM tc_demandes WHERE IdDemande =" . $id_Demande;
    $stmt0 = $pdo->query($sql0);
    $row0 = $stmt0->fetch(PDO::FETCH_ASSOC);

    // Requête pour récupérer les noms qui ont pour service TMA
    $sql1 = "SELECT IdUtil, nom FROM tc_utilisateur WHERE S_users = 1 AND 7";
    $stmt1 = $pdo->query($sql1);
    $result1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);

    // Requête pour récupérer le numéro de la demande
    $sql2 = "SELECT IdDemande FROM tc_demandes WHERE IdDemande =" . $id_Demande;
    $stmt2 = $pdo->query($sql2);
    $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);

    // Requête SQL pour récupérer l'ID de la MEP associée à la demande actuelle
    $sql3 = "SELECT IdMep FROM tc_demandes WHERE IdDemande =" . $id_Demande;
    $stmt3 = $pdo->query($sql3);
    $row3 = $stmt3->fetch(PDO::FETCH_ASSOC);
    $IdMep = $row3['IdMep'];

    if ($IdMep > 0) {
    $sql6 = "SELECT date_mep, util_emet_mep FROM tc_mep WHERE IdMep = :IdMep";
    $stmt6 = $pdo->prepare($sql6);
    $stmt6->bindParam(':IdMep', $IdMep, PDO::PARAM_INT);
    $stmt6->execute();
    $row6 = $stmt6->fetch(PDO::FETCH_ASSOC);
    $var_date_mep = $row6['date_mep'];
    $var_util_emet_mep = $row6['util_emet_mep']; 

    $sql7 = "SELECT 
            M.IdMep , 
            U.nom AS util_emet_mep
        FROM tc_mep M 
        JOIN tc_utilisateur U ON M.util_emet_mep = U.IdUtil
        WHERE M.IdMep = $IdMep";

    $stmt7 = $pdo->query($sql7);
    $row7 = $stmt7->fetch(PDO::FETCH_ASSOC);
    $var_util_mep = $row7['util_emet_mep'];
    }else{
        $var_date_mep = 0;
        $var_util_emet_mep = 0;
        $var_util_mep = 0;
    }
    ?>


  <!------------------------------------------
  |              FORMULAIRE MEP              | 
  ------------------------------------------->
  <main>
    <section class="container" id="container">
        <h3><b>Mise en production</b></h3>
        <form class="row g-3" method="post">

            <div class="col-md-6" id="divText">
                <label for="inputLib" class="form-label">Libellé</label>
                <input type="text" class="form-control" id="inputLib" disabled value="<?php echo $row0['libelle']; ?>">
            </div>

            <div class="infosColumn">
                <div class="col-md-4" id="divPar">
                    <label for="inputUtil" class="form-label">Par</label>
                    <select id="inputUtil" name="inputUtil" class="form-select">
                        <option value=''></option>
                        <?php
                        foreach ($result1 as $row) {
                            $id_util = $row['IdUtil'];
                            $nom = $row['nom'];
                            $selected = ($id_util == $var_util_emet_mep) ? 'selected' : '';
                            echo "<option value='$id_util' $selected>$nom</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="col-md-6" id="divDate">
                    <label for="inputDate" class="form-label">Date de mise en production</label>
                    <input type="text" class="form-control" id="datepicker" name="datepicker"
                        pattern="\d{1,2}/\d{1,2}/\d{4}" placeholder="<?php
                        if ($var_date_mep > 0) {
                            $date_mep_bon_format = substr($var_date_mep, 8, 2) . '/' . substr($var_date_mep, 5, 2) . '/' . substr($var_date_mep, 0, 4);
                            echo $date_mep_bon_format;
                        } ?>">
                </div>

                <div class="col-md-6" id="divNumber">
                    <label for="inputNumber" class="form-label">Procédure de mise en production</label>
                    <input type="number" class="form-control" id="inputNumber" disabled value="<?php echo $row2['IdDemande']; ?>">
                </div>

                <div class="btnajout">
                <!------------------------------------------
                |                 MODIFIER                 | 
                -------------------------------------------->
                    <?php if ($IdMep > 0): ?>
                        <div class="btnajout">
                            <button type="submit" name="btn_modifier" style="padding: 10px 10px;">Enregistrer</button>
                            <button type="reset">Annuler</button>
                        </div>

                        <?php
                        if (isset($_POST['btn_modifier'])) {
                            $var0 = $_POST["datepicker"];
                            $date_mep_bon_format = substr($var0, 6, 4) . substr($var0, 3, 2) . substr($var0, 0, 2);
                            $var1 = $_POST["inputUtil"];
                            $sql4 = "UPDATE tc_mep SET date_mep = " . $date_mep_bon_format . ", util_emet_mep =" . $var1 . " WHERE IdMep = " . $IdMep;
                            $stmt4 = $pdo->prepare($sql4);
                            $result4 = $stmt4->execute([$date_mep_bon_format, $var1, $IdMep]);
                        }

                        if (isset($stmt4)) {
                            if ($stmt4->execute([$date_mep_bon_format, $var_util_emet_mep])) {
                                    echo '<div class="alert alert-primary d-flex justify-content-start align-items-center" role="alert">
                                    <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                                    <div>
                                      La date de mise en production a été modifié
                                    </div>
                                  </div>';
                            } else {
                                echo '<div class="alert alert-danger d-flex align-items-center" role="alert">
                                        <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                                        <div>Une erreur s\'est produite lors de la modification d\'une mise en production.</div>
                                      </div>';
                            }
                        } 
                        ?>
                    <?php else: ?>
                        <div class="btnajout">
                            <button type="submit" name="btnajout">Valider</button>
                            <button type="reset">Annuler</button>
                        </div>

                <!------------------------------------------
                |               INSERTION                  |  
                ------------------------------------------->

                        <?php
                        if (isset($_POST['btnajout'])) {
                            if (isset($_POST["datepicker"]) && isset($_POST["inputUtil"])) {
                                $date_mep = isset($_POST['datepicker']) ? $_POST['datepicker'] : '';
                                $util_mep = isset($_POST['inputUtil']) ? $_POST['inputUtil'] : '';

                                // Formatage de la date au bon format (AAAA-MM-JJ)
                                $date_mep_bon_format = substr($date_mep, 6, 4) . substr($date_mep, 3, 2) . substr($date_mep, 0, 2);
                                
                                // Initialisation des variables pour le binValue
                                $var0 = $_POST["datepicker"]; // id du champs 
                                $var1 = $_POST["inputUtil"]; // id du champs 

                                // Requête d'insertion dans la table tc_mep
                                $sql5 = "INSERT INTO tc_mep (date_mep, util_emet_mep) VALUES (:var0, :var1)";
                                $stmt5->bindValue(":var0", $var0);
                                $stmt5->bindValue(":var1", $var1);
                                $stmt5 = $pdo->prepare($sql5);
                                $stmt5->execute([$date_mep_bon_format, $var1]);

                                //Récupère l'id avec lequel je vais mettre à jour la table tc_demandes
                                $id = $pdo->lastInsertId(); 
                                $sql8 = "UPDATE tc_demandes SET IdMep = "   . $id . " WHERE IdDemande = " . $id_Demande;
                                $stmt8 = $pdo->prepare($sql8);
                                $result8 = $stmt8->execute([$id, $id_Demande]);
                                
                                // Vérifiez si la préparation de la requête a réussi
                                if ($stmt5 !== false) {
                                    // Affiche un libellé 'Succès' quand une mise en prod a été crée
                                    if ($stmt5->execute([$date_mep_bon_format, $util_mep])) {
                                        echo '<div class="alert alert-success d-flex align-items-center" role="alert">
                                                <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                                                <div>Mise en production effectuée avec succès !</div>
                                              </div>';
                                    } else {
                                        echo '<div class="alert alert-danger d-flex align-items-center" role="alert">
                                                <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                                                <div>Une erreur s\'est produite lors de la création d\'une mise en production.</div>
                                              </div>';
                                    }
                                } else {
                                    echo "Erreur lors de la préparation de la requête.";
                                }
                            }
                        }
                        ?>
                    <?php endif; ?>
                </div>
            </div>
        </form>
    </section>
</main>


    <!-- Lien vers jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Lien vers Bootstrap.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-eOJMYuvWlv6Kk1V19EtiWZq1lDHfVIK3tu7W7SQa5n3eNMDWivcFdHZISdRlNW9x"
        crossorigin="anonymous"></script>

    <!-- Toast "Success" lors de la date de mise en prod effectuée -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var toastElement = document.querySelector('.toast');
            var toast = new bootstrap.Toast(toastElement);
            toast.show();
        });

    </script>

</body>

</html>