<?php
include("includes/connexion.inc.php");

if (isset($_POST['subpasswd'])) {
    $matricule = $_POST['matricule'];
    $n_passwd = $_POST['n_passwd'];   
    $c_passwd = $_POST['c_passwd'];

    if (empty($matricule) || empty($n_passwd) || empty($c_passwd)) {
        // echo "Veuillez remplir tous les champs.";

    } elseif ($n_passwd !== $c_passwd) {
        // echo "Les nouveaux mots de passe ne correspondent pas.";

    } else {
        try {
            
            $selectQuery = "SELECT passwd FROM tc_utilisateur WHERE matricule = :matricule";
            $selectStmt = $pdo->prepare($selectQuery);
            $selectStmt->execute(['matricule' => $matricule]);
            $row = $selectStmt->fetch();

            if (!empty($row) && $n_passwd == $row['passwd']) {
                // Le mot de passe correspond, vous pouvez procéder à l'authentification de l'utilisateur
                $hashedPassword = password_hash($n_passwd, PASSWORD_DEFAULT);

                $updateQuery = "UPDATE tc_utilisateur SET passwd = :n_passwd WHERE matricule = :matricule";
                $updateStmt = $pdo->prepare($updateQuery);
                $updateStmt->execute([
                    'n_passwd' => $hashedPassword,
                    // Utilisez directement le nouveau mot de passe
                    'matricule' => $matricule
                ]);

                
            } else {
                // echo "L'ancien mot de passe est incorrect.";
            }
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }
}
