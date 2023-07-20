<?php
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


// Connexion à la base de données avec PDO
$dsn = "mysql:host=localhost:3308;dbname=tmaconnect;charset=utf8";
$username = "root";
$password = "XVsikn92";

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
    exit();
}

// Requête SELECT pour récupérer tous les utilisateurs
$sql = "SELECT U.IdUtil, U.nom, U.prenom, U.matricule, U.email, S.s_libelle, P.p_libelle, D.d_libelle, U.dateFin, U.derniere_connect 
        FROM tc_utilisateur U
        INNER JOIN tc_service S ON U.S_users = S.IdService
        INNER JOIN tc_poste P ON U.P_users = P.IdPoste
        INNER JOIN tc_droit D ON U.D_users = D.IdDroit
        ORDER BY IdUtil";
$stmt = $pdo->query($sql);

// Vérification des résultats
if ($stmt->rowCount() > 0) {
    // Création d'un nouveau classeur Excel
    $spreadsheet = new Spreadsheet();

    // Sélection de la feuille active
    $sheet = $spreadsheet->getActiveSheet();

    // En-têtes de colonnes
    $sheet->setCellValue('A1', 'ID');
    $sheet->setCellValue('B1', 'Nom');
    $sheet->setCellValue('C1', 'Prenom');
    $sheet->setCellValue('D1', 'Matricule');
    $sheet->setCellValue('E1', 'Email');
    $sheet->setCellValue('F1', 'Service');
    $sheet->setCellValue('G1', 'Poste');
    $sheet->setCellValue('H1', 'Droit');
    $sheet->setCellValue('I1', 'Date de fin');
    $sheet->setCellValue('J1', 'Dernière connexion');

    // Remplir les données des enregistrements
    $row = 2; // Numéro de la première ligne de données
    while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $sheet->setCellValue('A' . $row, $data['IdUtil']);
        $sheet->setCellValue('B' . $row, $data['nom']);
        $sheet->setCellValue('C' . $row, $data['prenom']);
        $sheet->setCellValue('D' . $row, $data['matricule']);
        $sheet->setCellValue('E' . $row, $data['email']);
        $sheet->setCellValue('F' . $row, $data['s_libelle']);
        $sheet->setCellValue('G' . $row, $data['p_libelle']);
        $sheet->setCellValue('H' . $row, $data['d_libelle']);
        $sheet->setCellValue('I' . $row, $data['dateFin']);
        $sheet->setCellValue('J' . $row, $data['derniere_connect']);
        $row++;
    }

    // Enregistrer le classeur Excel dans un fichier
    $writer = new Xlsx($spreadsheet);
    $filename = 'lst-employes.xlsx';
    $writer->save($filename);

    // Télécharger le fichier Excel
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $filename . '"');
    header('Cache-Control: max-age=0');
    $writer->save('php://output');
    exit;
}

// Fermeture de la connexion à la base de données
$pdo = null;
?>

<script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>
</body>

</html>