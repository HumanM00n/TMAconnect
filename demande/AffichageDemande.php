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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link href="../css/csshome.css" rel="stylesheet" type="text/css" />
    <link rel="icon" href="../img/NLogo2.png" />
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://unpkg.com/file-saver/dist/FileSaver.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> -->
</head>

<body>
    <?php include('../includes/header.html.inc.php') ?>

    <?php
    // informations de connexion à la base de données MySQL
    $servername = "localhost:3308"; // nom du serveur
    $username = "root"; // nom d'utilisateur
    $password = "XVsikn92"; // mot de passe
    $dbname = "tmaconnect"; // nom de la base de données
// création d'une connexion à la base de données
    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Votre code ici...
    } catch (PDOException $e) {
        echo "La connexion a �chou� : " . $e->getMessage();
    }
    // include('../');
    
    // Requ�te SELECT pour r�cup�rer toutes les demandes
    $sql = "SELECT D.IdDemande, D.dom_dmd, D.libelle, D.qual_dmd, D.date_crea, E.charge_eval, ET.libelle , M.date_mep
        FROM tc_demandes D 
        INNER JOIN tc_ldoi L ON L.IdLdoi = D.IdLdoi
        INNER JOIN tc_eval E ON E.IdEval = D.IdEval
        INNER JOIN tc_recette R ON R.IdRecette = D.IdRecette
        INNER JOIN tc_mep M ON M.IdMep = D.IdMep
        INNER JOIN tc_etat ET ON ET.IdEtat = D.etat_dmd
        INNER JOIN tc_domaine DOM ON DOM.IdDomaine = D.dom_dmd
        ORDER BY IdDemande;";

    $result = $pdo->query($sql);

    // Vérification des résultats
    if ($stmt->rowCount() > 0) {
        $count = $stmt->rowCount();

        // Nombre d'enregistrements par page
        $nombreParPage = 8;

        // Récupérer le numéro de page à partir des paramètres de requête GET
        $page = isset($_GET['page']) ? $_GET['page'] : 1;

        // Calculer la position de départ
        $positionDepart = ($page - 1) * $nombreParPage;

        // Modifier la requête SQL avec la clause LIMIT
        $sql = "SELECT D.IdDemande, D.dom_dmd, D.libelle, D.qual_dmd, D.date_crea, E.charge_eval, ET.libelle , M.date_mep
    FROM tc_demandes D 
    INNER JOIN tc_ldoi L ON L.IdLdoi = D.IdLdoi
    INNER JOIN tc_eval E ON E.IdEval = D.IdEval
    INNER JOIN tc_recette R ON R.IdRecette = D.IdRecette
    INNER JOIN tc_mep M ON M.IdMep = D.IdMep
    INNER JOIN tc_etat ET ON ET.IdEtat = D.etat_dmd
    INNER JOIN tc_domaine DOM ON DOM.IdDomaine = D.dom_dmd
    ORDER BY IdDemande
    LIMIT :positionDepart, :nombreParPage;";

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':positionDepart', $positionDepart, PDO::PARAM_INT);
        $stmt->bindValue(':nombreParPage', $nombreParPage, PDO::PARAM_INT);
        $stmt->execute();

        // Création du tableau HTML        
        echo "<table class='table' id='table'>
        <thead class='table-light'>
            <tr>
                <th>🔎</th>
                <th>N°demande</th>
                <th>Domaine</th>
                <th>Libellé</th>
                <th>Demande crée</th>
                <th>Charge</th>
                <th>Etat</th>
                <th>Date MEP</th>
                <th class='action'>Télécharger</th>
            </tr>
        </thead>
        <tbody>";

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>
            <td>" . $row["IdDemande"] . "</td>
            <td>" . $row["dom_dmd"] . "</td>
            <td>" . $row["libelle"] . "</td>
            <td>" . $row["qual_dmd"] . "</td>
            <td>" . $row["date_crea"] . "</td>
            <td>" . $row["charge_eval"] . "</td>
            <td>" . $row["libelle"] . "</td>
            <td>" . $row["date_mep"] . "</td>
            <td><!--<i class='bx bxs-download'></i>--></td>
        </tr>";
        }

        echo "</tbody></table>";

        // Affichage du nombre de demandes en titre de tableau
        if ($count <= 1) {
            echo "<div id='table'>$count demande enregistré</div>";
        } else {
            echo "<div id='table'>$count demandes enregistrés</div>";
        }
    }
?>

    <div id="alertContainer"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>