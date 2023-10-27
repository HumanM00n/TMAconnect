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
    $select_domaine = isset($_GET['select_domaine']) ? $_GET['select_domaine'] : '';
    $select_etat = isset($_GET['select_etat']) ? $_GET['select_etat'] : '';
    $num_dmd = isset($_GET['num-dmd']) ? $_GET['num-dmd'] : '';

    // Construire la requête SQL en fonction des valeurs du formulaire
    $sql = "SELECT D.IdDemande, DOM.libelle, D.libelle, Q.libelle, D.date_crea, E.libelle 
            FROM tc_demandes D, tc_domaine DOM, tc_qualif Q, tc_etat E
            WHERE D.dom_dmd = DOM.IdDomaine 
            AND D.qual_dmd = Q.IdQual
            AND D.etat_dmd = E.IdEtat";

    if ($select_domaine != '') {
        $sql .= " AND DOM.libelle = '$select_domaine'";
    }

    if ($select_etat != '') {
        $sql .= " AND E.libelle = '$select_etat'";
    }

    if ($num_dmd != '') {
        $sql .= " AND D.IdDemande = $num_dmd";
    }

    $stmt = $pdo->query($sql);

    // Vérification des résultats
    if ($stmt->rowCount() > 0) {
        $count = $stmt->rowCount();
        $html = '<table class="table" id="table"><thead><tr><th>🔎</th><th>N°demande</th><th>Domaine</th><th>Libellé</th><th>Type</th><th>Demande créée</th><th>Charge</th><th>Etat</th><th>Date MEP</th><th>Télécharger</th></tr></thead><tbody>';

        while ($row = $stmt->fetch(PDO::FETCH_BOTH)) {
            $html .= '<tr class="afficherDetails">';
            $html .= '<td><button><a href="detailDemande.php?idDemande='.$row[0].'">🔎</a></button></td>';
            $html .= '<td>'.$row[0].'</td>';
            $html .= '<td>'.$row[1].'</td>';
            $html .= '<td>'.$row[2].'</td>';
            $html .= '<td>'.$row[3].'</td>';
            $html .= '<td>'.$row[4].'</td>';
            $html .= '<td>2</td>';
            $html .= '<td>'.$row[5].'</td>';
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
