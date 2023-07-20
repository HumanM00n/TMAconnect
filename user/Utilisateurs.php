<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/csshome.css">
    <link rel="icon" href="../img/NLogo2.png" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://unpkg.com/file-saver/dist/FileSaver.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <?php include('../includes/header.html.inc.php'); ?>

</head>

<body>
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

    // Requ�te SELECT pour r�cup�rer tous les utilisateurs
    $sql = "SELECT U.IdUtil, U.nom, U.prenom, U.matricule, U.email, S.s_libelle, P.p_libelle, D.d_libelle, U.dateFin, U.derniere_connect 
        FROM tc_utilisateur U
        INNER JOIN tc_service S ON U.S_users = S.IdService
        INNER JOIN tc_poste P ON U.P_users = P.IdPoste
        INNER JOIN tc_droit D ON U.D_users = D.IdDroit
        ORDER BY IdUtil;";
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
        $sql = "SELECT U.IdUtil, U.nom, U.prenom, U.matricule, U.email, S.s_libelle, P.p_libelle, D.d_libelle, U.dateFin, U.derniere_connect 
            FROM tc_utilisateur U
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

        echo "<tr><th>ID</th><th>Nom</th><th>Prenom</th><th>Matricule</th><th>Email</th><th>Service</th><th>Poste</th><th>Droit</th><th>Date de fin</th><th>Dernière connexion</th><th class='action'>Actions</th></tr>";

        // Boucle � travers tous les utilisateurs et affichage des r�sultats
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr><td>" . $row["IdUtil"] . "</td><td>" . $row["nom"] . "</td><td>" . $row["prenom"] . "</td><td>" . $row["matricule"] . "</td><td>" . $row["email"] . "</td><td>" . $row["s_libelle"] . "</td><td>" . $row["p_libelle"] . "</td>"
                . "<td>" . $row["d_libelle"] . "</td><td>" . $row["dateFin"] . "</td><td>" . $row["derniere_connect"] . "</td>"
                . "<td><button class='iconemodif' onclick='redirectModifierPage(" . $row['IdUtil'] . ")' title='Modifier les informations'><span class='fa fa-pencil-square-o fa-lg'></span></button><button class='iconesuppr' onclick=\"confirmation(" . $row["IdUtil"] . ")\" title='Supprimer employ�'><span class='fa fa-trash fa-lg' aria-hidden='true'></span></button></td></tr>";
        }
        ?>

        <script>
            function redirectModifierPage(idUtilisateur) {
                window.location.href = "../pages/Modifier.php?id=" + idUtilisateur;
            }
        </script>

        <script>
            function confirmation(idUtilisateur) {
                if (confirm("Êtes-vous sûr de vouloir supprimer l'utilisateur?")) {
                    // Si l'utilisateur clique sur "OK", effectuer la suppression en appelant supprimer.php via AJAX
                    var xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function () {
                        // Vérification du traitement avec succès de la requête
                        if (this.readyState == 4 && this.status == 200) {
                            // Créer l'élément d'alerte personnalisée
                            var alertDiv = document.createElement("div");
                            alertDiv.className = "alert alert-success";
                            alertDiv.role = "alert";
                            alertDiv.innerHTML = 'L\'utilisateur a été supprimé avec succès.';

                            // Insérer l'élément d'alerte personnalisée dans le DOM
                            var container = document.getElementById("alertContainer");
                            container.appendChild(alertDiv);
                        }
                    };

                    xhttp.open("GET", "supprimer.php?id=" + idUtilisateur, true);
                    xhttp.send();

                    // Recharger la page pour mettre à jour la liste des utilisateurs
                    setTimeout(function () {
                        location.reload();
                    }, 5000);
                } else {
                    // Si l'utilisateur clique sur "Annuler", ne rien faire
                }
            }
        </script>

        <?php
        // Fermeture du tableau HTML
        echo "</table>";

        // Calculer le nombre total de pages
        $nombreTotalPages = ceil($count / $nombreParPage);

        // Générer les liens de pagination
        echo "<div class='pagination-container'>";

        // Lien vers la page précédente
        if ($page > 1) {
            echo "<a href='?page=" . ($page - 1) . "' class='page-link'>&laquo;</a>";
        }

        // Afficher les numéros de page
        for (
            $i = 1;
            $i <= $nombreTotalPages;
            $i++
        ) {
            echo "<a href='?page=$i' class='page-link'>$i</a>";
        }

        // Lien vers la page suivante
        if ($page < $nombreTotalPages) {
            echo "<a href='?page=" . ($page + 1) . "' class='page-link'>&raquo;</a>";
        }

        // Lien vers la dernière page
        echo "<a href='?page=$nombreTotalPages' class='page-link last-page'>$nombreTotalPages</a>";

        echo "</div>";
    } else {
        echo "0 r�sultats";
    }

    // Fermeture de la connexion à la base de données
    $pdo = null;
    ?>

    <div class="btnexcel">
        <button><span class="fa fa-arrow-circle-down fa-lg" aria-hidden="true"></span> Télécharger au format
            Excel</button>
    </div>

    <script>
        document.querySelector(".btnexcel button").addEventListener("click", function () {
            // Rediriger vers la page telechargement.php
            window.location.href = "../includes/telech.excel.php";
        });
    </script>





    <script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>



    <div class="btnajout">
        <a href="../user/Ajouter.php"><button>Ajouter</button></a>
    </div>

    <div id="alertContainer"></div>
</body>

</html>