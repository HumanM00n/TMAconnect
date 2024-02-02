<svg xmlns="http://www.w3.org/2000/svg" class="d-none">
  <symbol id="exclamation-triangle-fill" viewBox="0 0 16 16">
    <path
      d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
  </symbol>
</svg>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<?php
// informations de connexion à la base de données MySQL
$servername = "localhost:3308"; // nom du serveur
$username = "root"; // nom d'utilisateur
$password = "XVsikn92"; // mot de passe
$dbname = "tmaconnect"; // nom de la base de données

try {
  $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $select_domaine = isset($_POST['select_domaine']) ? $_POST['select_domaine'] : '';
  $select_etat = isset($_POST['select_etat']) ? $_POST['select_etat'] : '';
  $num_dmd = isset($_POST['num_dmd']) ? $_POST['num_dmd'] : '';
  $lib_dmd = isset($_POST['lib_dmd']) ? $_POST['lib_dmd'] : '';
  $lib_dmd = str_replace("'", "''", $lib_dmd);

  // Requête SQL du tableau
  $sql = "SELECT D.IdDemande, DOM.libelle, D.libelle, Q.libelle, D.date_crea, E.libelle, M.date_mep AS date_mep
            FROM tc_demandes D
            JOIN tc_domaine DOM ON D.dom_dmd = DOM.IdDomaine 
            JOIN tc_qualif Q ON D.qual_dmd = Q.IdQual
            JOIN tc_etat E ON D.etat_dmd = E.IdEtat
            JOIN tc_mep M ON D.IdMep = M.IdMep";
  

  if ($select_domaine != '') {
    $sql .= " AND DOM.libelle = '$select_domaine'";
  }

  if ($select_etat != '') {
    $sql .= " AND E.libelle = '$select_etat' ";
  }

  if ($num_dmd != '') {
    $num_dmd = $num_dmd . '%';
    $sql .= " AND CAST(D.IdDemande AS CHAR) LIKE '$num_dmd' ";
  }

  if ($lib_dmd != '') {
    $sql .= " AND D.libelle LIKE '$lib_dmd'";
  }

  $sql .= " ORDER BY D.IdDemande DESC LIMIT 20";

  $stmt = $pdo->query($sql);

  // Vérification des résultats
  if ($stmt->rowCount() > 0) {
    $count = $stmt->rowCount();
    $html = '<table class="table" id="table"><thead><tr><th class="icone-loupe">🔎</th><th>N°demande</th><th>Domaine</th><th>Libellé</th><th>Type</th><th>Demande créée</th><th>Charge</th><th>Etat</th><th>Date MEP</th><th>Télécharger</th></tr></thead><tbody>';

    while ($row = $stmt->fetch(PDO::FETCH_BOTH)) {
      $html .= '<tr class="afficherDetails">';
      $html .= '<td><button><a href="detailDemande.php?idDemande=' . $row[0] . '">🔎</a></button></td>';
      $html .= '<td>' . $row[0] . '</td>';
      $html .= '<td>' . $row[1] . '</td>';
      $html .= '<td>' . $row[2] . '</td>';
      $html .= '<td>' . $row[3] . '</td>';
      $formattedDate = date("d-m-Y", strtotime($row[4]));
      $html .= '<td>' . $formattedDate . '</td>';
      $html .= '<td>2</td>'; // Quand l'eval sera faite, changer et appliquer sur cette ligne le row6 et mettre la date_mep $row7
      $html .= '<td>' . $row[5] . '</td>';

      // Vérifier si la colonne de tc_mep existe dans le tableau $row
      if (isset($row['date_mep']) || isset($row[6])) {
        // Formater la date au format dd-mm-yyyy
        $formattedDate = date("d-m-Y", strtotime($row[6]));
        $html .= '<td>' . $formattedDate . '</td>';
      } else {
        $html .= '<td>Indice 6 non défini</td>';
      }

      $html .= '<td><i class="bx bx-download"></i></td>';
      $html .= '</tr>';
    }

    $html .= '</tbody></table>';

    echo $html;

  } else {
    echo '<div class="alert alert-danger d-flex align-items-center" role="alert">
<svg class="bi flex-shrink-0 me-2" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
<div id="libError">
  <p>Aucune demande trouvée</p>
</div>
</div>';
  }
} catch (PDOException $e) {
  echo "Erreur de connexion à la base de données : " . $e->getMessage();
}
?>

