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
        
    // Requ�te SELECT pour r�cup�rer toutes les demandes
    $sql = "SELECT D.IdDemande, D., U.prenom, U.matricule, U.email, S.s_libelle, P.p_libelle, D.d_libelle, U.dateFin, U.derniere_connect 
        FROM tc_utilisateur U
        INNER JOIN tc_service S ON U.S_users = S.IdService
        INNER JOIN tc_poste P ON U.P_users = P.IdPoste
        INNER JOIN tc_droit D ON U.D_users = D.IdDroit
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
        $sql = "SELECT D.IdDemande, D.dom_dmd, D.libelle, D.date_crea, D., S.s_libelle, P.p_libelle, D.d_libelle, U.dateFin, U.derniere_connect 
            FROM tc_demande D
            INNER JOIN tc_service S ON U.S_users = S.IdService
            INNER JOIN tc_poste P ON U.P_users = P.IdPoste
            INNER JOIN tc_droit D ON U.D_users = D.IdDroit
            ORDER BY IdUtil
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
            echo "<tr><td>" . $row["IdDemande"] . "</td><td>" . $row["dom_dmd"] . "</td><td>" . $row["libelle"] . "</td><td>" . $row["date_crea"] . "</td><td>" . $row[""] . "</td><td>" . $row[""] . "</td><td>" . $row[""] . "</td>"
                . "<td>" . $row["etat_dmd"] . "</td><td>" . $row["dateFin"] . "</td><td>" . $row["derniere_connect"] . "</td>"
                . "<td><button class='iconemodif' onclick='redirectModifierPage(" . $row['IdUtil'] . ")' title='Modifier les informations'><span class='fa fa-pencil-square-o fa-lg'></span></button><button class='iconesuppr' onclick=\"confirmation(" . $row["IdUtil"] . ")\" title='Supprimer employ�'><span class='fa fa-trash fa-lg' aria-hidden='true'></span></button></td></tr>";
        }
    }
?>