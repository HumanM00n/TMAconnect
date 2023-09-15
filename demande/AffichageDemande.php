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
    try {
        $sql = "SELECT D.IdDemande , DOM.libelle , D.libelle , Q.libelle , D.date_crea , E.libelle 
                FROM tc_demandes D, tc_domaine DOM , tc_qualif Q , tc_etat E
                WHERE D.dom_dmd = DOM.IdDomaine 
                AND D.qual_dmd = Q.IdQual
                AND D.etat_dmd = E.IdEtat";

        $stmt = $pdo->query($sql);

        if ($stmt === false) {
            die("Erreur dans la requête SQL");
        }

        // Vérification des résultats
        if ($stmt->rowCount() > 0) {
            $count = $stmt->rowCount();

            // Nombre d'enregistrements par page
            $nombreParPage = 8;

            // Récupérer le numéro de page à partir des paramètres de requête GET
            $page = isset($_GET['page']) ? $_GET['page'] : 1;

            // Calculer la position de départ
            $positionDepart = ($page - 1) * $nombreParPage;

            // $sql = "SELECT IdDemande , dom_dmd , libelle , qual_dmd , date_crea , etat_dmd FROM tc_demandes
            //     LIMIT :positionDepart, :nombreParPage";

            $stmt = $pdo->prepare($sql);
            // $stmt->bindValue(':positionDepart', $positionDepart, PDO::PARAM_INT);
            // $stmt->bindValue(':nombreParPage', $nombreParPage, PDO::PARAM_INT);
            $stmt->execute();
        }
    } catch (PDOException $e) {
        echo "Erreur de connexion à la base de données : " . $e->getMessage();
    }
    ?>

    <?php if ($stmt->rowCount() > 0): ?>
        <table class='table' id='table'>
            <thead>
                <tr>
                    <th>🔎</th>
                    <th>N°demande</th>
                    <th>Domaine</th>
                    <th>Libellé</th>
                    <th>Type</th>
                    <th>Demande créée</th>
                    <th>Charge</th>
                    <th>Etat</th>
                    <th>Date MEP</th>
                    <th>Télécharger</th>
                </tr>
            </thead>
            <tbody>

                <?php while ($row = $stmt->fetch(PDO::FETCH_BOTH)): ?>
                    <tr>
                        <td>🔎</td>
                        <td><?= $row[0] ?></td>
                        <td><?= $row[1] ?></td> 
                        <td><?= $row[2] ?></td> 
                        <td><?= $row[3] ?></td> 
                        <td><?= $row[4] ?></td> 
                        <td>2</td>
                        <td><?= $row[5] ?></td> 
                        <td>30-09-2023</td>
                        <td><i class='bx bx-download'></i></td>
                    </tr>
                <?php endwhile; ?>

            </tbody>
        </table>
        
    <?php else: ?>
        <div>Aucune demande trouvée</div>
    <?php endif; ?>

    <script>
        function redirectModifierPage(idUtilisateur) {
            window.location.href = "../user/AffichageDemande.dm?id=" + idUtilisateur;
        }
    </script>

    <!-- PAGINATION -->

    <!-- <nav aria-label="..." style="display: flex; justify-content: center; align-items: flex-end;"> 
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
    </nav> -->

    
    <div id="alertContainer"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>