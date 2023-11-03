<?php
// include('includes/connexion.inc.php');
if(isset($_POST['IdDemande']) && ctype_digit($_POST['IdDemande'])) {

    // Informations de connexion � la base de donn�es MySQL
    $servername = "localhost:3308"; // nom du serveur
    $username = "root"; // nom d'utilisateur
    $password = "XVsikn92"; // mot de passe
    $dbname = "tmaconnect"; // nom de la base de donn�es

    try {
        // Cr�ation d'une connexion � la base de donn�es avec PDO
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

        // Configuration des attributs de PDO
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Votre code ici...
    } catch (PDOException $e) {
        die("La connexion a �chou�: " . $e->getMessage());
    }
    

    try {
        $dbh = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $IdDemande = $_POST['etat_dmd'];

        $stmt = $dbh->prepare("SELECT * FROM tc_demandes WHERE dom_dmd LIKE :etat_dmd");
        $stmt->bindParam(':etat_dmd', $etat_dmd, PDO::PARAM_INT);
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>