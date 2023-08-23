<?php
// Connexion à la base de données (vous devez déjà avoir cette partie de votre code)
$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

if (isset($_POST['btnajout'])) {
    // Récupérer les données du formulaire
    $demLibelle = $_POST['demLibelle'];
    $demCree = $_POST['demCree'];
    // ... récupérez les autres données du formulaire

    // Insérer les données dans la base de données
    $sqlInsert = "INSERT INTO table_demandes (libelle, date_creation, ...) VALUES (?, ?, ...)";
    $stmtInsert = $pdo->prepare($sqlInsert);
    $stmtInsert->execute([$demLibelle, $demCree, ...]);

    // Rediriger ou afficher un message de succès
    header("Location: page_succes.php"); // Redirection vers une page de succès
    exit();
}
?>

<?php
if (isset($_POST["demLibelle"]) 
&& isset($_POST["demCree"]) 
&& isset($_POST["selectDemandePar"]) 
&& isset($_POST["demEmise"])  
&& isset($_POST["selectDemandeEmisePar"]) 
&& isset($_POST["demRecu"]) 
&& isset($_POST["selectBeneficiaire"])
&& isset($_POST["demEtat"])
&& isset($_POST["selectDemandeEtat"]) 
&& isset($_POST["visaServEtude"]) 
&& isset($_POST["selectSignataire"]) 
&& isset($_POST["selectAffectation"]) 
&& isset($_POST["demFs"]) 
&& isset($_POST["demMep"]) 
&& isset($_POST["selectRegroupement"]) 
&& isset($_POST["demAmortis"]) 
&& isset($_POST["demArchiv"])) {
  $st = $bdd->prepare("
  INSERT INTO tc_demandes VALUES ('', 0 , 0 , 0 ,
                                 :$_POST'[demLibelle]', 
                                 :$_POST'[demCree]',
                                 :$_POST'[selectDemandePar]',
                                 :$_POST'[demEmise]',
                                 :$_POST'[selectDemandeEmisePar]',
                                 :$_POST'[demRecu]',
                                 :$_POST'[selectBeneficiaire]',
                                 :$_POST'[demEtat]',
                                 :$_POST'[selectDemandeEtat]',
                                 :$_POST'[visaServEtude]',
                                 :$_POST'[selectSignataire]',
                                 :$_POST'[selectAffectation]',
                                 :$_POST'[demFs]',
                                 :$_POST'[demMep]',
                                 :$_POST'[selectRegroupement]',
                                 :$_POST'[demAmortis]',
                                 :$_POST'[demArchiv]',
                                )");
   
}
$stmt = $pdo->prepare($sql);
if ($stmt->execute()) {
    echo "Données insérées avec succès.";
} else {
    echo "Erreur lors de l'insertion des données.";
}
?>

<!-- $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING); -->