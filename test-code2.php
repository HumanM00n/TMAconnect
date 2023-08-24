<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/ClientSide/html.html to edit this template
-->
<html>

<head>
    <title>TMA </title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="css/csshome.css" rel="stylesheet" type="text/css" />
    <link href="css/creationDemande.css" rel="stylesheet" type="text/css" />
    <link rel="icon" href="img/NLogo2.png" />
</head>

<body>
    <?php
    // include('includes/header.html.inc.php');
    
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
    
    $sql0 = "SELECT libelle FROM tc_domaine";
    // $sql0 = "SELECT libelle, IdDomaine FROM tc_domaine";
    $stmt0 = $pdo->query($sql0);
    $result0 = $stmt0->fetchAll(PDO::FETCH_ASSOC);

    $sql1 = "SELECT libelle FROM tc_qualif";
    $stmt1 = $pdo->query($sql1);
    $result1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);

    $sql2 = "SELECT libelle FROM tc_priorite";
    $stmt2 = $pdo->query($sql2);
    $result2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);

    // Requ�tes SQL pour r�cup�rer les donn�es de la table tc_utilisateur
    $sql3 = "SELECT nom FROM tc_utilisateur";
    $stmt3 = $pdo->query($sql3);
    $result3 = $stmt3->fetchAll(PDO::FETCH_ASSOC);

    // Requ�tes SQL pour r�cup�rer les donn�es de la table tc_utilisateur avec une clause where pour le "Signataire"
    $sql4 = "SELECT nom FROM tc_utilisateur WHERE S_users = '1' OR S_users = '4'";
    $stmt4 = $pdo->query($sql4);
    $result4 = $stmt4->fetchAll(PDO::FETCH_ASSOC);

    $sql5 = "SELECT libelle FROM tc_regroupement";
    $stmt5 = $pdo->query($sql5);
    $result5 = $stmt5->fetchAll(PDO::FETCH_ASSOC);

    // Requ�tes SQL pour r�cup�rer les donn�es de la table tc_etat
    $sql6 = "SELECT libelle FROM tc_etat";
    $stmt6 = $pdo->query($sql6);
    $result6 = $stmt6->fetchAll(PDO::FETCH_ASSOC);

    // Requ�tes SQL pour r�cup�rer les donn�es de la table tc_Benef
    $sql7 = "SELECT lbl_benef FROM tc_benef";
    $stmt7 = $pdo->query($sql7);
    $result7 = $stmt7->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <?php

    if (isset($_POST["selectDom"])) {
        echo $_POST["selectDom"] . "|";
        echo $_POST["selectQualif"] . "|";
        echo $_POST["selectPrio"] . "|";
        echo $_POST["demLibelle"] . "|";
        echo $_POST["demCree"] . "|";
        echo $_POST["selectDemandePar"] . "|";
        echo $_POST["demEmise"] . "|";
        echo $_POST["selectDemandeEmisePar"] . "|";
        echo $_POST["demRecu"] . "|";
        echo $_POST["selectBeneficiaire"] . "|";
        echo $_POST["demEtat"] . "|";
        echo $_POST["selectDemandeEtat"] . "|";
        echo $_POST["visaServEtude"] . "|";
        echo $_POST["selectSignataire"] . "|";
        echo $_POST["selectAffectation"] . "|";
        echo $_POST["demFs"] . "|";
        echo $_POST["demRct"] . "|";
        echo $_POST["selectRegroupement"] . "|";
        echo $_POST["demAmortis"] . "|";
        echo $_POST["demArchiv"] . "|";
    }

    if (
        isset($_POST["selectDom"]) &&
        isset($_POST["selectQualif"]) &&
        isset($_POST["selectPrio"]) &&
        isset($_POST["demLibelle"]) &&
        isset($_POST["demCree"]) &&
        isset($_POST["selectDemandePar"]) &&
        isset($_POST["demEmise"]) &&
        isset($_POST["selectDemandeEmisePar"]) &&
        isset($_POST["demRecu"]) &&
        isset($_POST["selectBeneficiaire"]) &&
        isset($_POST["demEtat"]) &&
        isset($_POST["selectDemandeEtat"]) &&
        isset($_POST["visaServEtude"]) &&
        isset($_POST["selectSignataire"]) &&
        isset($_POST["selectAffectation"]) &&
        isset($_POST["demFs"]) &&
        isset($_POST["demRct"]) &&
        isset($_POST["selectRegroupement"]) &&
        isset($_POST["demAmortis"]) &&
        isset($_POST["demArchiv"])
    ) {
        try {
            // Préparation de la requête d'insertion en utilisant des paramètres nommés
            $sql = "INSERT INTO tc_demandes (IdDemande, dom_dmd, qual_dmd, prt_dmd, libelle, date_crea, util_crea, date_emet, util_emet, date_recu, util_benef, date_etat_dmd, etat_dmd, date_visa_dmd, util_sign_dmd, util_affect_dmd, date_fs, amorti_dmd, date_rct_prvu, regroupement, date_archiv) 
            VALUES (:var1, :var2, :var3, :var4, :var5, :var6, :var7, :var8, :var9, :var10, :var11, :var12, :var13, :var14, :var15, :var16, :var17, :var18, :var19, :var20)";

            // Binder les valeurs aux paramètres nommés
            $stmt = $pdo->prepare($sql);
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

            // Exécution de la requête d'insertion
            if ($stmt->execute()) {
                echo "Données insérées avec succès.";
            } else {
                echo "Erreur lors de l'insertion des données.";
            }
        } catch (PDOException $e) {
            echo "Erreur de connexion à la base de données : " . $e->getMessage();
        }
    }
    ?>

    <section id="menuNouvelDmd">
        <!-- <form id="form_menuNvlDmd" name="form_menuNvlDmd" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST"> -->
        <form id="form_nvldemande" name="form_nvldemande" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <fieldset id="menuDmd">
                <div class="form-row">
                    <div class="form-group">
                        <label for="demCreePar">Domaine :</label>
                        <select name="selectDemandePar" id="selectDemandePar">
                            <?php
                            echo "<option value='' disabled selected hidden></option>";
                            foreach ($result0 as $row) {
                                $lib_dom = $row['libelle'];
                                $id_dom = $row['libelle'];
                                echo "<option>$lib_dom</option>";
                                // echo "<option value=$id_dom>$lib_dom</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="demCreePar">Qualification :</label>
                        <select name="selectDemandePar" id="selectDemandePar">
                            <?php
                            echo "<option value='' disabled selected hidden></option>";
                            foreach ($result1 as $row) {
                                $lib_qual = $row['libelle'];
                                echo "<option>$lib_qual</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="demCreePar">Priorité :</label>
                        <select name="selectDemandePar" id="selectDemandePar">
                            <?php
                            echo "<option value='' disabled selected hidden></option>";
                            foreach ($result2 as $row) {
                                $lib_prt = $row['libelle'];
                                echo "<option>$lib_prt</option>";
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
            <!-- </form> -->
            <!-- </section> -->

            <!-- <section id="nvldemande"> -->
            <!-- <form id="form_nvldemande" name="form_nvldemande" action="" method="POST"> -->
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
                                $nom = $row['nom'];
                                echo "<option>$nom</option>";
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
                                $nom = $row['nom'];
                                echo "<option>$nom</option>";
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
                                $lbl_benef = $row['lbl_benef'];
                                echo "<option>$lbl_benef</option>";
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
                                $etat = $row['libelle'];
                                echo "<option>$etat</option>";
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
                                $lib_sign = $row['nom'];
                                echo "<option>$lib_sign</option>";
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
                                $lib_sign = $row['nom'];
                                echo "<option>$lib_sign</option>";
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
                        <input type="date" name="demMep" id="demMep">
                    </div>


                    <div class="form-group">
                        <label for="regroupement">Regroupement :</label>
                        <select name="selectRegroupement" id="selectRegroupement">
                            <?php
                            echo "<option value='' disabled selected hidden></option>";
                            foreach ($result5 as $row) {
                                $id_regroupe = $row['IdRegroupe'] ;
                                $lib_regroup = $row['libelle'];
                                echo "<option value=$id_regroupe>$lib_regroup</option>";
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
                    <button type="submit" name="btnajout">CR&Eacute;ER</button>
                </div>
            </fieldset>
        </form>


    </section>


</body>

</html>