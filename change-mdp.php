<?php include('php/S-forgotMDP.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/change-mdp.css">
    <link rel="icon" href="../TMAconnect/img/NLogo2.png">
    <title>Changement de mot de passe</title>
</head>
<header>
    <center><img class="logo" src="../TMAconnect/img/NLogo.png"></center>
</header>

<body>
    <div class="container">
        <h2>
            Mot de passe oublié ?
        </h2>
        <?php
        $motDePasseModifie = false; // Variable de drapeau pour indiquer si le mot de passe a été modifié avec succès
        if (isset($_POST['subpasswd'])) {
            if (empty($matricule) || empty($n_passwd) || empty($c_passwd)) {
                echo '<center><p class="error--id">Veuillez remplir tous les champs.</p></center>';
                // exit;
            }

            if ($n_passwd !== $c_passwd) {
                echo '<center><p class="error--id">Les nouveaux mots de passe ne correspondent pas.</p></center>';
                // exit;
            }

            if (isset($error) && $error) {
                echo '<center><p class="error--id">L\'ancien mot de passe est incorrect.</p></center>';
            }
            if (!empty($row)) {
                $hashedPassword = password_hash($n_passwd, PASSWORD_DEFAULT);

                $updateQuery = "UPDATE tc_utilisateur SET passwd = :n_passwd WHERE matricule = :matricule";
                $updateStmt = $pdo->prepare($updateQuery);
                $updateStmt->execute([
                    'n_passwd' => $hashedPassword,
                    'matricule' => $matricule
                ]);

                echo '<center><p class="Successful">Le mot de passe a été modifié avec succès !</p></center>';
                $motDePasseModifie = true; // Variable de drapeau pour indiquer si le mot de passe a été modifié avec succès
            }
        }
        ?>
        <form action="" method="post">
            <div class="lmpd-form">
                <section class="input-container">
                    <p class="input--label">Matricule</p>
                    <input class="input--value" type="text" name="matricule" minlength="5" maxlength="5">
                </section>

                <section class="input-container">
                    <p class="input--label">Nouveau mot de passe</p>
                    <label>
                        <input class="input--value" type="password" name="n_passwd" minlength="" maxlength="">
                        <!-- ICONS -->
                        <div class="password-icon">
                            <i data-feather="eye"></i>
                            <i data-feather="eye-off"></i>
                        </div>
                    </label>
                    <script src="https://unpkg.com/feather-icons"></script>
                    <script src="../TMAconnect/JS/oeil.js"></script>
                </section>

                <section class="input-container">
                    <p class="input--label">Confirmation mot de passe</p>
                    <label>
                        <input class="input--value" type="password" name="c_passwd" minlength="" maxlength="">
                        <!-- ICONS -->
                        <div class="password-icon2">
                            <i data-feather="eye"></i>
                            <i data-feather="eye-off"></i>
                        </div>
                    </label>
                    <script src="https://unpkg.com/feather-icons"></script>
                    <script src="JS/oeil.js"></script>
                    <script src="JS/eye.js"></script>

                </section>
            </div>
            <div>
                <?php if (!$motDePasseModifie) { ?>
                    <button type="submit" class="tma-btn" name="subpasswd">Enregistrer</button>
                <?php } else { ?>
                    <a href="./index.php"><input type="button" class="tma-btn" value="⬅️ Revenir à la page de connexion"></a>
                <?php } ?>
            </div>
        </form>
    </div>
</body>

</html>