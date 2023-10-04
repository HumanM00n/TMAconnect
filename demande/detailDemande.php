<!DOCTYPE html>
<html lang="en">

<head>
    <title>TMA - Détail demande</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" href="../img/NLogo2.png" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://unpkg.com/file-saver/dist/FileSaver.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link href="../css/AffichageDemande.css" rel="stylesheet">
    <link href="../css/csshome.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <?php include('../includes/connexion.inc.php') ?>
    <?php include('../includes/header.html.inc.php') ?>

    <?php
    // Vérifiez si l'ID de la demande a été soumis
    if (isset($_POST['IdDdemande'])) {
        $id_demande = $_POST['IdDdemande'];

        try {
            // Connexion à la base de données avec PDO
            $pdo = new PDO('mysql:host=localhost:3308;dbname=tmaconnect', 'root', 'XVsikn92');

            // Définir le mode d'erreur de PDO sur Exception
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Préparez la requête pour éviter les injections SQL
            $requete = $pdo->prepare("SELECT dom_dmd, qual_dmd, prt_dmd, libelle, date_crea, util_crea, date_emet, util_emet, date_recu, util_benef, date_etat_dmd, etat_dmd, date_visa_dmd, util_sign_dmd, util_affect_dmd, date_fs, amorti_dmd, date_rct_prvu, regroupement, date_archiv FROM tc_demandes WHERE IdDdemande = :IdDdemande");
            $requete->bindParam(':IdDdemande', $id_demande, PDO::PARAM_INT);

            // Exécutez la requête
            $requete->execute();

            // Récupérez les données de la demande
            $demande = $requete->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur : Problème de connexion " . $e->getMessage();
        }

        // Fermez la connexion
        $pdo = null;
    }
    ?>
<?php 
// Requ�tes SQL pour r�cup�rer les l'intégralité des données de la table tc_demandes

$sql0 = "SELECT dom_dmd FROM tc_demande WHERE IdDdemande = :IdDdemande";
$stmt0 = $pdo->query($sql0);
$result0 = $stmt0->fetchAll(PDO::FETCH_ASSOC);

$sql1 = "SELECT quald_dmd FROM tc_demande WHERE IdDdemande = :IdDdemande";
$stmt1 = $pdo->query($sql1);
$result1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);

$sql2 = "SELECT prt_dmd FROM tc_demande WHERE IdDdemande = :IdDdemande";
$stmt2 = $pdo->query($sql2);
$result2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);

$sql3 = "SELECT libelle FROM tc_demande WHERE IdDdemande = :IdDdemande";
$stmt3 = $pdo->query($sql3);
$result3 = $stmt3->fetchAll(PDO::FETCH_ASSOC);


$sql4 = "SELECT date_crea FROM tc_demande WHERE IdDdemande = :IdDdemande";
$stmt4 = $pdo->query($sql4);
$result4 = $stmt4->fetchAll(PDO::FETCH_ASSOC);

$sql5 = "SELECT util_crea FROM tc_demande WHERE IdDdemande = :IdDdemande";
$stmt5 = $pdo->query($sql5);
$result5 = $stmt5->fetchAll(PDO::FETCH_ASSOC);

$sql6 = "SELECT date_emet FROM tc_demande WHERE IdDdemande = :IdDdemande";
$stmt6 = $pdo->query($sql6);
$result6 = $stmt6->fetchAll(PDO::FETCH_ASSOC);

$sql7 = "SELECT util_emet FROM tc_demande WHERE IdDdemande = :IdDdemande";
$stmt7 = $pdo->query($sql7);
$result7 = $stmt7->fetchAll(PDO::FETCH_ASSOC);

$sql8 = "SELECT date_recu FROM tc_demande WHERE IdDdemande = :IdDdemande";
$stmt8 = $pdo->query($sql8);
$result8 = $stmt8->fetchAll(PDO::FETCH_ASSOC);


$sql9 = "SELECT util_benef FROM tc_demande WHERE IdDdemande = :IdDdemande";
$stmt9 = $pdo->query($sql9);
$result9 = $stmt9->fetchAll(PDO::FETCH_ASSOC);

$sql10 = "SELECT date_etat_dmd FROM tc_demande WHERE IdDdemande = :IdDdemande";
$stmt10 = $pdo->query($sql10);
$result10 = $stmt10->fetchAll(PDO::FETCH_ASSOC);

$sql11 = "SELECT etat_dmd FROM tc_demande WHERE IdDdemande = :IdDdemande";
$stmt11 = $pdo->query($sql11);
$result11 = $stmt11->fetchAll(PDO::FETCH_ASSOC);

$sql12 = "SELECT date_visa_dmd FROM tc_demande WHERE IdDdemande = :IdDdemande";
$stmt12 = $pdo->query($sql12);
$result12 = $stmt12->fetchAll(PDO::FETCH_ASSOC);

$sql13 = "SELECT util_sign_dmd FROM tc_demande WHERE IdDdemande = :IdDdemande";
$stmt13 = $pdo->query($sql13);
$result13 = $stmt13->fetchAll(PDO::FETCH_ASSOC);

$sql14 = "SELECT util_affect_dmd FROM tc_demande WHERE IdDdemande = :IdDdemande";
$stmt14 = $pdo->query($sql14);
$result14 = $stmt14->fetchAll(PDO::FETCH_ASSOC);

$sql15 = "SELECT date_fs FROM tc_demande WHERE IdDdemande = :IdDdemande";
$stmt15 = $pdo->query($sql15);
$result15 = $stmt15->fetchAll(PDO::FETCH_ASSOC);

$sql16 = "SELECT amorti_dmd FROM tc_demande WHERE IdDdemande = :IdDdemande";
$stmt16 = $pdo->query($sql16);
$result16 = $stmt16->fetchAll(PDO::FETCH_ASSOC);

$sql17 = "SELECT date_rct_prevu FROM tc_demande WHERE IdDdemande = :IdDdemande";
$stmt17 = $pdo->query($sql17);
$result17 = $stmt17->fetchAll(PDO::FETCH_ASSOC);

$sql18 = "SELECT regroupement FROM tc_demande WHERE IdDdemande = :IdDdemande";
$stmt18 = $pdo->query($sql18);
$result18 = $stmt18->fetchAll(PDO::FETCH_ASSOC);

$sql19 = "SELECT date_archiv FROM tc_demande WHERE IdDdemande = :IdDdemande";
$stmt19 = $pdo->query($sql19);
$result19 = $stmt19->fetchAll(PDO::FETCH_ASSOC);
?>



    <section id="menuNouvelDmd">
        <div id="form_nvldemande" name="form_nvldemande">
            <fieldset id="menuDmd">
                <div class="form-row">
                    <div class="form-group">
                        <label for="demCreePar">Domaine :</label>
                        <select name="selectDom" id="selectDom">
                            <?php
                            echo "<option value='' disabled selected hidden></option>";
                            foreach ($result0 as $row) {
                                $id_dom = $row['IdDomaine'];
                                $lib_dom = $row['libelle'];
                                echo "<option value=$id_dom>$lib_dom</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="demCreePar">Qualification :</label>
                        <select name="selectQualif" id="selectQualif">
                            <?php
                            echo "<option value='' disabled selected hidden></option>";
                            foreach ($result1 as $row) {
                                $id_qual = $row['IdQual'];
                                $lib_qual = $row['libelle'];
                                echo "<option value=$id_qual>$lib_qual</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="demCreePar">Priorité :</label>
                        <select name="selectPrio" id="selectPrio">
                            <?php
                            echo "<option value='' disabled selected hidden></option>";
                            foreach ($result2 as $row) {
                                $id_prt = $row['IdPriorite'];
                                $lib_prt = $row['libelle'];
                                echo "<option value=$id_prt>$lib_prt</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="numDemande">N° demande :</label>
                        <input type="text" name="numDemande" id="numDemande" size="35" disabled pattern="[0-9]">
                    </div>

                </div>
            </fieldset>

            <fieldset id="coordo">
                <legend>Créer une demande</legend>

                <div class="libelleDemande">
                    <label for="demLibelle">Libellé demande :</label>
                    <input type="text" name="demLibelle" id="demLibelle" size="35"
                        pattern="^[a-zA-Záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœ�?ÀÂÄÃÅÇÉÈÊË�?ÌÎ�?ÑÓÒÔÖÕÚÙÛÜ�?ŸÆŒ\s\-]+$" required
                        required oninput="convertToUppercase(this)">
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="demCree">Demande créée le :</label>
                        <input type="date" name="demCree" id="demCree" required>
                    </div>
                    <div class="form-group">
                        <label for="demCreePar">Par :</label>
                        <select name="selectDemandePar" id="selectDemandePar">
                            <?php
                            echo "<option value='' disabled selected hidden></option>";
                            foreach ($result3 as $row) {
                                $id_util = $row['IdUtil'];
                                $nom = $row['nom'];
                                echo "<option value=$id_util>$nom</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="demEmise">Demande émise le :</label>
                        <input type="date" name="demEmise" id="demEmise" required>
                    </div>
                    <div class="form-group">
                        <label for="demEmisePar">Par :</label>
                        <select name="selectDemandeEmisePar" id="selectDemandeEmisePar">
                            <?php
                            echo "<option value='' disabled selected hidden></option>";
                            foreach ($result3 as $row) {
                                $id_util = $row['IdUtil'];
                                $nom = $row['nom'];
                                echo "<option value=$id_util>$nom</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="demRecu">Demande reçue le :</label>
                        <input type="date" name="demRecu" id="demRecu" required>
                    </div>
                    <div class="form-group">
                        <label for="beneficiaire">Bénéficiaire :</label>
                        <select name="selectBeneficiaire" id="selectBeneficiaire">
                            <?php
                            echo "<option value='' disabled selected hidden></option>";
                            foreach ($result7 as $row) {
                                $id_benef = $row['IdBenef'];
                                $lbl_benef = $row['lbl_benef'];
                                echo "<option value=$id_benef>$lbl_benef</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="demCree">Etat de la demande :</label>
                        <input type="date" name="demEtat" id="demEtat" required>
                    </div>
                    <div class="form-group">
                        <label for="etat">Etat :</label>
                        <select name="selectDemandeEtat" id="selectDemandeEtat">
                            <?php
                            echo "<option value='' disabled selected hidden></option>";
                            foreach ($result6 as $row) {
                                $id_etat = $row['IdEtat'];
                                $etat = $row['libelle'];
                                echo "<option value=$id_etat>$etat</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="visaServEtude">Visa service étude :</label>
                        <input type="date" name="visaServEtude" id="visaServEtude" required>
                    </div>
                    <div class="form-group">
                        <label for="signataire">Signataire :</label>
                        <select name="selectSignataire" id="selectSignataire">
                            <?php
                            echo "<option value='' disabled selected hidden></option>";
                            foreach ($result4 as $row) {
                                $id_sign = $row['IdUtil'];
                                $lib_sign = $row['nom'];
                                echo "<option value=$id_sign>$lib_sign</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                    </div>
                    <div class="form-group">
                        <label for="affection">Affectation de la demande :</label>
                        <select name="selectAffectation" id="selectAffectation">
                            <?php
                            echo "<option value='' disabled selected hidden></option>";
                            foreach ($result4 as $row) {
                                $id_affect = $row['IdUtil'];
                                $lib_affect = $row['nom'];
                                echo "<option value=$id_affect>$lib_affect</option>";
                            }
                            ?>
                        </select>
                    </div>


                    <div class="form-group2">
                        <label for="demEmise">Fin souhaitée le :</label>
                        <input type="date" name="demFs" id="demFs">
                    </div>
                    <div class="form-group2">
                        <label for="demEmise">Mise en recette prévue le (optionnel) :</label>
                        <input type="date" name="demRct" id="demRct">
                    </div>


                    <div class="form-group">
                        <label for="regroupement">Regroupement :</label>
                        <select name="selectRegroupement" id="selectRegroupement">
                            <?php
                            echo "<option value='' disabled selected hidden></option>";
                            foreach ($result5 as $row) {
                                $id_regroupe = $row['IdRegroupe'];
                                $lib_regroupe = $row['libelle'];
                                echo "<option value=$id_regroupe>$lib_regroupe</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="demAmortis">Demande amortissable</label>
                        <input type="checkbox" name="demAmortis" id="demAmortis">
                    </div>

                    <div class="form-group">
                        <label for="demArchiv">Demande archivée le :</label>
                        <input type="date" name="demArchiv" id="demArchiv">
                    </div>
                </div>
                <div class="btnajout">
                    <button type="submit">Valider</button>
                    <button type="reset">Annuler</button>
                </div>
            </fieldset>
        </div>
    </section>

</body>

</html>


</body>

</html>