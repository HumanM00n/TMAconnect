<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="css/csshome.css">
    <link rel="stylesheet" href="css/test.css">
    <link rel="icon" href="img/NLogo2.png" />
    <title>TestMEP</title>
</head>

<?php include('includes/connexion.inc.php') ?>

<body>
    <?php
    
    $id_Demande = 8;
    
    // Requête pour récupérer le libellé de la demande
    $sql0 = "SELECT libelle FROM tc_demandes WHERE IdDemande =" . $id_Demande;
    $stmt0 = $pdo->query($sql0);
    $row0 = $stmt0->fetch(PDO::FETCH_ASSOC);

    // Requête pour récupérer les noms qui ont pour service TMA
    $sql1 = "SELECT nom FROM tc_utilisateur WHERE S_users = 1 AND 7"; 
    $stmt1 = $pdo->query($sql1);
    $result1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);

    // Requête pour récupérer le numéro de la demande
    $sql2 = "SELECT IdDemande FROM tc_demandes WHERE IdDemande =" . $id_Demande;
    $stmt2 = $pdo->query($sql2);
    $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
    ?>

    <?php
    if (
        isset($_POST["datepicker"])
        && isset($_POST["inputUtil"])
    ) {
        $var0 = $_POST["datepicker"];
        $var1 = $_POST["inputUtil"];

        // Requête d'insertion des données
        $sql = "INSERT INTO tc_mep (date_mep, util_date_mep) VALUES (:var0, :var1)";

        $stmt = $pdo->prepare($sql);

        // Binder les valeurs aux paramètres nommés
        $stmt->bindValue(":var0", $var0);
        $stmt->bindValue(":var1", $var1);

        try {
            if ($stmt->execute()) {
                echo '<center><p class="Successful">Données insérées avec succès!</p></center>';
            } else {
                echo "Erreur lors de l'insertion des données.";
            }
        } catch (PDOException $e) {
            echo "Erreur de connexion à la base de données : " . $e->getMessage();
        }
    }
    ?>

    <main>
        <section class="container" id="container">
            <h3><b>Mise en production</b></h3>
            <form class="row g-3" method="post ">
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
                        <select id="inputUtil" class="form-select">
                            <?php
                            echo "<option value=''></option>";
                            foreach ($result1 as $row) {
                                $id_util = $row['IdUtil'];
                                $nom = $row['nom'];
                                echo "<option value='$id_util'>$nom</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-md-6" id="divDate">
                        <label for="inputDate" class="form-label">Date de mise en production</label>
                        <input type="text" class="form-control" id="datepicker" pattern="\d{1,2}/\d{1,2}/\d{4}"
                            placeholder="jj/mm/aaaa">
                    </div>

                    <div class="col-md-6" id="divNumber">
                        <label for="inputNumber" class="form-label">Procédure de mise en production</label>
                        <input type="number" class="form-control" id="inputNumber">
                    </div>
                </div>
                <div class="btnajout">
                    <button type="submit">Valider</button>
                    <button type="reset">Annuler</button>
                </div>
            </form>
        </section>
    </main>

    <!-- Lien vers Boostrap.js  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

    <!-- Lien vers jQuery et jQuery UI -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="js/date.js"></script>


</body>

</html>