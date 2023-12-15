<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../img/NLogo2.png"/>
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
    ?>

  <!------------------------------------------
  |               INSERTION                   | 
   -------------------------------------------->

    <?php
    if (
        isset($_POST["datepicker"])
        && isset($_POST["inputUtil"])
    ) {
        $var0 = $_POST["datepicker"];
        $var1 = $_POST["inputUtil"];

        // Requête d'insertion des données
        $sql = "INSERT INTO tc_mep (date_mep, util_emet_mep) VALUES (:var0, :var1)";

        $stmt = $pdo->prepare($sql);

        // Binder les valeurs aux paramètres nommés
        $stmt->bindValue(":var0", $var0);
        $stmt->bindValue(":var1", $var1);

        try {
            if ($stmt->execute()) {
                echo '<div class="alert alert-success d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                    <div>
                      Mise en production effectuée avec succès !
                    </div>
                  </div>';
            } else {
                echo '<div class="alert alert-danger d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                    <div>
                      Une erreur s\'est produite lors de linsertion d\'une mise en production.
                    </div>
                  </div>';
            }
        } catch (PDOException $e) {
            echo "Erreur lors de l'insertion ! " . $e->getMessage();
        }
    }
    ?>

  <!------------------------------------------
  |               MODIFICATION               | 
   ------------------------------------------>    


  <!------------------------------------------
  |              FORMULAIRE MEP              | 
  ------------------------------------------->
    <main>
        <section class="container" id="container">
            <h3><b>Mise en production</b></h3>
            <form class="row g-3" method="post">
                <div class="col-md-6" id="divText">
                    <label for="inputLib" class="form-label">Libellé</label>
                    <input type="text" class="form-control" id="inputLib" disabled <?php
                    $lbl_dmd = $row0['libelle'];
                    ?>
                        value="<?php echo $lbl_dmd; ?>">
                </div>

                <div class="infosColumn">
                    <div class="col-md-4" id="divPar">
                        <label for="inputUtil" class="form-label">Par</label>
                        <select id="inputUtil" name="inputUtil" class="form-select">
                            <?php
                            echo "<option value=''></option>";
                            foreach ($result1 as $row) {                                              
                                $id_util = $row['IdUtil'];
                                $nom = $row['nom'];
                                echo "<option value=$id_util>$nom</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-md-6" id="divDate">
                        <label for="inputDate" class="form-label">Date de mise en production</label>
                        <input type="text" class="form-control" id="datepicker" name="datepicker"
                            pattern="\d{1,2}/\d{1,2}/\d{4}" placeholder="jj/mm/aaaa">
                    </div>

                    <div class="col-md-6" id="divNumber">
                        <label for="inputNumber" class="form-label">Procédure de mise en production</label>
                        <input type="number" class="form-control" id="inputNumber" disabled <?php
                        $id_Demande = $row2['IdDemande'];
                        ?> value="<?php echo $id_Demande; ?>">
                    </div>
                </div>

                <div class="btnajout">
                    <button type="submit" name="btnajout">Valider</button>
                    <button type="reset">Annuler</button>

                    <?php
                    if (isset($_POST['btnajout'])) {
                        // Le bouton "btnajouter" a été cliqué.
                        $date_mep = isset($_POST['datepicker']) ? $_POST['datepicker'] : '';
                        $util_mep = isset($_POST['inputUtil']) ? $_POST['inputUtil'] : '';

                        $date_mep_bon_format = substr($date_mep, 6, 4) . substr($date_mep, 3, 2) . substr($date_mep, 0, 2);
                        $sql = "INSERT INTO tc_mep (date_mep, util_emet_mep) VALUES (?, ?)";

                        $stmt = $pdo->prepare($sql);
                        $stmt->execute([$date_mep_bon_format, $util_mep]);

                        $id = $pdo->lastInsertId(); //Récupère l'id avec lequel je vais mettre à jour la table tc_demandes
                        echo $id;

                        $sql4 = "UPDATE tc_demandes SET IdMep = "   . $id . " WHERE IdDemande = " . $id_Demande;
                        $stmt4 = $pdo->prepare($sql4);
                        $result4 = $stmt4->execute();

                    }

                    $sql3 = "SELECT IdMep FROM tc_demandes WHERE IdDemande =" . $id_Demande;
                    $stmt3 = $pdo->query($sql3);
                    $row3 = $stmt3->fetch(PDO::FETCH_ASSOC);
                    $IdMep = $row3['IdMep'];


                    if ($IdMep > 0) { // Il y a un bien une mep qui a été saisie
                        echo "Afficher le bouton modifier";
                    } else  {
                        echo "Afficher le bouton Valider";
                    }

                    ?>

<!-- 
<?php if (!$motDePasseModifie) { ?>
                    <button type="submit" class="tma-btn" name="subpasswd">Enregistrer</button>
                <?php } else { ?>
                    <a href="./index.php"><input type="button" class="tma-btn" value="⬅️ Revenir au menu"></a>
                <?php } ?> -->
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