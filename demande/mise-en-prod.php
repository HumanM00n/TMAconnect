<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/csshome.css">
    <link rel="stylesheet" href="../css/mise-en-prod.css">
    <link rel="icon" href="../img/NLogo2.png" />
    <title>TMAconnect-ldoi</title>
</head>
<?php include('../includes/connexion.inc.php') ?>
<?php include('../includes/header.html.inc.php') ?>

<body>
    <?php
    //Requête pour récupérer la liste des utilisateurs qui ont pour service TMA et INF
    $sql0 = "SELECT * FROM tc_utilisateur WHERE S_users = 1 AND 7";
    $stmt0 = $pdo->query($sql0);
    $result0 = $stmt0->fetchAll(PDO::FETCH_ASSOC);

    ?>
    <section class="container" id="container">
        <h3><b>Mise en production</b></h3>
        <form class="row g-3">
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Libellé</label>
                <input type="text" class="form-control" id="inputLib">
            </div>
            <div class="col-12">
                <label for="inputAddress" class="form-label">Date de mise en production</label>
                <input type="date" class="form-control" id="inputAddress">
            </div>
            <div class="col-md-4">
                <label for="inputState" class="form-label">Par</label>
                <select id="inputState" class="form-select">
                    <?php
                    echo "<option value=''></option>";
                    foreach ($result0 as $row) {
                        $id_util = $row['IdUtil'];
                        $nom = $row['nom'];
                        echo "<option value='$id_util'>$nom</option>";
                    }
                    ?>
                </select>
            </div>
            <!-- <div class="col-12">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div> -->
        </form>
    </section>

</body>

</html>