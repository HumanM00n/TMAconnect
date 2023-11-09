<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/ClientSide/html.html to edit this template
-->
<html>

<head>
    <title>TMA-creaDmd-3</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/creationDemande.css" />
    <link rel="icon" href="img/NLogo2.png" />
</head>

<body>
    <?php
    include('includes/header.html.inc.php');

    // Informations de connexion � la base de donn�es MySQL
    $servername = "localhost:3308"; // nom du serveur
    $username = "root"; // nom d'utilisateur
    $password = "XVsikn92"; // mot de passe
    $dbname = "tmaconnect"; // nom de la base de donn�es
    // Cr�ation d'une connexion � la base de donn�es avec PDO
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    // Configuration des attributs de PDO
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Requ�tes SQL pour r�cup�rer les donn�es des tables tc_domaine, tc_qualification et tc_priorite
    
    $sql0 = "SELECT IdDomaine, libelle FROM tc_domaine";
    $stmt0 = $pdo->query($sql0);
    $result0 = $stmt0->fetchAll(PDO::FETCH_ASSOC);

    $sql1 = "SELECT IdQual ,libelle FROM tc_qualif";
    $stmt1 = $pdo->query($sql1);
    $result1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);

    $sql2 = "SELECT IdPriorite, libelle FROM tc_priorite";
    $stmt2 = $pdo->query($sql2);
    $result2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);

    // Requ�tes SQL pour r�cup�rer les donn�es de la table tc_utilisateur
    $sql3 = "SELECT IdUtil, nom FROM tc_utilisateur";
    $stmt3 = $pdo->query($sql3);
    $result3 = $stmt3->fetchAll(PDO::FETCH_ASSOC);

    // Requ�tes SQL pour r�cup�rer les donn�es de la table tc_utilisateur avec une clause where pour le "Signataire"
    $sql4 = "SELECT IdUtil, nom FROM tc_utilisateur WHERE S_users = '1' OR S_users = '4'";
    $stmt4 = $pdo->query($sql4);
    $result4 = $stmt4->fetchAll(PDO::FETCH_ASSOC);

    $sql5 = "SELECT IdRegroupe, libelle FROM tc_regroupement";
    $stmt5 = $pdo->query($sql5);
    $result5 = $stmt5->fetchAll(PDO::FETCH_ASSOC);

    // Requ�tes SQL pour r�cup�rer les donn�es de la table tc_etat
    $sql6 = "SELECT IdEtat, libelle FROM tc_etat";
    $stmt6 = $pdo->query($sql6);
    $result6 = $stmt6->fetchAll(PDO::FETCH_ASSOC);

    // Requ�tes SQL pour r�cup�rer les donn�es de la table tc_Benef
    $sql7 = "SELECT IdBenef, lbl_benef FROM tc_benef";
    $stmt7 = $pdo->query($sql7);
    $result7 = $stmt7->fetchAll(PDO::FETCH_ASSOC);

    $sql8 = "SELECT IdDemande FROM tc_demandes";
    $stmt8 = $pdo->query($sql8);
    $result8 = $stmt8->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <?php
    if (
        isset($_POST["numDemande"])
        && isset($_POST["selectDom"])
        && isset($_POST["selectDom"])
        && isset($_POST["selectQualif"])
        && isset($_POST["selectPrio"])
        && isset($_POST["demLibelle"]) //N°Demande ENTRE selectDemandePar et demCree
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
        && isset($_POST["demAmortis"])
        && isset($_POST["demRct"])
        && isset($_POST["selectRegroupement"])
        && isset($_POST["demArchiv"])
    ) {
        $var0 = $_POST["numDemande"];
        $var1 = $_POST["selectDom"];
        $var2 = $_POST["selectQualif"];
        $var3 = $_POST["selectPrio"];
        $var4 = $_POST["demLibelle"];
        $var5 = $_POST["demCree"];
        $var6 = $_POST["selectDemandePar"];
        $var7 = $_POST["demEmise"];
        $var8 = $_POST["selectDemandeEmisePar"];
        $var9 = $_POST["demRecu"];
        $var10 = $_POST["selectBeneficiaire"];
        $var11 = $_POST["demEtat"];
        $var12 = $_POST["selectDemandeEtat"];
        $var13 = $_POST["visaServEtude"];
        $var14 = $_POST["selectSignataire"];
        $var15 = $_POST["selectAffectation"];
        $var16 = $_POST["demFs"];
        $var17 = $_POST["demAmortis"];
        $var18 = $_POST["demRct"];
        $var19 = $_POST["selectRegroupement"];
        $var20 = $_POST["demArchiv"];

        // Préparation de la requête d'insertion en utilisant des paramètres nommés
        $sql = "INSERT INTO tc_demandes (dom_dmd, qual_dmd, prt_dmd, libelle, date_crea, util_crea, date_emet, util_emet, date_recu, util_benef, date_etat_dmd, etat_dmd, date_visa_dmd, util_sign_dmd, util_affect_dmd, date_fs, amorti_dmd, date_rct_prvu, regroupement, date_archiv, IdLdoi, IdEval, IdRecette, IdMep) 
                VALUES (:var1, :var2, :var3, :var4, :var5, :var6, :var7, :var8, :var9, :var10, :var11, :var12, :var13, :var14, :var15, :var16, :var17, :var18, :var19, :var20, 1, 1, 1, 1)";

        $stmt = $pdo->prepare($sql);

        // Binder les valeurs aux paramètres nommés
        $stmt->bindValue(":var0", $var0);
        $stmt->bindValue(":var1", $var1);
        $stmt->bindValue(":var2", $var2);
        $stmt->bindValue(":var3", $var3);
        $stmt->bindValue(":var4", $var4);
        $stmt->bindValue(":var5", $var5);
        $stmt->bindValue(":var6", $var6);
        $stmt->bindValue(":var7", $var7);
        $stmt->bindValue(":var8", $var8);
        $stmt->bindValue(":var9", $var9);
        $stmt->bindValue(":var10", $var10);
        $stmt->bindValue(":var11", $var11);
        $stmt->bindValue(":var12", $var12);
        $stmt->bindValue(":var13", $var13);
        $stmt->bindValue(":var14", $var14);
        $stmt->bindValue(":var15", $var15);
        $stmt->bindValue(":var16", $var16);
        $stmt->bindValue(":var17", $var17);
        $stmt->bindValue(":var18", $var18);
        $stmt->bindValue(":var19", $var19);
        $stmt->bindValue(":var20", $var20);

        try {
            if ($stmt->execute()) {
                echo '<center><p class="Successful">Données insérées avec succès!</p></center>';
            } else {
                echo "Erreur lors de l'insertion des données.";
            }
        } catch (PDOException $e) {
            echo "Erreur de connexion à la base de données : " . $e->getMessage();
        }
    }
    ?>

    <section id="menuNouvelDmd">
        <form id="form_nvldemande" name="form_nvldemande" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
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
                        <?php
                        echo "<option value='' disabled selected hidden></option>";
                        foreach ($result8 as $row) {
                            $id_dmd = $row['IdDemande'];
                            echo "<option value=$id_dmd</option>";
                        }
                        ?>
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
            </fieldset>
            <div class="modal-dialog modal-dialog-centered">
                <button type="reset">Annuler</button>
            </div>
        </form>
    </section>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>