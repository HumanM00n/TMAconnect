<?php
// informations de connexion à la base de données MySQL
$servername = "localhost:3308"; // nom du serveur
$username = "root"; // nom d'utilisateur
$password = "XVsikn92"; // mot de passe
$dbname = "tmaconnect"; // nom de la base de données

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupérer les données du formulaire 
    // $select_domaine = filter_input(INPUT_POST, 'select_domaine', FILTER_SANITIZE_STRING);
    // $select_etat = filter_input(INPUT_POST, 'select_etat', FILTER_SANITIZE_STRING);
    

    $select_domaine = isset($_POST['select_domaine']) ? $_POST['select_domaine'] : '';
    $select_etat = isset($_POST['select_etat']) ? $_POST['select_etat'] : '';
    $num_dmd = isset($_POST['num-dmd']) ? $_POST['num-dmd'] : '';

    echo $_POST['select_domaine'];
    echo $_POST['select_etat'];

    // echo $select_domaine;
    // echo $select_etat;
    // echo $num_dmd;


    // Construire la requête SQL en fonction des valeurs du formulaire
    $sql = "SELECT D.IdDemande, DOM.libelle, D.libelle, Q.libelle, D.date_crea, E.libelle 
            FROM tc_demandes D, tc_domaine DOM, tc_qualif Q, tc_etat E
            WHERE D.dom_dmd = DOM.IdDomaine 
            AND D.qual_dmd = Q.IdQual
            AND D.etat_dmd = E.IdEtat";
// début

if ($select_domaine != '' && $select_etat != '' && $num_dmd != '') {
    $sql .= " AND DOM.libelle = '$select_domaine' AND E.libelle = '$select_etat' AND D.IdDemande = $num_dmd";
} else {
    if ($select_domaine != '' && $select_etat != '') {
        $sql .= " AND DOM.libelle = '$select_domaine' AND E.libelle = '$select_etat' ";
    } else {
        if ($select_domaine != '' && $num_dmd != '') {
            $sql .= " AND DOM.libelle = '$select_domaine' AND D.IdDemande = $num_dmd";
        } else {
            if ($select_etat != '' && $num_dmd != '') {
                $sql .= " AND E.libelle = '$select_etat' AND D.IdDemande = $num_dmd";
            } else {
                if ($select_domaine != '') {
                    $sql .= " AND DOM.libelle = '$select_domaine'";
                } else {
                    if ($select_etat != '') {
                        $sql .= " AND E.libelle = '$select_etat' ";
                    } else {
                        if ($num_dmd != '') {
                            $sql .= " AND D.IdDemande = $num_dmd";
                        }
                    }
                }
            }
        }
    }
}
?>

<!-- [0] -->

<?php
    $stmt = $pdo->query($sql);

    // Vérification des résultats
    if ($stmt->rowCount() > 0) {
        $count = $stmt->rowCount();
        $html = '<table class="table" id="table"><thead><tr><th>🔎</th><th>N°demande</th><th>Domaine</th><th>Libellé</th><th>Type</th><th>Demande créée</th><th>Charge</th><th>Etat</th><th>Date MEP</th><th>Télécharger</th></tr></thead><tbody>';

        while ($row = $stmt->fetch(PDO::FETCH_BOTH)) {
            $html .= '<tr class="afficherDetails">';
            $html .= '<td><button><a href="detailDemande.php?idDemande=' . $row[0] . '">🔎</a></button></td>';
            $html .= '<td>' . $row[0] . '</td>';
            $html .= '<td>' . $row[1] . '</td>';
            $html .= '<td>' . $row[2] . '</td>';
            $html .= '<td>' . $row[3] . '</td>';
            $html .= '<td>' . $row[4] . '</td>';
            $html .= '<td>2</td>';
            $html .= '<td>' . $row[5] . '</td>';
            $html .= '<td>30-09-2023</td>';
            $html .= '<td><i class="bx bx-download"></i></td>';
            $html .= '</tr>';
        }

        $html .= '</tbody></table>';
        echo $html;
    } else {
        echo "Aucune demande trouvée";
    }
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}
?>