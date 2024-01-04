<!----------------------------------------------------------------------------------------- FILTRES RECHERCHE DEMANDE ------------------------------------------------------------------------------------------------------->
<section id="modif">
    <form class="formmodif" name="formmodif" action="" method="POST">
        <fieldset id="infos">
            <legend>Filtres</legend>
            <div>
                <label for="accesDemande">Accès Direct à la Demande</label>
                <input type="text" size="35">
            </div>
            <!-- Nouveaux champs de texte -->
            <div>
                <label for="">Contenant du texte</label>
                <input type="text" size="35">
            </div>

            <!-- Nouvelles listes déroulantes -->
            <div>
                <label for="select_departement">Domaine</label>
                <select>
                    <option value=""></option>
                    <option value=""></option>
                    <option value=""></option>
                    <!-- Ajoutez d'autres options selon vos besoins -->
                </select>
            </div>
            <div>
                <label for="select_poste">Demandes du groupe</label>
                <select name="select_poste" id="select_poste">
                    <option value=""></option>
                    <option value=""></option>
                    <option value=""></option>
                    <!-- Ajoutez d'autres options selon vos besoins -->
                </select>
            </div>
        </fieldset>
    </form>
</section>
<!----------------------------------------------------------------------------------------- BOUTON SOUMETTRE ------------------------------------------------------------------------------------------------------->
<section id="modif">
    <form class="formmodif" name="formmodif" action="" method="POST">
        <!-- Votre formulaire -->
        <button type="submit" class="btn btn-primary">Soumettre</button>
    </form>
</section>
<!----------------------------------------------------------------------------------------- PAGINATION BOOTSTRAP ------------------------------------------------------------------------------------------------------->
<nav aria-label="..." style="display: flex; justify-content: center; align-items: flex-end;">
    <ul class="pagination">
        <li class="page-item disabled">
            <a class="page-link">Previous</a>
        </li>
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item active" aria-current="page">
            <a class="page-link" href="#">2</a>
        </li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item">
            <a class="page-link" href="#">Next</a>
        </li>
    </ul>
</nav>
<!----------------------------------------------------------------------------------------- AFFICHAGE NBRE DMD ------------------------------------------------------------------------------------------------------->

<!-- Affichage du nombre de demandes en titre de tableau -->
<?php
        // Cr�ation du tableau HTML
        echo "<table id='idTable' name='idTable'>";
        // Affichage du nombre d'employ�s en titre de tableau
        if ($count <= 1) {
            echo "<div id='tableau'>$count demande enregistré</div>";
        } else {
            echo "<div id='tableau'>$count demandes enregistrés</div>";
        }
        ?>


<!------------------------------------------------------------------------------------ ANCIEN FICHIER MISE EN PRODUCTION ------------------------------------------------------------------------------------------------------->
<?php
// Vérifie si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifie si les champs nécessaires sont définis et non vides
    if (isset($_POST['datepicker']) && !empty($_POST['datepicker']) && isset($_POST['inputUtil']) && !empty($_POST['inputUtil'])) {
        echo "Le formulaire a été soumis avec succès";
    } else {
        echo "Le formulaire n'a pas été soumis correctement";
    }
}

// <!------------------------------------------
//  |             REQUETE SQL = SELECT        | 
//  -------------------------------------------->
// Récupère les informations pour préremplir le formulaire
$id_Demande = $_GET['idDemande'];
$sql0 = "SELECT libelle FROM tc_demandes WHERE IdDemande =" . $id_Demande;
$stmt0 = $pdo->query($sql0);
$row0 = $stmt0->fetch(PDO::FETCH_ASSOC);

$sql1 = "SELECT IdUtil, nom FROM tc_utilisateur WHERE S_users = 1 AND 7";
$stmt1 = $pdo->query($sql1);
$result1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);

$sql2 = "SELECT IdDemande FROM tc_demandes WHERE IdDemande =" . $id_Demande;
$stmt2 = $pdo->query($sql2);
$row2 = $stmt2->fetch(PDO::FETCH_ASSOC);

// Récupère les valeurs soumises précédemment pour préremplir les champs du formulaire
$datepicker_value = isset($_POST['datepicker']) ? $_POST['datepicker'] : '';
$inputUtil_value = isset($_POST['inputUtil']) ? $_POST['inputUtil'] : '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/NLogo2.png" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
        <symbol id="check-circle-fill" viewBox="0 0 16 16">
            <path
                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
        </symbol>
    </svg>
    <link rel="stylesheet" href="css/csshome.css">
    <link rel="stylesheet" href="css/mise-en-prod.css">

    <title>TMA - Mise en production</title>
</head>

<?php include('includes/connexion.inc.php') ?>

<body>

  <!------------------------------------------
  |             BOUTON "RETOUR"              | 
  ------------------------------------------->
  <div class="btnretour">
        <button onClick=" history.back();">Retour</button>
    </div>
    <main>
        <section class="container" id="container">
            <h3><b>Mise en production</b></h3>
            <form class="row g-3" method="post">
            <div class="col-md-6" id="divText">
                    <label for="inputLib" class="form-label">Libellé</label>
                    <input type="text" class="form-control" id="inputLib" disabled <?php
                    $lbl_dmd = $row0['libelle'];
                    ?>
                        value="<?php echo $lbl_dmd; ?>">
                </div>

                <div class="infosColumn">
                    <div class="col-md-4" id="divPar">
                        <label for="inputUtil" class="form-label">Par</label>
                        <select id="inputUtil" name="inputUtil" class="form-select">
                            <option value=''></option>
                            <?php
                            foreach ($result1 as $row) {
                                $id_util = $row['IdUtil'];
                                $nom = $row['nom'];
                                $selected = ($inputUtil_value == $id_util) ? 'selected' : '';
                                echo "<option value='$id_util' $selected>$nom</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-md-6" id="divDate">
                    <label for="inputDate" class="form-label">Date de mise en production</label>
                    <input type="text" class="form-control" id="datepicker" name="datepicker"
                        pattern="\d{1,2}/\d{1,2}/\d{4}" placeholder="jj/mm/aaaa"
                        value="<?php echo $datepicker_value; ?>">
                </div>

                    <!-- ... (existing code) ... -->

                    <div class="btnajout">
                        <?php
                        // Vérifie si des données existent en base de données
                        $sql_check_data = "SELECT * FROM tc_mep WHERE idDemande = ?";
                        $stmt_check_data = $pdo->prepare($sql_check_data);
                        $stmt_check_data->execute([$id_Demande]);

                        if ($stmt_check_data->rowCount() > 0) {
                            // Affiche les données et le bouton "Modifier"
                            $row_data = $stmt_check_data->fetch(PDO::FETCH_ASSOC);
                            echo "Données existantes en base : " . $row_data['date_mep'];

                            echo '<button type="button" onclick="afficherFormulaireModifier()">Modifier</button>';

                            // ... (afficher d'autres champs si nécessaire)
                        } else {
                            // Affiche le bouton "Valider" s'il n'y a pas de données existantes
                            echo '<button type="submit" name="btnajout">Valider</button>';
                        }
                        ?>

                        <button type="reset">Annuler</button>

                        <!-- ... (existing code) ... -->
                    </div>
                </div>
            </form>

            <!-- FORMULAIRE DE MODIFICATION -->
            <form id="formModifier" class="row g-3" method="post" style="display: none;">
                <!-- ... (champs de modification) ... -->

                <div class="btnajout">
                    <button type="submit" name="btn_modifier">Enregistrer</button>
                </div>
            </form>
        </section>
    </main>

    <script>
        function afficherFormulaireModifier() {
            document.getElementById("formModifier").style.display = "block";
        }
    </script>

</body>

</html>