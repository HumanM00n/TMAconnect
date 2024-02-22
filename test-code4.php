<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
  <!-- LINK FEATHER -->
  <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
  <script>
    feather.replace();
  </script>
  <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" />
  <link href="css/test4.css" rel="stylesheet" type="text/css" />
  <link rel="icon" href="img/NLogo2.png" />



  <?php
  $scriptName = filter_input(INPUT_SERVER, 'SCRIPT_NAME');
  $pageActuelle = basename($scriptName); // Récupère le nom de fichier sans le chemin
  $pageActuelle = pathinfo($pageActuelle, PATHINFO_FILENAME); // Récupère le nom de fichier sans l'extension
  
  // echo "<title>TMAconnect - $pageActuelle</title>";
  echo "<title>TC4 - Modifier.php</title>";
  ?>
</head>

<body>
  <header>
    <?php include('includes/header.html.inc.php'); ?>
    <?php include('includes/connexion.inc.php'); ?>
  </header>

  <!------------------------------------------
    |             BOUTON "RETOUR"              | 
    ------------------------------------------->

  <div class="btnretour">
    <button onClick=" history.back();">Retour</button>
  </div>

  <?php
 
  try {
    // Création d'une connexion à la base de données avec PDO
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    // Configuration des attributs de PDO
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    // ********************************** Requête Pour ACTIF **********************************
    if (isset($_POST['btn_modifier'])) {
      if (isset($_POST['checkBoxActif'])) {
        $idUtilisateur = $_GET['id'];

        $sql = "UPDATE tc_utilisateur SET actif = 'OUI' WHERE IdUtil = :idUtilisateur";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':idUtilisateur', $idUtilisateur, PDO::PARAM_INT);
        $result = $stmt->execute();
      } else {
        $idUtilisateur = $_GET['id'];

        $sql = "UPDATE tc_utilisateur SET actif = 'NON' WHERE IdUtil = :idUtilisateur";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':idUtilisateur', $idUtilisateur, PDO::PARAM_INT);
        $result = $stmt->execute();
      }
    }

    // ********************************** Requête Pour CALENDRIER **********************************
    if (isset($_POST['btn_modifier'])) {
      $idUtilisateur = $_GET['id'];
      $nouvelleDate = $_POST['calendrier'];

      $nouvelleDateUpdate = substr($nouvelleDate, 6, 4) . '/' . substr($nouvelleDate, 3, 2) . '/' . substr($nouvelleDate, 0, 2);

      $sql = "UPDATE tc_utilisateur SET dateFin = :nouvelleDateUpdate WHERE IdUtil = :idUtilisateur";
      $stmt = $pdo->prepare($sql);
      $stmt->bindParam(':nouvelleDateUpdate', $nouvelleDateUpdate, PDO::PARAM_STR);
      $stmt->bindParam(':idUtilisateur', $idUtilisateur, PDO::PARAM_INT);
      $result = $stmt->execute();

    }

    // ********************************** Requête Pour EMAIL **********************************
    if (isset($_POST['btn_modifier']) && !empty($_POST['inputEmail'])) {
      $idUtilisateur = $_GET['id'];
      $nouvelEmail = $_POST['inputEmail'];

      $sql = "UPDATE tc_utilisateur SET email = :nouvelEmail WHERE IdUtil = :idUtilisateur";
      $stmt = $pdo->prepare($sql);
      $stmt->bindParam(':nouvelEmail', $nouvelEmail, PDO::PARAM_STR);
      $stmt->bindParam(':idUtilisateur', $idUtilisateur, PDO::PARAM_INT);
      $result = $stmt->execute();
    }

    // ********************************** Requête Pour MOT DE PASSE **********************************
    if (isset($_POST['btn_modifier']) && !empty($_POST['inputPasswd']) && !empty($_POST['inputConfirm'])) {
      $idUtilisateur = $_GET['id'];
      $nouveauPasswd = $_POST['inputPasswd'];
      $nouveauConfirm = $_POST['inputConfirm'];

      if ($nouveauPasswd !== $nouveauConfirm) {
        echo "Les mots de passe ne correspondent pas.";
      } else {

        // Hasher le mot de passe avant de le stocker dans la base de données
        $motDePasseHache = password_hash($nouveauPasswd, PASSWORD_DEFAULT);

        // Mettre à jour le mot de passe dans la base de données pour l'utilisateur spécifié
        $sql = "UPDATE tc_utilisateur SET passwd = :nouveauPasswd WHERE IdUtil = :idUtilisateur";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nouveauPasswd', $motDePasseHache, PDO::PARAM_STR);
        $stmt->bindParam(':idUtilisateur', $idUtilisateur, PDO::PARAM_INT);
        $result = $stmt->execute();

        if ($result) {
          // echo "Le mot de passe a été modifier";
        } else {
          // echo "Le mot de passe n'a pas été modifier";
        }
      }
    }

    // ********************************** Requête Pour SERVICE **********************************
    if (isset($_POST['btn_modifier'])) {
      $idUtilisateur = $_GET['id'];
      $nouveauServ = $_POST['S_users'];

      $sql = "UPDATE tc_utilisateur SET S_users = :nouveauServ WHERE IdUtil = :idUtilisateur";
      $stmt = $pdo->prepare($sql);
      $stmt->bindParam(':nouveauServ', $nouveauServ, PDO::PARAM_INT);
      $stmt->bindParam(':idUtilisateur', $idUtilisateur, PDO::PARAM_INT);
      $result = $stmt->execute();
    }

    // ********************************** Requête Pour POSTE **********************************
    if (isset($_POST['btn_modifier'])) {
      $idUtilisateur = $_GET['id'];
      $nouveauPoste = $_POST['P_users'];

      $sql = "UPDATE tc_utilisateur SET P_users = :nouveauPoste WHERE IdUtil = :idUtilisateur";
      $stmt = $pdo->prepare($sql);
      $stmt->bindParam(':nouveauPoste', $nouveauPoste, PDO::PARAM_INT);
      $stmt->bindParam(':idUtilisateur', $idUtilisateur, PDO::PARAM_INT);
      $result = $stmt->execute();
    }

    // ********************************** Requête Pour DROIT **********************************
    if (isset($_POST['btn_modifier'])) {
      $idUtilisateur = $_GET['id'];
      $nouveauDroit = $_POST['D_users'];

      $sql = "UPDATE tc_utilisateur SET D_users = :nouveauDroit WHERE IdUtil = :idUtilisateur";
      $stmt = $pdo->prepare($sql);
      $stmt->bindParam(':nouveauDroit', $nouveauDroit, PDO::PARAM_INT);
      $stmt->bindParam(':idUtilisateur', $idUtilisateur, PDO::PARAM_INT);
      $result = $stmt->execute();
    }


    // Récupération des informations de l'utilisateur à afficher dans les champs de saisie
    $idUtilisateur = $_GET['id'];
    $sql = "SELECT U.nom, U.prenom, U.matricule, U.email, S.IdService, P.IdPoste, D.IdDroit, U.dateFin, U.actif
            FROM tc_utilisateur U
            INNER JOIN tc_service S ON U.S_users = S.IdService
            INNER JOIN tc_poste P ON U.P_users = P.IdPoste
            INNER JOIN tc_droit D ON U.D_users = D.IdDroit
            WHERE U.IdUtil = :idUtilisateur";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':idUtilisateur', $idUtilisateur, PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      $nom = $row['nom'];
      $prenom = $row['prenom'];
      $matricule = $row['matricule'];
      $email = $row['email'];
      $service = $row['IdService'];
      $poste = $row['IdPoste'];
      $droit = $row['IdDroit'];
      $dateFin = $row['dateFin'];
      $actif = $row['actif'];
    }

    if (isset($_POST['btn_modifier'])) {
      $idUtilisateur = $_GET['id'];
      $nouveauDroit = $_POST['D_users'];

      $sql = "UPDATE tc_utilisateur SET D_users = :nouveauDroit WHERE IdUtil = :idUtilisateur";
      $stmt = $pdo->prepare($sql);
      $stmt->bindParam(':nouveauDroit', $nouveauDroit, PDO::PARAM_INT);
      $stmt->bindParam(':idUtilisateur', $idUtilisateur, PDO::PARAM_INT);
      $result = $stmt->execute();
    }

    ?>
  <section id="modif">
    <form class="formmodif" name="formmodif" action="" method="POST">
      <fieldset id="infos">
        <legend>Modifier un utilisateur</legend>

        <div class="form-check">
          <div class="checkActif">
            <label class="form-check-label" for="checkBoxActif">Actif</label>
            <input class="form-check-input" type="checkbox" name="checkBoxActif" id="checkBoxActif" <?php if ($actif == "OUI") {
              echo 'checked';
            } ?>>
          </div>

          <!-------------------
                        |    DATE DE FIN    | 
                        -------------------->

            <div class="dateFin">
              <label for="dateDeFin">Date de fin : </label>
              <input type="text" name="calendrier" id="calendrier" placeholder="Nouvelle date"
                pattern="\d{1,2}/\d{1,2}/\d{4}" value="<?php
                $dateFin_bon_format = substr($dateFin, 8, 2) . '/' . substr($dateFin, 5, 2) . '/' . substr($dateFin, 0, 4);
                echo $dateFin_bon_format; ?>">
            </div>
          </div>

          <!-------------------
                        |        NOM        | 
                        -------------------->

          <div class="infosRow">
            <label for="i_nom">Nom :</label>
            <input type="text" class="form-control" name="i_nom" id="i_nom" size="35" disabled
              oninput="convertToUppercase(this)" value="<?php echo $nom; ?>">

            <!-------------------
                        |       PRENOM      | 
                        -------------------->

            <label for="i_prenom">Prénom :</label>
            <input type="text" class="form-control" name="i_prenom" id="i_prenom" size="35" pattern="^[a-zA-Zݟƌ\s\-]+$"
              required disabled oninput="convertToUppercase(this)" value="<?php echo $prenom; ?>">

            <!-------------------
                        |     MATRICULE     | 
                        -------------------->

            <label for="i_matricule">Matricule :</label>
            <input type="text" class="form-control" name="i_matricule" id="i_matricule" pattern="C.*" required
              maxlength="5" disabled oninput="convertToUppercase(this)" value="<?php echo $matricule; ?>">
          </div>

          <div class="infoRow2">
            <div class="row g-3 align-items-center">
              <div class="col-auto">
                <label for="i_email" class="col-form-label">Email :</label>
                <input type="email" id="inputEmail" name="inputEmail" class="form-control" value="<?php echo $email; ?>">
              </div>

              <!-------------------
                        |    MOT DE PASSE   | 
                        -------------------->

              <div class="col-auto">
                <label for="i_passwd" class="col-form-label">Mot de passe :</label>
                <input type="password" id="inputPasswd" name="inputPasswd" class="form-control">
                <!-- ICON -->
                <i id="eye" data-feather="eye"
                  onclick="togglePasswordVisibility('inputPasswd', 'eye', 'eye-off', true)"></i>
                <i id="eye-off" data-feather="eye-off" style="display: none;"
                  onclick="togglePasswordVisibility('inputPasswd', 'eye', 'eye-off', false)"></i>
              </div>

              <!-----------------------------
                        |  CONFIRMATION MOT DE PASSE  |  
                        ------------------------------>

              <div class="col-auto">
                <label for="i_confirm" class="col-form-label" id="labelConfirm">Confirmation mot de
                  passe:</label>
                <input type="password" id="inputConfirm" name="inputConfirm" class="form-control">
                <!-- ICON -->
                <i id="eye2" data-feather="eye"
                  onclick="togglePasswordVisibility('inputConfirm', 'eye2', 'eye-off2', true)"></i>
                <i id="eye-off2" data-feather="eye-off" style="display: none;"
                  onclick="togglePasswordVisibility('inputConfirm', 'eye2', 'eye-off2', false)"></i>
              </div>
            </div>
          </div>

          <?php

          $sql0 = "SELECT IdService, s_libelle FROM tc_service";
          $stmt0 = $pdo->query($sql0);
          $result0 = $stmt0->fetchAll(PDO::FETCH_ASSOC);

          $sql1 = "SELECT IdPoste, p_libelle FROM tc_poste";
          $stmt1 = $pdo->query($sql1);
          $result1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);

          $sql2 = "SELECT IdDroit, d_libelle FROM tc_droit";
          $stmt2 = $pdo->query($sql2);
          $result2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
          ?>

          <!-------------------
                        |      SERVICE      | 
                        -------------------->

          <div class="infosRow3">
            <label for="lst_droit" class="labelService">Service :</label>
            <select class="form-select" id="S_users" name="S_users" aria-label="Default select example">
              <?php
              echo "<option value=''></option>";
              foreach ($result0 as $row) {
                $idService = $row['IdService'];
                $libelle1 = $row['s_libelle'];
                $selected = ($idService == $service) ? 'selected' : '';
                echo "<option value='$idService' $selected>$libelle1</option>";
              }
              ?>
            </select>

            <!-------------------
                        |       POSTE       | 
                        -------------------->

            <label for="lst_droit">Poste :</label>
            <select class="form-select" id="P_users" name="P_users" aria-label="Default select example">
              <?php
              echo "<option value=''></option>";
              foreach ($result1 as $row) {
                $idPoste = $row['IdPoste'];
                $libelle2 = $row['p_libelle'];
                $selected = ($idPoste == $poste) ? 'selected' : '';
                echo "<option value='$idPoste' $selected>$libelle2</option>";
              }
              ?>
            </select>

            <!-------------------
                        |        DROIT      | 
                        -------------------->

            <label for="lst_droit" class="labelDroit">Droit :</label>
            <select class="form-select" id="D_users" name="D_users" aria-label="Default select example">
              <?php
              echo "<option value=''></option>";
              foreach ($result2 as $row) {
                $idDroit = $row['IdDroit'];
                $libelle3 = $row['d_libelle'];
                $selected = ($idDroit == $droit) ? 'selected' : '';
                echo "<option value='$idDroit' $selected>$libelle3</option>";
              }
              ?>
            </select>
          </div>

          <!-- BOUTON SUBMIT  -->
          <div class="btnajout">
            <input type="submit" name="btn_modifier" id="btn_modifier" value="Modifier">
            <input type="reset" name="btn_annuler" id="btn_annuler" value="Annuler"
              onclick="window.location.href = 'user/Utilisateurs.php';">
          </div>
        </fieldset>
      </form>
      <?php
      if (isset($_POST['btn_modifier'])) {
        // Le bouton "btnajouter" a été cliqué
        if ($result) {
          ?>
          <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000">
            <div class="toast-header">
              <i class="far fa-check-circle" style="color: #ffffff;"></i>
              <strong class="text-white">&ensp;TMA Connect</strong>
            </div>
            <div class="toast-body">
              Les informations ont été modifiées.
            </div>
          </div>

          <script>
            $(document).ready(function () {
              $('.toast').toast('show');
            });
          </script>

          <?php
        } else {
          ?>

          <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000">
            <div class="toast-header">
              <i class="far fa-times-circle" style="color: #ffffff;"></i>
              <strong class="text-white">&ensp;TMA Connect</strong>
            </div>
            <div class="toast-body">
              Une erreur s'est produite lors de la modification.
            </div>
          </div>

          <script>
            $(document).ready(function () {
              $('.toast').toast('show');
            });
          </script>

          <?php
        }
      }
  } catch (PDOException $e) {
    die("La connexion a échoué: " . $e->getMessage());
  }
  ?>

  </section>


  <script>
    function togglePasswordVisibility(inputId, eyeIconId, eyeOffIconId, showPassword) {
      var passwordInput = document.getElementById(inputId);
      var eyeIcon = document.getElementById(eyeIconId);
      var eyeOffIcon = document.getElementById(eyeOffIconId);

      if (showPassword) {
        passwordInput.type = 'text';
        eyeIcon.style.display = 'none';
        eyeOffIcon.style.display = 'block';
      } else {
        passwordInput.type = 'password';
        eyeIcon.style.display = 'block';
        eyeOffIcon.style.display = 'none';
      }
    }
  </script>


  <script src="https://unpkg.com/feather-icons"></script>

  <!-- LINK JS BOOTSTRAP -->
  <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
  <!-- Script pour initialiser les icônes Feather -->
  <script>
    feather.replace();
  </script>

</body>

</html>