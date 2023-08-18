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
    <link rel="stylesheet" href="/css/csshome.css">
    <link href="../css/csshome.css" rel="stylesheet" type="text/css" />
    <link rel="icon" href="../img/NLogo2.png" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://unpkg.com/file-saver/dist/FileSaver.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
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

    // V�rification des r�sultats
    if ($result->rowCount() > 0) {
        $count = $result->rowCount();

        // Nombre d'enregistrements par page
        $nombreParPage = 8;

        // R�cup�rer le num�ro de page � partir des param�tres de requ�te GET
        $page = isset($_GET['page']) ? $_GET['page'] : 1;

        // Calculer la position de d�part
        $positionDepart = ($page - 1) * $nombreParPage;

        // Modifier la requ�te SQL avec la clause LIMIT
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

        // Cr�ation du tableau HTML
        echo "<table id='idTable' name='idTable'>";
        // Affichage du nombre d'employ�s en titre de tableau
        if ($count <= 1) {
            echo "<div id='tableau'>$count employé enregistré</div>";
        } else {
            echo "<div id='tableau'>$count employés enregistrés</div>";
        }

        echo "<tr><th>🔎</th><th>N°demande</th><th>Domaine</th><th>Libellé</th><th>Demande crée</th><th>Charge</th><th>Passe><th>RAP</th><th>Etat</th><th>Facturée</th><th>Télécharger</th><th>Date MEP</th><th class='action'>Actions</th></tr>";

        // Boucle � travers tous les utilisateurs et affichage des r�sultats
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr><td>" . $row["IdDemande"] . "</td><td>" . $row["dom_dmd"] . "</td><td>" . $row["D.libelle,"] . "</td><td>" . $row["qual_dmd"] . "</td><td>" . $row["date_crea"] . "</td><td>" . $row["E.charge_eval"] . "</td><td>" . $row["ET.libelle"] . "</td>"
                . "<td>" . $row["M.date_mep"] 
                . "<td><button class='iconemodif' onclick='redirectModifierPage(" . $row['IdDemande'] . ")' title='Modifier les informations'><span class='fa fa-pencil-square-o fa-lg'></span></button><button class='iconesuppr' onclick=\"confirmation(" . $row["IdUtil"] . ")\" title='Supprimer employ�'><span class='fa fa-trash fa-lg' aria-hidden='true'></span></button></td></tr>";
        }
    }
    ?>
</body>

</html>