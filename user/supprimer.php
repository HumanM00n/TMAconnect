<?php

// Vérifier si l'ID de l'utilisateur à supprimer est passé en tant que paramètre
if (isset($_GET['id'])) {
    // Récupérer l'ID de l'utilisateur à supprimer
    $idUtilisateur = $_GET['id'];

    try {
        // Effectuer la connexion à la base de données avec PDO
        $pdo = new PDO("mysql:host=localhost:3308;dbname=tmaconnect", "root", "XVsikn92");

        // Définir le mode d'erreur de PDO sur Exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Préparer la requête de suppression avec un paramètre nommé :idUtilisateur
        $sql = "DELETE FROM tc_utilisateur WHERE IdUtil = :idUtilisateur";

        // Préparer la requête avec PDO
        $stmt = $pdo->prepare($sql);

        // Binder la valeur de :idUtilisateur au paramètre $idUtilisateur
        $stmt->bindValue(':idUtilisateur', $idUtilisateur, PDO::PARAM_INT);

        // Exécuter la requête de suppression
        $stmt->execute();

        // Vérifier si des enregistrements ont été affectés (supprimés)
        if ($stmt->rowCount() > 0) {
            echo "L'utilisateur a été supprimé avec succes !";
        } else {
            echo "Aucun enregistrement trouvé avec cet ID.";
        }
    } catch (PDOException $e) {
        echo "Erreur lors de la suppression de l'enregistrement : " . $e->getMessage();
    } finally {
        // Fermer la connexion à la base de données
        $pdo = null;
    }
} else {
    echo "ID de l'utilisateur manquant.";
}