<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/ClientSide/html.html to edit this template
-->
<html>

<head>
    <title>TMA - Affichage des demandes</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="../css/csshome.css" rel="stylesheet" type="text/css" />
    <link rel="icon" href="../img/NLogo2.png" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://unpkg.com/file-saver/dist/FileSaver.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link href="../css/AffichageDemande.css" rel="stylesheet">
</head>

<body>
    <?php include('../includes/connexion.inc.php') ?>
    <?php include('../includes/header.html.inc.php') ?>

    <?php
    // Vérifiez si l'ID de la demande a été soumis
    if (isset($_POST['IdDdemande'])) {
        $id_demande = $_POST['IdDdemande'];

        try {
            // Connexion à la base de données avec PDO
            $pdo = new PDO('mysql:host=localhost:3308;dbname=tmaconnect', 'root', 'XVsikn92');

            // Définir le mode d'erreur de PDO sur Exception
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Préparez la requête pour éviter les injections SQL
            $requete = $pdo->prepare("SELECT dom_dmd, qual_dmd, prt_dmd, libelle, date_crea, util_crea, date_emet, util_emet, date_recu, util_benef, date_etat_dmd, etat_dmd, date_visa_dmd, util_sign_dmd, util_affect_dmd, date_fs, amorti_dmd, date_rct_prvu, regroupement, date_archiv FROM tc_demandes WHERE IdDdemande = :IdDdemande");
            $requete->bindParam(':IdDdemande', $id_demande, PDO::PARAM_INT);

            // Exécutez la requête
            $requete->execute();

            // Récupérez les données de la demande
            $demande = $requete->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur : Problème de connexion " . $e->getMessage();
        }

        // Fermez la connexion
        $pdo = null;
    }
    ?>

   <!-- PAGINATION TABLEAU DEMANDE -->

    <nav class="div--pagination" aria-label="..."> 
        <ul class="pagination">
            <li class="page-item disabled">
                <a class="page-link">Previous</a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item active" aria-current="page">
                <a class="page-link" href="#">2</a>
            </li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link" href="#">Next</a>
            </li>
        </ul>
    </nav>

    
    <div id="alertContainer"></div>

    <!-- <script src="../js/Filtre-dmd.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>