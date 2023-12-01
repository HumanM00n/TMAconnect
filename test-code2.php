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
<?php include('includes/header.html.inc.php') ?>

<body>
    <?php
    if (
        isset($_POST["numDemande"])
    ) {
        $IdDemande = $_POST["numDemande"];
    }

    // $sql0 = "SELECT libelle FROM tc_demandes WHERE IdDemande = :IdDemande";
    // $stmt0 = $pdo->query($sql0);
    // $result0 = $stmt0->fetch(PDO::FETCH_ASSOC);
    // echo
    
    $sql2 = "SELECT nom FROM tc_utilisateur WHERE S_users = 1 AND 7";
    $stmt2 = $pdo->query($sql2);
    $result2 = $stmt2->fetch(PDO::FETCH_ASSOC);

    if (isset($_POST['btn-group'])) {
        // Le bouton "btnajouter" a été bloqué
        $libelle = isset($_POST['libelle']) ? $_POST['libelle'] : '';
        $date_mep = isset($_POST['date_mep']) ? $_POST['date_mep'] : '';
        $util_date_mep = isset($_POST['util_date_mep']) ? $_POST['util_date_mep'] : '';


        $sql = "INSERT INTO tc_mep (nom, prenom, matricule, email, passwd, S_users, P_users, D_users, dateFin) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nom, $prenom, $matricule, $email, $passwd, $S_users, $P_users, $D_users, $datefin]);
    }

    ?>

    <main>
        <section class="container" id="container">
            <h3><b>Mise en production</b></h3>
            <form class="row g-3" method="post ">
                <div class="col-md-6" id="divText">
                    <label for="inputLib" class="form-label">Libellé</label>
                    <input type="text" class="form-control" id="inputLib" disabled
                    <?php 
                        $lbl_dmd= $row[0];
                        ?>
                    value="<?php echo $lbl_dmd; ?>">
                </div>

                <div class="infosColumn">
                    <div class="col-md-4" id="divPar">
                        <label for="inputState" class="form-label">Par</label>
                        <select id="inputState" class="form-select">
                            <?php
                            echo "<option value=''></option>";
                            foreach ($result2 as $row) {
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